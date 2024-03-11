<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseApiController;
use App\Repositories\Contracts\LoteryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Transformers\LoteryTransformer;

class LoteriesController extends BaseApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoteryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(Request $request)
    {
        try
        {
            $loteries = $this->repository->paginate($request->all());
        }
        catch(\Exception $e){
            return $this->sendError('Não foi possível obter os dados das loterias');
        }

        return $this->sendResponse((new LoteryTransformer)->transform($loteries));
    }

    public function find($loteryAlias)
    {
        try
        {
            $lotery = $this->repository->findByInitials($loteryAlias);
        }
        catch(\Exception $e){
            return $this->sendError('Não foi possível obter os dados das loterias');
        }

        return $this->sendResponse((new LoteryTransformer)->transform($lotery));
    }
}
