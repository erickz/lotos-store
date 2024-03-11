<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\AdmBaseController;
use App\Http\Requests\Adm\StoreConcurso;
use App\Http\Requests\Adm\UpdateConcurso;
use App\Models\Lotery;
use App\Repositories\Contracts\ConcursoRepositoryInterface;
use Illuminate\Http\Request;

use App\Models\BolaoGame;

class ConcursosController extends AdmBaseController
{

    /**
     * Where to redirect concursos after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ConcursoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $concursos = $this->repository->paginate($request->all());

        return view('adm.concursos.index', compact('concursos'));
    }

    public function todo(Request $request)
    {
        $concursos = $this->repository->getByBoloesToDo($request->all());

        return view('adm.concursos.todo', compact('concursos'));
    }

    public function create()
    {
        $loteries = Lotery::active()->get();

        return view('adm.concursos.create', compact('loteries'));
    }

    public function store(StoreConcurso $request)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $concurso = $this->repository->store($request->except('csrf'));

        return $this->redirectWithMessage(
            ['name' => 'adm.concursos.edit', 'params' => [$concurso->id]]
            ,['message' => 'Concurso created with success', 'type' => 'success']
        );
    }

    public function edit($id = null)
    {
        $concurso = $this->repository->find($id);
        $loteries = Lotery::active()->get();

        return view('adm.concursos.edit')->with(compact('concurso', 'loteries'));
    }

    public function update(UpdateConcurso $request, $id)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $this->repository->update($id, $request->except(['_token', '_method']));

        return $this->redirectWithMessage(
            ['name' => 'adm.concursos.edit', 'params' => [$id]]
            ,['message' => 'Concurso edited with success', 'type' => 'success']
        );
    }

    public function delete($id = null)
    {
        $sessionMessage = [];

        if ($id){
            $deleted = $this->repository->delete([$id]);

            $sessionMessage = [
                'message' => 'Register deleted with success'
                ,'type' => 'success'
            ];

            if (! $deleted){
                $sessionMessage = [
                    'message' => 'It wasn`t possible to delete the register'
                    ,'type' => 'danger'
                ];
            }
        }

        return redirect()->route('adm.concursos.index')->with($sessionMessage);
    }

    /**
     * 
     */
    public function check(Request $request, $id = null)
    {
        $concurso = $this->repository->find($id);

        return view('adm.concursos.check')->with(compact('concurso'));
    }

