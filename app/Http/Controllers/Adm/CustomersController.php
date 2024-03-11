<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\AdmBaseController;
use App\Http\Requests\Adm\StoreCustomer;
use App\Http\Requests\Adm\UpdateCustomer;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Http\Request;

use App\Models\CreditRescueHistory;

class CustomersController extends AdmBaseController
{

    /**
     * Where to redirect customers after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try
        {
            $customers = $this->repository->paginate($request->all());
        }
        catch (\Exception $e)
        {
            return back()->withErrors();
        }

        return view('adm.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('adm.customers.create');
    }

    public function store(StoreCustomer $request)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        try
        {
            $customer = $this->repository->store($request->except('csrf'));
        }
        catch (\Exception $e)
        {
            return back()->withErrors();
        }

        return $this->redirectWithMessage(
            ['name' => 'adm.customers.edit', 'params' => [$customer->id]]
            ,['message' => 'Customer created with success', 'type' => 'success']
        );
    }

    public function edit($id = null)
    {
        try
        {
            $customer = $this->repository->find($id);
        }
        catch (\Exception $e)
        {
            return back()->withErrors();
        }

        return view('adm.customers.edit')->with(compact('customer'));
    }

    public function update(UpdateCustomer $request, $id)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        try
        {
            $this->repository->update($id, $request->except('email'));
        }
        catch (\Exception $e)
        {
            return back()->withErrors();
        }

        return $this->redirectWithMessage(
            ['name' => 'adm.customers.edit', 'params' => [$id]]
            ,['message' => 'Customer edited with success', 'type' => 'success']
        );
    }

    public function add_credit(Request $request, $id)
    {
        $customer = $this->repository->find($id);
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

        return redirect()->route('adm.customers.index')->with($sessionMessage);
    }

    public function rescue(Request $request)
    {
        try
        {
            $rescues = CreditRescueHistory::orderBy('id', 'DESC')->paginate(25);
        }
        catch (\Exception $e)
        {
            return back()->withErrors();
        }

        return view('adm.customers.rescue', compact('rescues'));
    }

    public function markRescued(Request $request, $id)
    {
        try
        {
            $rescue = CreditRescueHistory::find($id);
            $rescue->finished = 1;
            $rescue->save();
        }
        catch (\Exception $e)
        {
            return back()->withErrors();
        }

        return back()->with(['message' => 'Solicitação finalizada com sucesso', 'type' => 'success', 'error' => 0]);
    }
}
