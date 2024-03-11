<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\AdmBaseController;
use App\Http\Requests\Adm\StoreBoloes;
use App\Http\Requests\Adm\UpdateBoloes;
use App\Repositories\Contracts\BolaoRepositoryInterface;
use Illuminate\Http\Request;

class BoloesController extends AdmBaseController
{

    /**
     * Where to redirect boloes after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BolaoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $boloes = $this->repository->paginate($request->all());

        return view('adm.boloes.index', compact('boloes'));
    }

    public function create()
    {
        $concursosList = $this->repository->getNextConcursos(true);

        return view('adm.boloes.create', compact('concursosList'));
    }

    public function store(StoreBoloes $request)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $boloes = $this->repository->store($request->except('csrf'));

        return $this->redirectWithMessage(
            ['name' => 'adm.boloes.edit', 'params' => [$boloes->id]]
            ,['message' => 'Boloes created with success', 'type' => 'success']
        );
    }

    public function edit($id = null)
    {
        $bolao = $this->repository->find($id);
        $concursosList = $this->repository->getNextConcursos(true, $bolao->concurso);

        return view('adm.boloes.edit')->with(compact('bolao', 'concursosList'));
    }

    public function update(UpdateBoloes $request, $id)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $this->repository->update($id, $request->except(['_token', '_method']));

        return $this->redirectWithMessage(
            ['name' => 'adm.boloes.edit', 'params' => [$id]]
            ,['message' => 'Boloes edited with success', 'type' => 'success']
        );
    }

    /**
     * 
     */
    public function addGame(Request $request, $id)
    {
        try {
            $bolao = $this->repository->storeGame($id, $request->except(['_token', '_method']));
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Não foi possível criar o bolão, tente novamente mais tarde', 'error' => 1]);
        }

        return response()->json(['message' => 'Alterações salvas com sucesso', 'error' => 0, 'obj' => $bolao->getShortGames()]);
    }

    /**
     * 
     */
    public function removeGame(Request $request)
    {
        try {
            $game = $this->repository->removeGame($request->get('removeId'));
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Não foi possível remover a aposta, tente novamente mais tarde', 'error' => 1]);
        }

        return response()->json(['message' => 'Aposta removida com sucesso', 'error' => 0]);
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

        return redirect()->route('adm.boloes.index')->with($sessionMessage);
    }
}