    /**
     * 
     */
    public function doCheck(Request $request, $id = null)
    {
        try {
            $concurso = $this->repository->checkGames($id);   
        }
        catch(\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage(), 'error' => 1]);
        }

        return redirect()->back()->with(['message' => "Bolões verificados com sucesso", 'type' => 'success', 'error' => 0]);
    }

    /**
     * 
     */
    public function prizeCheck(Request $request, $id = null)
    {
        try {
            $concurso = $this->repository->rewardGames($id);   
        }
        catch(\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage(), 'error' => 1]);
        }

        return redirect()->back()->with(['message' => "Bolões premiados com sucesso", 'type' => 'success', 'error' => 0]);
    }

    /**
     * 
     */
    public function revenueCheck(Request $request, $id = null)
    {
        try {
            $concurso = $this->repository->rollRevenue($id);   
        }
        catch(\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage(), 'error' => 1]);
        }

        return redirect()->back()->with(['message' => "Bolões remunerados com sucesso", 'type' => 'success', 'error' => 0]);
    }

    /**
     * 
     */
    public function allGames(Request $request, $id = null)
    {
        $concurso = $this->repository->find($id);

        return view('adm.concursos.allGames')->with(compact('concurso'));
    }

    /**
     * 
     */
    public function markBoloes(Request $request, $id = null, $bolaoId = null)
    {
        try {
            $concurso = $this->repository->find($id);

            $bolao = $concurso->boloes()->where('boloes.id', $bolaoId)->first();
            
            $bolao->done = 0;
            $bolao->save();
        }
        catch(\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage(), 'error' => 1]);
        }

        return redirect()->back()->with(['message' => "Bolões marcados com o feito!", 'type' => 'success', 'error' => 0]);
    }

    /**
     * 
     */
    public function markAllBoloes(Request $request, $id = null)
    {
        try {
            $concurso = $this->repository->find($id);

            foreach($concurso->boloes as $bolao){
                $bolao->done = 0;
                $bolao->save();
            }            
        }
        catch(\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage(), 'error' => 1]);
        }

        return redirect()->back()->with(['message' => "Bolões marcados com o feito!", 'type' => 'success', 'error' => 0]);
    }

    /**
     * 
     */
    public function repayBolao(Request $request, $id = null, $bolaoId = null)
    {
        try {
            $concurso = $this->repository->find($id);

            $bolao = $concurso->boloes()->where('boloes.id', $bolaoId)->first();

            if ($bolao->repayed){
                return redirect()->back()->with(['message' => "Bolões já reembolsado!", 'type' => 'success', 'error' => 0]);
            }
            
            $this->doRepay($bolao);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage(), 'error' => 1]);
        }

        return redirect()->back()->with(['message' => "Bolões reembolsados com o feito!", 'type' => 'success', 'error' => 0]);
    }

    /**
     * 
     */
    public function repayAllBoloes(Request $request, $id = null)
    {
        try {
            $concurso = $this->repository->find($id);

            foreach($concurso->boloes as $bolao){
                
                //If It was already repayed, then skip it
                if($bolao->repayed){
                    continue;
                }

                $this->doRepay($bolao);
            }            
        }
        catch(\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage(), 'error' => 1]);
        }

        return redirect()->back()->with(['message' => "Bolões reembolsados com o feito!", 'type' => 'success', 'error' => 0]);
    }

    private function doRepay($bolao = NULL)
    {
        $bolao->repayed = 1;
        $bolao->active = 0;
        $bolao->save();

        //Repay created of Bolao
        $owner = $bolao->customer;
        $owner->add_credits($bolao->total_value);

        //Repay buyers
        foreach($bolao->buyers as $bolaoBuy){
            $buyer = $bolaoBuy->customer;

            //The owner of the bolao shouldn't be repayed by the amount of cotas It has because It doesn't pay for It
            if ($buyer->id == $owner->id ){
                continue;
            }
                
            //The buyers receive the amount payed
            $buyer->add_credits($bolao->price * $buyer->cotas);
        }

        return $bolao;
    }

    /**
     * 
     */
    public function generateCode(Request $request, $id = null)
    {
        try {
            $concurso = $this->repository->find($id);

            $code = '';
            $qtBoloes = 0;
            $qtGames = 0;
            //#1 METHOD
            $timeout = 100;
            $duplicatedGamesAr = [];

            $duplicatedGames = BolaoGame::join('boloes', 'bolao_id', '=', 'boloes.id')->selectRaw("`numbers`, COUNT(*) as quantity, GROUP_CONCAT(`boloes_games`.`id`, '') AS ids")->where('boloes.done', 0)->where('boloes.concurso_id', '=', $id)->having('quantity', '>', '1')->groupBy('numbers')->orderBy('quantity', 'DESC')->get();

            $code .= 'Não duplicados: <pre>';
            foreach($concurso->boloes()->where('done', 0)->get() as $bolao){
                // $timeout = 100;
                $qtBoloes++;

                if ($bolao->games->count() <= 0){
                    continue;
                }
                
                // $code .= 'Bolao ' . $bolao->id . '<pre>';
                
                // $code .= "setInterval(function(){ $('#confirm-cancel #confirmarModalConfirmacao').click(); $('#confirm #confirmarModalConfirmacao').click(); }, 200);";
                // $code .= "$('#confirm-cancel,#confirm').remove();";
                // $code .= '//Bolao ' . $bolao->id;
                foreach($bolao->games()->orderBy('id', 'DESC')->get() as $game){
                    
                    if($duplicatedGames->contains(function($value, $key) use($game, &$duplicatedGamesAr){
                        $arIds = explode(',', $value->ids);
                        
                        if (in_array($game->id, $arIds)){
                            $duplicatedGamesAr[] = $game;
                            return true;
                        }

                        return false;
                    })){
                        continue;
                    }

                    $code = $this->generateLineCodeForGame($code, $game, $bolao, $qtGames, $timeout);
                    // $code .= '/**-' . $game->id . '-**/';
                }

                $bolao->done = 1;
                $bolao->save();

                // $code .= '</pre>';
                // $code .= '//Bolao.';
            }
            $code .= '</pre>';

            if (! empty($duplicatedGamesAr)){
                $code .= 'Duplicados: <pre>';
                $gamesDone = [];
                $timeout = 100;
                foreach($duplicatedGamesAr as $game){
                    $qtGames++;

                    $code = $this->generateLineCodeForGame($code, $game, $bolao, $fix, $timeout, 1000);
                }
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage(), 'error' => 1]);
        }

        return redirect()->back()->with(['message' => "Código gerado (" . $qtGames . " apostas de <b>" . $qtBoloes . " bolões</b>): <br /> " . $code, 'type' => 'success', 'error' => 0]);
    }

    private function generateLineCodeForGame($code, $game, $bolao, &$qtGames = NULL, &$timeout, $timeoutIncrease = 400)
    {
        $code .= 'setTimeout(function(){';
        // $code .= "$('#confirm-cancel #confirmarModalConfirmacao').click();";
        $arNumbers = $game->getArNumbers();
        $qtNumbers = $game->quantity_numbers;
        $clickTimes = $qtNumbers - $bolao->lotery->min_numbers;

        $code .= "if($('#confirm-cancel #confirmarModalConfirmacao').length > 0 && $('#confirm-cancel #confirmarModalConfirmacao').is(':visible')){";
        $code .= "$('#confirm-cancel #confirmarModalConfirmacao').click();";
        $code .= "$('.modal-backdrop').remove();";
        $code .= "}";

        $code .= "if($('#confirm #confirmarModalConfirmacao').length > 0 && $('#confirm #confirmarModalConfirmacao').is(':visible')){";
        $code .= "$('#confirm #confirmarModalConfirmacao').click();";
        $code .= "$('.modal-backdrop').remove();";
        $code .= "}";

        $code .= "if($('#fecharModalAlerta').length > 0 && $('#fecharModalAlerta').is(':visible')){";
        $code .= "$('#fecharModalAlerta').click();";
        $code .= "$('.modal-backdrop').remove();";
        $code .= "}";

        if ($clickTimes > 0){                        
            for($i = 0; $i < $clickTimes; $i++){
                $code .= "$('#aumentarnumero').click();";
            }
        }
        
        foreach($arNumbers as $number){
            $toSearchNumber = $number;
            $code .= "$('#n" . $toSearchNumber . "').click();";
        }
        
        $qtGames++;
        
        $code .= "$('#colocarnocarrinho').click();";

        $code .= "if($('#confirm-cancel #confirmarModalConfirmacao').length > 0 && $('#confirm-cancel #confirmarModalConfirmacao').is(':visible')){";
        $code .= "$('#confirm-cancel #confirmarModalConfirmacao').click();";
        $code .= "$('.modal-backdrop').remove();";
        $code .= "}";

        $code .= "if($('#confirm #confirmarModalConfirmacao').length > 0 && $('#confirm #confirmarModalConfirmacao').is(':visible')){";
        $code .= "$('#confirm #confirmarModalConfirmacao').click();";
        $code .= "$('.modal-backdrop').remove();";
        $code .= "}";

        $code .= "if($('#fecharModalAlerta').length > 0 && $('#fecharModalAlerta').is(':visible')){";
        $code .= "$('#fecharModalAlerta').click();";
        $code .= "$('.modal-backdrop').remove();";
        $code .= "}";


        $code .= '},' . $timeout . ');';
        $timeout += $timeoutIncrease;

        return $code;
    }
}
