<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseApiController;
use App\Repositories\Contracts\BolaoRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Transformers\BolaoGameTransformer;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;

class BoloesGamesController extends BaseApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BolaoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get($bolaoId)
    {
        try
        {
            $games = $this->repository->getGames($bolaoId);
        }
        catch(\Exception $e){
            return $this->sendError('Não foi possível obter os jogos do bolão');
        }

        return $this->sendResponse((new BolaoGameTransformer)->transform($games));
    }

    public function store($bolaoId, Request $request)
    {
        try
        {
            if (! $request->has('numbers')){
                throw new \Exception('Dados dos jogos não enviados');
            }

            $game = $this->repository->storeGame($bolaoId, $request->only(['numbers']));
        }
        catch(\Exception $e){
            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Não foi possível criar o jogo');
        }

        return $this->sendResponse((new BolaoGameTransformer)->transform($game), 'Jogo adicionado ao bolão com sucesso!');
    }

    public function delete($bolaoId = null, $gameId = null)
    {
        $sessionMessage = [];

        if (! $bolaoId || ! $gameId) {
            return $this->sendError('Ids não passados');
        }

        try
        {
            $bolao = $this->repository->find($bolaoId);

            if ($bolao->checked){
                throw new \Exception('Não é possível apagar jogos de bolões já conferidos');
            }

            $deleted = $this->repository->deleteGame($bolao, $gameId);

            if (! $deleted ){
                throw new \Exception();
            }
        }
        catch(\Exception $e){
            return $this->sendError($e->getMessage() ? $e->getMessage() : 'Não foi possível apagar o jogo');
        }

        return $this->sendResponse([], 'Jogo apagado ao bolão com sucesso!');
    }
}
