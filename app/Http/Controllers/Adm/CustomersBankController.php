<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\AdmBaseController;
use App\Http\Requests\Adm\StoreCustomerBank;
use App\Http\Requests\Adm\UpdateCustomerBank;
use App\Repositories\Contracts\CustomerBankRepositoryInterface;
use App\Models\Customer;

use Illuminate\Support\Facades\Route;

class CustomersBankController extends AdmBaseController
{

    /**
     * Where to redirect customers after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    protected $customer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerBankRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $route = Route::current();

        if($route && $route->parameters()){
            $parentId = $route->parameter('idParent');

            $customer = Customer::find($parentId);

            if ( ! $customer ){
                return $this->redirectWithMessage(
                    ['name' => 'adm.customers.index']
                    ,['message' => 'Customer not found', 'type' => 'warning']
                );
            }

            $this->customer = $customer;
        }
    }

    public function index(Request $request, $parentId = 0)
    {
        $customers = $this->repository->paginate($request->all(), $parentId);

        return view('adm.customers.bank.index', compact('customers', array('this', 'customer')));
    }

    public function create()
    {
        return view('adm.customers.bank.create', ['customer' => $this->customer]);
    }

    public function store(StoreCustomerBank $request)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $this->repository->store($request->except('csrf'), $this->customer->id);

        return $this->redirectWithMessage(
            ['name' => 'adm.customers.edit', 'params' => [$this->customer->id]]
            ,['message' => 'Customer`s bank account created with success', 'type' => 'success']
        );
    }

    public function edit($parentId = null, $id)
    {
        $bankAccount = $this->repository->find($id);

        return view('adm.customers.bank.edit')->with(['customer' => $this->customer, 'bankAccount' => $bankAccount]);
    }

    public function update(UpdateCustomerBank $request, $customerId, $id)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $this->repository->update($id, $request->except('email'), $this->customer);

        return $this->redirectWithMessage(
            ['name' => 'adm.customers.edit', 'params' => [$this->customer->id, $id]]
            ,['message' => 'Customer edited with success', 'type' => 'success']
        );
    }

    public function delete($parentId = null, $id)
    {
        if ($id){
            $deleted = $this->repository->delete([$id]);

            if (! $deleted){
                return $this->redirectWithMessage(
                    ['name' => 'adm.customers.edit', 'params' => [$this->customer->id, $id]]
                    ,['message' => 'It wasn`t possible to delete the register', 'type' => 'danger']
                );
            }
        }

        return $this->redirectWithMessage(
            ['name' => 'adm.customers.edit', 'params' => [$this->customer->id, $id]]
            ,['message' => 'Register deleted with success', 'type' => 'success']
        );
    }
}
