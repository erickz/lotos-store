<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Contracts\ConcursoRepositoryInterface;
use App\Models\Concurso as Model;

use App\Models\Reward;

use Mail;
use App\Mail\BolaoPrizedMail;
use Carbon\Carbon;

class ConcursoRepository implements ConcursoRepositoryInterface
{
    private $model;
    private $rowsPerPage = 25;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get(Array $filters = []): Collection
    {
        return $this->model->get();
    }

    public function getByBoloesToDo($pagination = true): LengthAwarePaginator|Collection
    {
        $query = $this->model->withBoloesToDo();
        
        if ($pagination){
            return $query->paginate($this->rowsPerPage);
        }
        else {
            $now = Carbon::now()->format('Y-m-d');
            return $query->orderBy('id', 'DESC')->where('draw_day', '>=', $now)->get();
        }
    }

    public function paginate(Array $filters = []): LengthAwarePaginator
    {
        $query = $this->model;

        if (isset($filters['from']) && $filters['from']){
            $fromConverted = Carbon::createFromFormat('d/m/Y H:i', $filters['from'] . ' 00:00')->format('Y-m-d H:i:s');
            $query = $query->where('draw_datetime', '>=', $fromConverted);
        }

        if (isset($filters['to']) && $filters['to']){
            $toConverted = Carbon::createFromFormat('d/m/Y H:i', $filters['to'] . ' 23:59')->format('Y-m-d H:i:s');
            $query = $query->where('draw_datetime', '<=', $toConverted);
        }

        return $query->orderBy('draw_datetime', 'DESC')->paginate($this->rowsPerPage);
    }

    public function find($id = 0): Model
    {
        return $this->model->find($id);
    }

    public function store($data = []): Model
    {
        $data['active'] = isset($data['active']) ? $data['active'] : 0;
        $data['next_expected_prize'] = isset($data['next_expected_prize']) ? $data['next_expected_prize'] : 0;
        $data['value_accumulated'] = isset($data['value_accumulated']) ? $data['value_accumulated'] : 0;

        if (isset($data['draw_day'])){
            $data['draw_datetime'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $data['draw_day'] . ' 00:00:00')->addHours(20)->format('Y-m-d H:i:s');
        }

        $concurso = $this->model->create($data);

        return $concurso;
    }

    public function update($id, $data): Bool
    {
        $concurso = $this->find($id);
        
        $data['active'] = isset($data['active']) ? $data['active'] : 0;
        $data['next_expected_prize'] = isset($data['next_expected_prize']) ? $data['next_expected_prize'] : 0;
        $data['value_accumulated'] = isset($data['value_accumulated']) ? $data['value_accumulated'] : 0;

        if (! $concurso){
            return false;
        }

        if (isset($data['draw_day'])){
            $data['draw_datetime'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $data['draw_day'] . ' 00:00:00')->addHours(20)->format('Y-m-d H:i:s');
        }

        $updated = $concurso->update($data);

        return $updated;
    }

    public function delete($ids): Bool
    {
        return $this->model->destroy($ids);
    }

    public function checkGames($concursoId = null, $rewardUsers = false)
    {
        $concurso = $this->find($concursoId);

        foreach($concurso->boloes as $bolao){
            $games = $bolao->games;
            $bolao->prize = 0;

            foreach($games as $game){
                $game->prize = 0;
                $this->checkGame($concurso, $bolao, $game, false, $rewardUsers);
            }

            if ($bolao->lotery->initials == 'DS'){
                foreach($games as $game){
                    $this->checkGame($concurso, $bolao, $game, true, $rewardUsers);
                }   
            }

            $bolao->checked = 1;
            $bolao->save();
        }

        $concurso->checked = 1;
        $concurso->save();

        return $concurso;
    }

