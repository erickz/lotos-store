<?php

namespace App\Repositories;

use App\Models\Lotery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Contracts\BolaoRepositoryInterface;
use App\Models\Bolao as Model;
use App\Models\BolaoGame;
use App\Models\BolaoBuyer;
use App\Models\BolaoReserve;
use App\Models\Concurso;

use Mail;
use App\Mail\BolaoCreatedMail;
use App\Mail\CotasBoughtMail;

class BolaoRepository implements BolaoRepositoryInterface
{
    private $model;
    private $rowsPerPage = 30;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get(Array $filters = []): Collection
    {
        return $this->model->get();
    }

    public function getReservesByIds($ids = [])
    {
        return BolaoReserve::isActive()->whereIn('id', $ids)->get();
    }

    /**
     * Get the next concursos
     * Include the selected concurso of the bolão in order to display a past concurso in the editing of boloes.
     * @param bool $byLotery
     * @param bool $includeSelectedConcurso
     * @return array
     */
    public function getNextConcursos($byLotery = false, $includeSelectedConcurso = false)
    {
        $concursos = Concurso::following()->get();

        if (! $byLotery){
            return $concursos;
        }

        //Include the selected concurso of the bolão in order to display a past concurso in the editing of boloes.
        if ($includeSelectedConcurso){
            if (! $concursos->contains($includeSelectedConcurso)){
                $concursos = $concursos->push($includeSelectedConcurso);
            }
        }

        $concursosByLotery = [];

        foreach($concursos as $concurso){

            if (! isset($concursosByLotery[$concurso->lotery->getSlug()])){
                $concursosByLotery[$concurso->lotery->getSlug()] = [];
            }

            $concursosByLotery[$concurso->lotery->getSlug()][] = $concurso;
        }

        return $concursosByLotery;
    }

    public function paginate(Array $filters = []): LengthAwarePaginator
    {
        return $this->model->orderBy('id', 'DESC')->paginate($this->rowsPerPage);
    }

    public function find($id = 0): Model
    {
        return $this->model->find($id);
    }

    public function store($data = []): Model
    {
        if (! isset($data['description'])){
            $data['description'] = '';
        }

        $data['active'] = isset($data['active']) ? $data['active'] : 1;
        $data['featured'] = isset($data['featured']) ? $data['featured'] : 0;

        $bolao = $this->model->create($data);

        return $bolao;
    }

    public function update($id, $data): Bool
    {
        $bolao = $this->find($id);

        if (! $bolao){
            return false;
        }

        if (! isset($data['description'])){
            $data['description'] = '';
        }

        $bolao->active = isset($data['active']) ? $data['active'] : 0;
        $bolao->featured = isset($data['featured']) ? $data['featured'] : 0;

        $updated = $bolao->update($data);

        return $updated;
    }

    public function delete($ids): Bool
    {
        return $this->model->destroy($ids);
    }

    /**
     * Create a game for the bolao
     * @param $bolaoId
     */
    public function storeGame($bolaoId = null, $data = [])
    {
        $bolao = $this->find($bolaoId);

        if (is_array($data['numbers'])){
            $qtGames = count($data['numbers']);
        }
        else {
            $qtGames = count(explode(',', $data['numbers']));
        }

        //Quickly validate if the number of games is valid for the lotery
        if ($qtGames < $bolao->lotery->min_numbers || $qtGames > $bolao->lotery->max_numbers ){
            throw new \Exception('A quantidade de números selecionados é inválida para esta loteria');
        }

        $game = BolaoGame::create($data + ['bolao_id' => $bolaoId]);

        if (! $game){ 
            throw new \Exception("Error when creating the bolão");
        }

        return $bolao;
    }

