<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use Illuminate\Http\Request;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Http\Requests\Web\StoreCustomer;
use App\Http\Requests\Web\UpdateCustomer;
use App\Models\BolaoReserve;
use App\Models\Bolao;

use Intervention\Image\ImageManagerStatic as Image;

class CustomersController extends WebBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function myPanel()
    {
        $customer = auth()->guard('web')->user();

        return view('web.customers.mypanel', ['customer' => $customer]);
    }

    public function myBets(Request $request)
    {
        $customer = auth()->guard('web')->user();

        return view('web.customers.mybets', ['customer' => $customer, 'boloes' => $customer->boloes()->orderBy('updated_at', 'DESC')->orderBy('id', 'DESC')->get()]);
    }

    public function myBuys(Request $request)
    {
        $customer = auth()->guard('web')->user();

        return view('web.customers.mybuys', [
            'customer' => $customer, 
            'boloesBought' => $customer->boloesBuyer()->orderBy('updated_at', 'DESC')->orderBy('id', 'DESC')->paginate(),
            'reserves' => BolaoReserve::where('expiration_date', '>=', \Carbon\Carbon::now()->subHours(1))->where('customer_id' , $customer->id)->where('processed', 0)->take(50)->orderBy('id', 'DESC')->get(),
        ]);
    }

    public function register()
    {
        return view('web.customers.register');
    }

    public function edit()
    {
        $customer = auth()->guard('web')->user();

        return view('web.customers.edit_customer', ['customer' => $customer]);
    }

    /**
     *
     */
    public function store(StoreCustomer $request)
    {
        $errors = $request->validated();

        try
        {
            $customer = $this->repository->store($request->except('csrf'));
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Não foi possível salvar o registro, tente novamente mais tarde', 'error' => 1]);
        }

        \LaravelFacebookPixel::createEvent('Lead', ["content_category" => 'User',"content_name" => $customer->full_name,"currency" => "BRL","value" => 000]);

        $logged = auth()->guard('web')->login($customer);
        if ($request->has('redirectTo') && $request->get('redirectTo')){
            return response()->json(['message' => $request->get('redirectTo'), 'error' => 0]);
        }
        else {
            return response()->json(['message' => route('web.customers.profile'), 'error' => 0]);
        }
    }

    public function update(UpdateCustomer $request)
    {
        try
        {
            $id = auth()->guard('web')->user()->id;
            $errors = $request->validated($id);

            $dataToUpdate = $request->except('csrf');
            
            if($request->has('profile_image')){
                $imageName = time().'.'.$request->profile_image->extension();

                $customer = $this->repository->find($id);
                
                if (file_exists('img/profile_images/' . $customer->profile_image)){
                    $deleted = \File::delete('img/profile_images/' . $customer->profile_image);
                }

                $image_resize = Image::make($request->profile_image->getRealPath());              
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('img/profile_images/' . $imageName));
                
                $dataToUpdate['profile_image'] = $imageName;
            }


            $customer = $this->repository->update($dataToUpdate, $id);
        }
        catch (\Exception $e)
        {
            return back()->with(['message' => 'Não foi possível salvar o registro, tente novamente mais tarde', 'error' => 1]);
        }

        return back()->with(['message' => 'Alterações salvas com sucesso', 'error' => 0]);
    }

    public function rescue(Request $request)
    {
        $customer = auth()->guard('web')->user();

        return view('web.customers.edit_rescue', ['customer' => $customer]);
    }

    public function update_rescue(Request $request)
    {
        $id = auth()->guard('web')->user()->id;

        if (! $request->get('pix_key') || ! $request->get('value')){
            return response()->json(['message' => 'É obrigatorio que você envie a chave pix e o valor desejado', 'error' => 1]);
        }

        $valueConverted = (float)str_replace(',', '.', str_replace('.', '', $request->get('value')));

        if ($valueConverted < 20){
            return response()->json(['message' => 'O valor mínimo para saques é de R$20,00', 'error' => 1]);
        }

        if ($valueConverted > auth()->guard('web')->user()->credits){
            return response()->json(['message' => 'O valor de saque digitado está indisponível na sua conta', 'error' => 1]);
        }

        try
        {
            $customer = $this->repository->add_rescue(['customer_id' => $id, 'value' => $valueConverted, 'pix_key' => $request->get('pix_key')]);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Não foi possível salvar o registro, tente novamente mais tarde', 'error' => 1]);
        }

        return response()->json(['message' => route('web.customers.rescue'), 'error' => 0]);
    }

    public function creditsHistory(Request $request)
    {
        $customer = auth()->guard('web')->user();

        return view('web.customers.credits_history', ['customer' => $customer]);
    }
}
