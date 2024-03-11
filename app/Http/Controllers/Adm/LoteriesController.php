<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\AdmBaseController;
use App\Http\Requests\Adm\StoreLotery;
use App\Http\Requests\Adm\UpdateLotery;
use App\Repositories\Contracts\LoteryRepositoryInterface;
use Illuminate\Http\Request;

class LoteriesController extends AdmBaseController
{

    /**
     * Where to redirect loteries after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoteryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $loteries = $this->repository->paginate($request->all());

        return view('adm.loteries.index', compact('loteries'));
    }

    public function create()
    {
//        return view('adm.loteries.create');
    }

    public function store(StoreLotery $request)
    {
//        if (! $request->validated()){
//            return back()->withErrors();
//        }
//
//        $lotery = $this->repository->store($request->except('csrf'));
//
//        return $this->redirectWithMessage(
//            ['name' => 'adm.loteries.edit', 'params' => [$lotery->id]]
//            ,['message' => 'Lotery created with success', 'type' => 'success']
//        );
    }

    public function edit($id = null)
    {
//        $lotery = $this->repository->find($id);
//
//        return view('adm.loteries.edit')->with(compact('lotery'));
    }

    public function show($id = null)
    {
        $lotery = $this->repository->find($id);

        return view('adm.loteries.show')->with(compact('lotery'));
    }

    public function update(UpdateLotery $request, $id)
    {
//        if (! $request->validated()){
//            return back()->withErrors();
//        }
//
//        $this->repository->update($id, $request->except('email'));
//
//        return $this->redirectWithMessage(
//            ['name' => 'adm.loteries.edit', 'params' => [$id]]
//            ,['message' => 'Lotery edited with success', 'type' => 'success']
//        );
    }

    public function delete($id = null)
    {
//        $sessionMessage = [];
//
//        if ($id){
//            $deleted = $this->repository->delete([$id]);
//
//            $sessionMessage = [
//                'message' => 'Register deleted with success'
//                ,'type' => 'success'
//            ];
//
//            if (! $deleted){
//                $sessionMessage = [
//                    'message' => 'It wasn`t possible to delete the register'
//                    ,'type' => 'danger'
//                ];
//            }
//        }
//
//        return redirect()->route('adm.loteries.index')->with($sessionMessage);
    }
}