    /**
     * Create the games for the bolao
     * @param $bolaoId
     */
    public function storeGames($bolaoId = null, $games = [])
    {
        $bolao = $this->find($bolaoId);

        foreach($games as $numbers){

            if (! is_array($numbers)){
                $numbers = explode(',', $numbers);
            }

            $qtNumbers = count($numbers);
    
            //Quickly validate if the number of games is valid for the lotery
            if ($qtNumbers < $bolao->lotery->min_numbers || $qtNumbers > $bolao->lotery->max_numbers ){
                throw new \Exception('A Quantidade de números é inválida para esta loteria');
            }
    
            $game = BolaoGame::create(['bolao_id' => $bolaoId, 'numbers' => $numbers, 'quantity_numbers' => $qtNumbers]);
    
            if (! $game){ 
                throw new \Exception("Error when creating the bolão");
            }
    
        } 

        return $bolao;  
    }

    /**
     * Create the games for the bolao
     * @param $bolaoId
     */
    public function storeBuyHistory($bolaoId = null, $cotas = null, $customerId = null)
    {
        if (! $bolaoId){
            throw new \Exception('Bolao não encontrado');
        }

        $bolao = $this->find($bolaoId);

        if ($cotas === null){
            throw new \Exception('Cotas inválidas');
        }
        
        if (! $customerId){
            throw new \Exception('Cliente não encontrado');
        }

        $bolaoBuyer = BolaoBuyer::create(['customer_id' => $customerId, 'is_owner' => ($customerId == $bolao->customer_id ? 1 : 0), 'cotas' => $cotas, 'bolao_id' => $bolaoId]);

        return $bolaoBuyer;
    }

    /**
     * Retrieve the games from the bolao
     * @param $bolaoId
     */
    public function getGames($bolaoId = null)
    {
        $bolao = $this->find($bolaoId);

        return $bolao->games()->orderBy('id', 'DESC')->get();
    }

    /**
     * @param null $bolaoId
     * @param array $ids
     * @return int
     */
    public function removeGame($id)
    {
        $game = BolaoGame::find($id);

        if ($game){
            return $game->delete();
        }
        
        return false;
    }

    /**
     * @param null $bolaoId
     * @param array $ids
     * @return int
     */
    public function deleteGame($bolao, $id)
    {
        return $bolao->games()->find($id)->delete();
    }

    public function getToListing($filters = [], $customerId = NULL)
    {
        $query = $this->model->with('concurso');

        if ($customerId){
            $query->where('customer_id', $customerId);
        }

        if (isset($filters['order_by']) && $filters['order_by']){

            if ($filters['order_by'] == 'price'){
                $query->orderBy('boloes.price', 'DESC');
            }
            else if ($filters['order_by'] == 'prize'){
                $query->whereHas('concurso', function($q){
                    $q->orderBy('concursos.next_expected_prize', 'DESC');
                });
            }
            else if ($filters['order_by'] == 'qt_games'){
                $query->orderBy('boloes.quantity_games', 'DESC');
            }
        }
        
        $query->orderBy('visits', 'DESC')->orderBy('boloes.id', 'DESC')->isValidToDisplay();

        if (isset($filters['concurso_id']) && $filters['concurso_id']){
            $query->where('boloes.concurso_id', $filters['concurso_id']);
        }

        if (isset($filters['lotery_id']) && $filters['lotery_id']){
            $query->where('boloes.lotery_id', $filters['lotery_id']);
        }

        return $query->paginate(15);
    }

    public function getMostPopular($exceptions = [], $loteryId = NULL)
    {
        $query = $this->model->with('concurso')->orderBy('visits', 'DESC')->orderBy('id', 'DESC')->whereNotIn('id', $exceptions)
        ->isValidToDisplay();

        if ($loteryId){
            $query = $query->where('lotery_id', $loteryId);
        }
        
        return $query->take(20)->get();
    }

    public function getSpecialBoloes($exceptions = [], $loteryId = NULL)
    {
        $query = $this->model->with('concurso')->orderBy('visits', 'DESC')->orderBy('id', 'DESC')->whereNotIn('id', $exceptions)
        ->isValidToDisplay()->whereHas('concurso', function($q){
            $q->where('type', 2);
        });

        if ($loteryId){
            $query = $query->where('lotery_id', $loteryId);
        }
        
        return $query->take(20)->get();
    }

    public function getBiggestChances($exceptions = [])
    {
        return $this->model->orderBy('total_value', 'DESC')->isValidToDisplay()->whereNotIn('id', $exceptions)->take(20)->get();
    }
    