    private function checkGame($concurso, &$bolao, &$game, $isSecondResult = false, $rewardUsers = false)
    {
        $arNumbers = $game->getArNumbers();
        if (! $isSecondResult){
            $arDrawNumbers = $concurso->getArDrawNumbers();
        }
        else {
            $arDrawNumbers = $concurso->getArDrawNumbers2();
        }
        $numbersMatch = array_intersect($arDrawNumbers, $arNumbers);
        $qtMatches = count($numbersMatch);
        $minMatch = $concurso->lotery->min_match;
        $maxMatch = $concurso->lotery->max_match;

        if ($qtMatches >= $minMatch && $qtMatches <= $maxMatch){
            $game->prized = 1;
            if (! $isSecondResult){
                $drawResults = $concurso->results;
            }
            else {
                $drawResults = $concurso->results_2;
            }

            $j = 0;
            for($i = $maxMatch; $i >= $minMatch; $i--){
                if ($drawResults[$j]->number_winners <= 0){
                    $j++;
                    continue;
                }

                if ($i == $qtMatches){
                    $prizeConverted = str_replace(',', '.', str_replace('.', '', $drawResults[$j]->value_prize));
                    $game->prize += $prizeConverted;
                    $bolao->prize += $prizeConverted;
                }

                $j++;
            }

            if ($rewardUsers){
                $this->rewardUsers($bolao);
            }
        }

        if (! $isSecondResult){
            $game->number_match = $qtMatches;
        }
        else {
            $game->number_match_2 = $qtMatches;
        }
        $game->checked = 1;
        
        $game->save();
    }

    public function rewardGames($concursoId = null)
    {
        $concurso = $this->find($concursoId);

        if ($concurso->prized){
            throw new \Exception('Concurso já premiado');
        }

        foreach($concurso->boloes as $bolao){
            $games = $bolao->games;

            foreach($games as $game){
                if ($game->prized){
                    $this->rewardUsers($bolao);
                }
            }
        }

        $concurso->prized = 1;
        $concurso->save();

        return $concurso;
    }

    public function rewardUsers($bolao = NULL)
    {
        if ($bolao === NULL){
            throw new \Exception('No bolão found');
        }

        if ($bolao->prize == NULL || $bolao->prize <= 0){
            throw new \Exception('Bolão not prized');
        }

        $totalCotas = $bolao->cotas;
        $prizePerCota = $bolao->prize / $totalCotas;
        $cotasRewarded = 0;
        foreach($bolao->buyers as $buyer){
            $reward = new Reward();
            $customer = $buyer->customer;
            $cotasRewarded += $buyer->cotas;
            $rewardValue = $prizePerCota * $buyer->cotas;

            $reward->customer_id = $customer->id;
            $reward->bolao_id = $bolao->id;
            $reward->prize = $rewardValue;
            $reward->cotas = $buyer->cotas;
            $reward->prize_per_cota = $prizePerCota;
            $reward->save();

            $prizeMailData = [
                'customer_id' => $reward->customer->id, 
                'lotery_id' => $reward->bolao->lotery->id,
                'concurso_id' => $reward->bolao->concurso->id,
                'name' => $reward->bolao->name,
                'cotas' => $buyer->cotas,
                'prized' => $rewardValue
            ];

            Mail::to($reward->customer->email)->send(new BolaoPrizedMail($prizeMailData));

            $customer->add_credits($rewardValue);
        }
        
        $cotasLeft = $totalCotas - $cotasRewarded;
        $ownerCustomer = $bolao->customer;
        $rewardOwner = $prizePerCota * $cotasLeft;

        $reward = new Reward();
        $reward->customer_id = $ownerCustomer->id;
        $reward->bolao_id = $bolao->id;
        $reward->prize = $rewardOwner;
        $reward->cotas = $cotasLeft;
        $reward->prize_per_cota = $prizePerCota;
        $reward->save();

        $ownerCustomer->add_credits($rewardOwner);

        return $bolao;
    }

    public function rollRevenue($concursoId = null)
    {
        $concurso = $this->find($concursoId);
        
        if ($concurso->revenued){
            throw new \Exception('Concurso já remunerado!');
        }

        // $profitPercentage = 0.337;
        //13% is the percentage of profit applied in the selling of each cota
        $profitPercentage = 0.13;

        foreach($concurso->boloes as $bolao){

            if ($bolao->buyers->count() <= 0){
                continue;
            }

            $finalProfitForUser = $bolao->getProfit();

            $owner = $bolao->customer;
            $owner->add_credits($finalProfitForUser);
        }

        $concurso->revenued = 1;
        $concurso->save();

        return $concurso;
    }

    public function getByLoteryAndNumber($loteryInitials = 'MG', $number = '')
    {
        return Model::whereHas('lotery', function($q) use ($loteryInitials){
            $q->where('initials', $loteryInitials);
        })->where('number', $number)->first();
    }
}