<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseApiController;
use App\Repositories\Contracts\ConcursoRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Transformers\BolaoTransformer;
use App\Http\Transformers\ConcursoTransformer;

use App\Models\Bolao;

class ChromeExtensionController extends BaseApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ConcursoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getConcursosTodo(Request $request)
    {
        try
        {
            $concursos = $this->repository->getByBoloesToDo(false);
        }
        catch(\Exception $e){
            return $this->sendError('Não foi possível obter os dados dos concursos');
        }

        return $this->sendResponse((new ConcursoTransformer)->transform($concursos));
    }

    public function getBoloesToDo(Request $request, $loteryInitials = 'MG', $concursoNumber = NULL)
    {
        try
        {
            $concurso = $this->repository->getByLoteryAndNumber($loteryInitials, $concursoNumber);
            $boloes = $concurso->boloes;
        }
        catch(\Exception $e){
            return $this->sendError('Não foi possível obter os dados dos boloes');
        }

        return $this->sendResponse((new BolaoTransformer)->transform($boloes));
    }

    public function markAsDone(Request $request, $bolaoId = NULL)
    {
        try
        {
            $bolao = Bolao::find($bolaoId);

            $bolao->done = 1;
            $bolao->save();
        }
        catch(\Exception $e){
            return $this->sendError('Não foi possível marcar o bolão como feito');
        }

        return $this->sendResponse((new BolaoTransformer)->transform($bolao));
    }
}