    public function getMostEconomics($exceptions = [])
    {
        return $this->model->orderBy('price', 'ASC')->isValidToDisplay()->whereNotIn('id', $exceptions)->take(20)->get();
    }

    public function reserveCotas($bolaoId = NULL, $customerId = NULL, $cotas = NULL)
    {
        return BolaoReserve::create(['customer_id' => $customerId, 'bolao_id' => $bolaoId, 'cotas' => $cotas]);
    }

    public function finalizeBolaoCreation($bolaoData = NULL, $triggerEmail = true, $runByCommand = false)
    {
        if (! $bolaoData){
            throw new \Exception('Bolão data not found');
        }

        // if (! $runByCommand && auth()->guard('web')->user()->credits < $bolaoData['totalToPay']){
        //     throw new \Exception('Not enough credits');
        // }
        
        $bolao = $this->store($bolaoData);
        $this->storeGames($bolao->id, $bolaoData['games']);
        if ($bolaoData['keepCotas'] > 0){
            $this->storeBuyHistory($bolao->id, $bolaoData['keepCotas'], $bolaoData['customer_id']);
        }

        if ($triggerEmail){
            Mail::to($bolao->customer->email)->send(new BolaoCreatedMail($bolaoData));
        }

        if (! $runByCommand){
            // auth()->guard('web')->user()->remove_credits($bolaoData['totalToPay']);
        }

        return $bolao;
    }

    //Finish bolão buy
    public function finishBolaoBuy($bolaoId = NULL, $cotas = NULL, $customer = NULL, $charge = TRUE)
    {
        $bolao = $this->model->find($bolaoId);

        if ($cotas <= 0 || $cotas > $bolao->cotas_available){
            throw new \Exception("Quantidade de cotas indisponivel. Por favor atualize a página.");
        }

        if ($bolao->cotas_available <= 0){
            throw new \Exception("Quantidade de cotas indisponivel. Por favor atualize a página.");
        }

        if (! $customer){
            throw new \Exception("Usuário não identificado");
        }

        $customerCredits = $customer->credits;
        $totalPrice = ($bolao->price * $cotas);

        if ($charge){
            if ($customerCredits <= 0 || $totalPrice > $customerCredits){
                throw new \Exception("Créditos insuficientes! <a href='" . route('web.credits.index') . "' class='text-white'><u>Clique aqui</u> para comprar créditos.</a>");
            }
        }

        $this->storeBuyHistory($bolaoId, $cotas, $customer->id);

        Mail::to($customer->email)->send(new CotasBoughtMail($customer->getFirstName(), $bolao->name, $cotas));

        $bolao->cotas_available = $bolao->cotas_available - $cotas;
        $bolao->save();

        return $bolao;
    }

    public function activateBolao($bolaoId = NULL)
    {
        $bolao = $this->model->find($bolaoId);

        $bolao->active = 1;
        $bolao->save();

        return $bolao;
    }

    public function generateBoloesSuggestions($loteryAlias = 'mg')
    {
        //6 boloes no total
        
        $this->generateGame();
    }

    public function generateGame($numbersToGenerate = 6, $maxNumbers = 60)
    {
        $arNumbers = [];
        for($i = 0; $i < $numbersToGenerate; $i++){
            
            $repeat = 1;
            $generatedN = 0;
            while($repeat == 1)
            {
                $generatedN = random_int(1, $maxNumbers);

                if (! isset($arNumbers[$generatedN])){
                    $repeat = 0;
                }
            }

            $arNumbers[$generatedN] = $generatedN;
        }

        sort($arNumbers);

        return $arNumbers;
    }

    public function priceIsValid($games = NULL, $totalToPay = NULL, $lotery = NULL){
        
        if (! $games || ! $totalToPay || ! $lotery){
            return false;
        }

        $total = 0.00;
        foreach($games as $game)
        {
            $arGame = explode(',', $game);
            $numberDozens = count($arGame);
            
            $cost = $lotery->costs()->where('number_matches', $numberDozens)->first();
             
            $total += $cost->cost;
        }

        if ( $total != $totalToPay ){
            return false;
        }
        
        return true;
    }
}