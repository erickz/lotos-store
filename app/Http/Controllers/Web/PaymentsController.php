<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\BolaoRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

use App\Models\Payment;
use App\Models\PaymentQrCode;
use App\Models\Customer;
use App\Models\Lotery;

use Mail;
use App\Mail\CreditsBoughtMail;

class PaymentsController extends WebBaseController
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
    public function __construct(PaymentRepositoryInterface $repository, BolaoRepositoryInterface $bolaoRepo, CustomerRepositoryInterface $customerRepo)
    {
        $this->repository = $repository;
        $this->bolaoRepo = $bolaoRepo;
        $this->customerRepo = $customerRepo;

        parent::__construct();
    }

    
    public function index(Request $request)
    {
        // if (! auth()->guard('web')->check()){
        //     return redirect()->route('web.cart.customer');
        // }

        //Centralizing the toPay value, when the user comes to buy credits only this is the value to pay
        session()->put('payment.toPay', session()->get('payment.total'));
        
        if (session()->get('payment.toPay') <= 0){
            return redirect()->route('web.home');
        }

        if (session()->has('cart.customBolao') || session()->has('cart.boloes')){

            //At this point the user is already logged in and can claim Its selected cotas from cart
            if(session()->has('cart.boloes')){
                $reserves = $this->bolaoRepo->getReservesByIds(session()->get('cart.boloes'));

                if (! $reserves ){
                    return redirect()->route('web.cart')->with(['message' => 'Não foi encontrado bolão no seu carrinho']);;
                }

                //Claim the reserves before redirecting to pay
                foreach($reserves as $reserve){
                    if (! $reserve->customer_id){
                        $reserve->customer_id = auth()->guard('web')->check() ? auth()->guard('web')->user()->id : NULL;
                        $reserve->save();
                    }
                }
            }

            //In order to execute the payment, It's important to keep this execution after the cotas are claimed
            if (auth()->guard('web')->check() && auth()->guard('web')->user()->credits >= session()->get('payment.total')){
                return redirect()->route('web.payments.pay');
            }
        }

        try
        {
            $response = Http::withHeaders([
                'content-length' => 32,
                'Authorization' => 'Bearer ' . env('PAGSEGURO_TOKEN')
            ])->post(env("PAGSEGURO_HOST") . 'public-keys', ['type' => "card"]);

            $body = $response->body();
            $jsonDecoded = json_decode($body);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['message' => 'Ocorreu um erro ao iniciar o pagamento']);
        }

        if (isset($jsonDecoded->public_key)){
            $sessionId = $jsonDecoded->public_key;
        }
        else {
            if (session()->has('cart.boloes')){
                return redirect()->route('web.cart')->with(['message' => 'Não foi possível iniciar o pagamento', ['credits' => $request->get('credits')]]);
            }
            if (session()->has('cart.customBolao') && ! session()->has('payment.onlyCredits')){
                $bolao = $this->bolaoRepo->find(session()->get('cart.customBolao.bolao_id'));
                return redirect()->route('web.boloes.config', [$bolao->lotery->initials])->with(['message' => 'Não foi possível iniciar o pagamento', ['credits' => $request->get('credits')]]);
            }
            else {
                return redirect()->back()->with(['message' => 'Não foi possível iniciar o pagamento', ['credits' => $request->get('credits')]]);
            }
        }

        \LaravelFacebookPixel::createEvent('InitiateCheckout', ["content_ids" => 00111, "content_category" => 'Initiated checkout',"content_name" => (auth()->guard('web')->check() ? auth()->guard('web')->user()->full_name : 'Não logado'),"contents" => 'Initiated checkout',"num_items" => session()->has('cart.boloes') ? count(session()->get('cart.boloes')) : '1',"currency" => "BRL","value" => session()->get('payment.total')]);

        session()->has("paymentType") && session()->get("paymentType") == 'pix' ? $isPix = TRUE : $isPix = false;

        $reserves = [];
        $totalCotasReserved = 0;
        $totalGames = 0;
        $totalChances = 0;
        if (session()->has('cart.boloes')){
            $reserves = $this->bolaoRepo->getReservesByIds(session()->get('cart.boloes'));

            foreach($reserves as $reserve){
                $totalCotasReserved += $reserve->cotas;
                $totalGames += $reserve->bolao->games->count();
                $totalChances += $reserve->bolao->chances;
            }
        }

        $bolaoToPay = NULL;
        if (session()->has('cart.customBolao')){
            $customBolao = session()->get('cart.customBolao');
            $bolaoToPay = $this->bolaoRepo->find($customBolao['bolao_id']);
        }
        
        return view('web.payments.index', ['sessionId' => $sessionId, 'bolaoToPay' => $bolaoToPay, 'isPix' => $isPix, 'reserves' => $reserves, 'totalGames' => $totalGames, 'totalChances' => $totalChances, 'totalCotasReserved' => $totalCotasReserved]);
    }

    /**
     *
     */
    public function doPayment(Request $request)
    {
        $storedCustomer = 0;
        $customer = auth()->guard('web')->user();
        if(! auth()->guard('web')->check())
        {
            // Define your custom validation rules
            $rules = [
                'full_name' => 'sometimes',
                'email' => 'sometimes|unique:customers,email|email',
                'cpf' => 'sometimes|formato_cpf',
                'password' => 'sometimes|min:6'
            ];

            // Create a validator instance
            $validator = Validator::make($request->all(), $rules);

            // Check if the validation fails
            if ($validator->fails()) {
                return redirect()->route('web.payments.index')->with(['message' => $validator->errors()->first()])->with(['paymentType' => $request->get('paymentType')]);
            }

            // If validation passes, proceed with storing the customer
            try {
                $customer = $this->customerRepo->store($request->except('csrf'));
                $storedCustomer = 1;
            } catch (\Exception $e) {
                return redirect()->route('web.payments.index')->with(['message' => 'Não foi possível salvar o registro, tente novamente mais tarde'])->with(['paymentType' => $request->get('paymentType')])->withInput();
            }
        }

        try
        {
            $reserves = [];
            if (session()->has('cart.boloes')){
                $reserves = $this->bolaoRepo->getReservesByIds(session()->get('cart.boloes'));

                if (! $reserves ){
                    throw new \Exception('As cotas selecionadas foram expiradas, selecione outras cotas');
                }
            }

            $referenceId = \Str::random(9);
            $descriptionBuy = session()->get('payment.toPay') . " reais em créditos para " . $request->get('name');

            $toPay = session()->get('payment.toPay');
            $discountFromCredits = 0;
            if (auth()->guard('web')->user()->credits > 0 && auth()->guard('web')->user()->credits < session()->get('payment.toPay')){
                $discountFromCredits = auth()->guard('web')->user()->credits;
                $toPay = $this->calculateTheCreditsDiffToPay(session()->get('payment.toPay'), auth()->guard('web')->user()->credits);
            }

            $amountValue = intval(round($toPay*100));

            if(session()->has('cart.customBolao')) {
                $descriptionBuy = 'create_bolao:' . session()->get('cart.customBolao')['bolao_id'];
            }
            elseif (session()->has('cart.boloes')){
                $descriptionBuy = 'buy_bolao:' . implode(',', session()->get('cart.boloes'));
            }

            $paymentData = [
                'referenceId' => $referenceId,
                'descriptionBuy' => $descriptionBuy,
                'amountValue' => $amountValue,
                'customerId' => $customer->id,
                'cpf' => $customer->cpf,
                'customerFullName' => $customer->full_name,
                'customerEmail' => $customer->email,
            ];

            if($request->has('paymentType') && $request->get('paymentType') == 'pix'){    
                $paymentResults = $this->repository->pixPayment($paymentData);
    
                $valueBought = $paymentResults['qr_codes'][0]['amount']['value'];
    
                $payment = Payment::create([
                    'customer_id' => $customer->id,
                    'transaction_id' => $paymentResults['reference_id'],
                    'completed' => 0,
                    'name' => $customer->full_name,
                    'email' => $customer->email,
                    'items' =>  $descriptionBuy,
                    'gateway'   => 'pagseguro',
                    'type'      => 'pix',
                    'status'    => 'WAITING',
                    'code'      => $paymentResults['id'],
                    'total'     => $valueBought,
                    'url'       => ''
                ]);

                // Criar uma instância de Carbon a partir da string
                $expirationDatetime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.vP', $paymentResults['qr_codes'][0]['expiration_date']);
                $expirationDatetime = $expirationDatetime->toDateTimeString();

                $paymentQrCode = PaymentQrCode::create([
                    'payment_id' => $payment->id,
                    'source_id' => $paymentResults['qr_codes'][0]['id'],
                    'expiration_date' => $expirationDatetime,
                    'amount' => $paymentResults['qr_codes'][0]['amount']['value'],
                    'codeText' => $paymentResults['qr_codes'][0]['text'],
                    'imageLink' => $paymentResults['qr_codes'][0]['links'][0]['href']
                ]);
            }
            else {
                $paymentData['cardToken'] = $request->get('cardToken');
    
                $paymentResults = $this->repository->creditCardPayment($paymentData);
    
                $valueBought = $paymentResults['charges'][0]['amount']['value'];
    
                $payment = Payment::create([
                    'customer_id' => $customer->id,
                    'transaction_id' => $paymentResults['reference_id'],
                    'completed' => $paymentResults['charges'][0]['status'] == 'PAID' ? 1 : 0,
                    'name' => $customer->full_name,
                    'email' => $customer->email,
                    'gateway'   => 'pagseguro',
                    'type'      => 'credit_card',
                    'items' =>  $descriptionBuy,
                    'status'    => $paymentResults['charges'][0]['status'],
                    'code'      => $paymentResults['id'],
                    'total'     => $valueBought,
                    'url'       => ''
                ]);

                //Add the correspondent credit
                if ($paymentResults['charges'][0]['status'] == 'PAID'){

                    if(str_contains($descriptionBuy, 'create_bolao')){
                        $arDescription = explode(':', $descriptionBuy);

                        $this->bolaoRepo->activateBolao($arDescription[1]);
                    }
                    elseif(str_contains($descriptionBuy, 'buy_bolao')){
                        $arDescription = explode(':', $descriptionBuy);

                        foreach($reserves as $reserve){
                            $this->bolaoRepo->finishBolaoBuy($reserve->bolao_id, $reserve->cotas, auth()->guard('web')->user(), false);
                            $reserve->processed = 1;
                            $reserve->save();
                        }
                    }
                    else {
                        $paidValue = $valueBought/100;
                    
                        if (auth()->guard('web')->check()){
                            $customer->add_credits($paidValue);
                        }

                        if (session()->has('payment.onlyCredits')){
                            Mail::to($payment->email)->send(new CreditsBoughtMail($request->name, $valueBought, \Carbon\Carbon::now()->format('d/m/Y H:i')));
                        }
                    }
                }
            }
        }
        catch(\Exception $e){
            return redirect()->route('web.payments.index')->with(['message' => $e->getMessage()])->with(['paymentType' => $request->get('paymentType')]);
        }

        if($storedCustomer){
            $logged = auth()->guard('web')->login($customer);
        }

        return redirect()->route('web.payments.finish', [$payment->id]);
    }

    /**
     *
     */
    public function pay(Request $request)
    {
        try
        {
            $toPay = session()->get('payment.toPay');

            if (! auth()->guard('web')->check()){
                throw new \Exception('Not logged in');
            }

            if (auth()->guard('web')->user()->credits < $toPay){
                throw new \Exception('Not enough credit');
            }

            if (! session()->has('payment.onlyCredits')){
                if (session()->has('cart.customBolao') && !session()->has('cart.boloes')){
                    session()->put('cart.customBolao.customer_id', auth()->guard('web')->user()->id);

                    $customBolao = true;
                    try {
                        $customBolaoData = session()->get('cart.customBolao');
                        $bolao = $this->bolaoRepo->activateBolao($customBolaoData['bolao_id']);
                    }
                    catch(\Exception $e){
                        $error = true;
                    }

                    auth()->guard('web')->user()->remove_credits($toPay);
                }
                else if(session()->has('cart.boloes')){
                    if (empty(session()->get('cart.boloes'))){
                        throw new \Exception('Cart boloes not available');
                    }
        
                    $reserves = $this->bolaoRepo->getReservesByIds(session()->get('cart.boloes'));
        
                    if (! $reserves ){
                        throw new \Exception('Os bolões selecionados foram expirados');
                    }
        
                    foreach($reserves as $reserve){
                        $this->bolaoRepo->finishBolaoBuy($reserve->bolao_id, $reserve->cotas, auth()->guard('web')->user());
                        $reserve->processed = 1;
                        $reserve->save();
                    }
                    
                    auth()->guard('web')->user()->remove_credits($toPay);
                }
            }
        }
        catch(\Exception $e){
            return redirect()->route('web.cart')->with(['message' => $e->getMessage(), '']);
        }

        return redirect()->route('web.payments.finish_boloes');
    }

    //Not used anymore
    public function finish(Request $request, $paymentId = NULL)
    {
        if ( !$paymentId){
            return redirect()->route('web.credits.index');
        }

        $payment = Payment::find($paymentId);

        if ($payment->customer_id != auth()->guard('web')->user()->id ){
            return redirect()->route('web.customers.mybuys');
        }

        $error = false;
        $toPay = $this->calculateTheCreditsDiffToPay(session()->get('payment.toPay'), auth()->guard('web')->user()->credits);
        $customBolao = session()->has(key: 'cart.customBolao') && !session()->has('cart.boloes') && auth()->guard('web')->user()->credits >= $toPay ? session()->get('cart.customBolao') : false;

        \LaravelFacebookPixel::createEvent('Purchase', ["content_ids" => $payment->id,"content_name" => $payment->code,"content_type" => $payment->status,"contents" => "Made via " . $payment->gateway,"num_items" => '0', "currency" => "BRL","value" => $payment->total]);
        $this->_cleanUpSessions();
        
        if(! session()->has('payment.onlyCredits')){
            return view('web.payments.finish_boloes', ['payment' => $payment, 'error' => $error, 'customBolao' => $customBolao]);
        }
        else {
            return view('web.payments.finish', ['payment' => $payment]);
        }
    }

    //This method comes directly from the directPay function
    public function finish_boloes(Request $request)
    {        
        \LaravelFacebookPixel::createEvent('Purchase', ["content_ids" => 02,"content_name" => 'Compra de cotas',"content_type" => 'PAID',"contents" => "Compra de cotas por: " . auth()->guard('web')->user()->full_name,"num_items" => session()->has('cart.boloes') ? count(session()->get('cart.boloes')) : '', "currency" => "BRL","value" => session()->get('payment.total')]);

        $hasCustomBolao = session()->has('cart.customBolao');
        $this->_cleanUpSessions();
        
        return view('web.payments.finish_boloes', ['customBolao' => $hasCustomBolao]);
        // return redirect()->route("web.boloes.customer", [auth()->guard('web')->user()->id, auth()->guard('web')->user()->getProfileNameForURL()]);
    }

    private function _cleanUpSessions(){            
        $reserves = [];
        session()->forget('cart.boloes');
        session()->forget('cart.customBolao');
        session()->forget('cart.boloesData');  
        session()->forget('payment.total');      
        session()->forget('payment.toPay');  
        session()->forget('payment.toPayDiff');  
        session()->forget('payment.isMinimum');
    }

    public function notifications(Request $request)
    {
        try {
            $payload = $request->all();
            $notificationCode = $payload['notificationCode'];

            \Log::info("Chegou notificação de pagamento");

            if (! $notificationCode){
                throw new \Exception('Not notification code sent');
            }

            $response = \Http::get('https://ws.pagseguro.uol.com.br/v3/transactions/notifications/' . $notificationCode, [
                'email' => env('PAGSEGURO_EMAIL'),
                'token' => env('PAGSEGURO_TOKEN')
            ]);
            
            $xmlContent = simplexml_load_string($response->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);

            \Log::info(print_r($xmlContent, true));

            if ($xmlContent->count() == 0){
                throw new \Exception('Error');
            }

            $referenceCode = $xmlContent->reference;

            $payment = Payment::where('transaction_id', $referenceCode)->first();

            if ( ! $payment){
                throw new \Exception('No payment found');
            }

            $isPaymentCompleted = $payment->completed;

            if ($isPaymentCompleted){
                throw new \Exception('Payment completed');
            }

            $status = ["2" => 'Em análise', "3" => 'Pago', "4" => 'Finalizado', "6" => 'Devolvido', "7" => 'Cancelado'];
            $notificationStatus = (string) $xmlContent->status;

            $payment->status = $status[$notificationStatus];
            if(in_array($notificationStatus, ["3","4"])){
                $payment->completed = 1;
                $descriptionBuy = $payment->items;

                if(str_contains($descriptionBuy, 'create_bolao')){
                    $arDescription = explode(':', $descriptionBuy);

                    $this->bolaoRepo->activateBolao($arDescription[1]);
                }
                elseif(str_contains($descriptionBuy, 'buy_bolao')){
                    $arDescription = explode(':', $descriptionBuy);
                    $reservesIds = explode(',', $arDescription[1]);
                    $reserves = $this->bolaoRepo->getReservesByIds($reservesIds);

                    \Log::info(print_r($reserves, true));

                    foreach($reserves as $reserve){
                        $this->bolaoRepo->finishBolaoBuy($reserve->bolao_id, $reserve->cotas, $reserve->customer, false);
                    }
                }
            }

            $payment->save();
        }
        catch(\Exception $e){
            return response('Error', 401);
        }

        return response()->json(['message' => 'Pedido atualizado com sucesso']);
    }
}