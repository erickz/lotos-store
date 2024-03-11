<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\BolaoRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Payment;
use App\Models\Customer;

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
    public function __construct(PaymentRepositoryInterface $repository, BolaoRepositoryInterface $bolaoRepo)
    {
        $this->repository = $repository;
        $this->bolaoRepo = $bolaoRepo;

        parent::__construct();
    }

    private function _manageTotalToPaySession()
    {
        if (auth()->guard('web')->check()){
            $toBuy = session()->get('payment.toPay') - auth()->guard('web')->user()->credits;
                        
            if ($toBuy > 0){
                session()->put('payment.credits', $toBuy);
                session()->put('payment.notEnoughCredits', true);

                return true;
            }
            else {
                return false;
            }
        }   
        else {
            session()->put('payment.credits', session()->get('payment.toPay'));
            session()->put('payment.notEnoughCredits', true);

            return true;
        }
    }

    public function index(Request $request)
    {
        if (! auth()->guard('web')->check()){
            return redirect()->route('web.cart.customer');
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
            return redirect()->back()->with(['message' => 'Ocorreu um erro ao acessar a página']);
        }

        if (isset($jsonDecoded->public_key)){
            $sessionId = $jsonDecoded->public_key;
        }
        else {
            return redirect()->back()->with(['message' => 'Não foi possível criar a sessão', ['credits' => $request->get('credits')]]);
        }

        if (session()->has('cart.customBolao') && ! session()->has('payment.credits')){
            if (auth()->guard('web')->check() && auth()->guard('web')->user()->credits >= session()->get('payment.toPay')){
                return redirect()->route('web.payments.pay');
            }

            session()->put('payment.credits', session()->get('payment.toPay'));
            session()->put('payment.notEnoughCredits', true);
        }
        else {
            if (session()->has('payment.toPay') || session()->get('payment.credits') <= 0){
    
                //User just logged in via the checkout proccess and has enough credit to pay
                if (session()->has('cart.boloes') && auth()->guard('web')->check()){
                    $reserves = $this->bolaoRepo->getReservesByIds(session()->get('cart.boloes'));
        
                    if (! $reserves ){
                        return redirect()->route('web.cart')->with(['message' => 'Não foi possível prosseguir com o pagamento']);;
                    }
        
                    //Claim the reserves before redirecting to pay
                    foreach($reserves as $reserve){
                        if (! $reserve->customer_id){
                            $reserve->customer_id = auth()->guard('web')->user()->id;
                            $reserve->save();
                        }
                    }

                    if (auth()->guard('web')->user()->credits >= session()->get('payment.toPay')){
                        return redirect()->route('web.payments.pay');
                    }
                }
                
                if (! $this->_manageTotalToPaySession()){
                    return redirect()->route('web.payments.pay');
                }
            }
        }

        \LaravelFacebookPixel::createEvent('InitiateCheckout', ["content_ids" => 00111,"content_category" => 'Initiated checkout',"content_name" => (auth()->guard('web')->check() ? auth()->guard('web')->user()->full_name : 'Não logado'),"contents" => 'Initiated checkout',"num_items" => session()->has('cart.boloes') ? count(session()->get('cart.boloes')) : 'undefined',"currency" => "BRL","value" => session()->get('payment.credits')]);
        
        return view('web.payments.index', ['sessionId' => $sessionId]);
    }

    /**
     *
     */
    public function doPayment(Request $request)
    {
        try
        {
            if (! session()->has('payment.notEnoughCredits') && session()->get('payment.credits') < 45){
                return redirect()->route('web.credits.index')->with(['message' => 'Valor inválido, por favor selecione um valor maior']);
            }

            $referenceId = \Str::random(9);
            $descriptionBuy = session()->get('payment.credits') . " reais em créditos para " . auth()->guard('web')->user()->full_name;
            $amountValue = intval(round(session()->get('payment.credits')*100));
            $chargeData = [
                'reference_id'  => $referenceId,
                'description'   => $descriptionBuy,
                'amount'        => [ 
                    'value'     => $amountValue,
                    'currency'  => "BRL"
                ],
                'payment_method' => [
                    'type'      => "CREDIT_CARD",
                    'installments' => 1,
                    'capture'   => true,
                    'soft_descriptor' =>  'LotosFacil',
                    'card'          => [
                        "encrypted" => $request->get('cardToken')
                    ]
                ],
                "notification_urls" => [
                    route('web.payments.notifications')
                ],
                "metadata" => [
                    "customerId" => auth()->guard('web')->user()->id
                ]
            ];

            // $response = Http::withHeaders([
            //     'accept' => 'application/json',
            //     'Authorization' => 'Bearer ' . env('PAGSEGURO_TOKEN'),
            //     'x-api-version' => '4.0',
            // ])->post(env("PAGSEGURO_HOST") . 'charges', $chargeData);

            $documentData = str_replace(['.', '-', '/'], "", $request->get('document'));

            $response = Http::withHeaders([
                'accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('PAGSEGURO_TOKEN'),
                'x-api-version' => '4.0',
            ])->post(env("PAGSEGURO_HOST") . 'orders', [
                'reference_id'  => $referenceId,
                'customer'        => [ 
                    'name'      => auth()->guard('web')->user()->full_name,
                    'email'     => auth()->guard('web')->user()->email,
                    'tax_id'     => $documentData
                ],
                "items" => [
                    [
                        'reference_id' => $referenceId,
                        'name' => $descriptionBuy,
                        'quantity' => 1,
                        'unit_amount' => $amountValue
                    ]
                ],
                "charges" => [
                    $chargeData
                ],
                "notification_urls" => [
                    route('web.payments.notifications')
                ]
            ]);

            $body = $response->body();
            $jsonDecoded = json_decode($body, TRUE);

            if (isset($jsonDecoded['error_messages'])){
                throw new \Exception('Ocorreu um erro durante o pagamento');
            }

            $valueBought = $jsonDecoded['charges'][0]['amount']['value'];

            $payment = Payment::create([
                'customer_id' => auth()->guard('web')->user()->id,
                'completed' => $jsonDecoded['charges'][0]['status'] == 'PAID' ? 1 : 0,
                'gateway'   => 'pagseguro',
                'type'      => '',
                'status'    => $jsonDecoded['charges'][0]['status'],
                'code'      => $jsonDecoded['id'],
                'total'     => $valueBought,
                'url'       => ''
            ]);

            //Add the correspondent credit
            if ($jsonDecoded['charges'][0]['status'] == 'PAID'){
                //Convert the value to insert
                auth()->guard('web')->user()->add_credits(($valueBought/100));

                //Check when to do this
                if ( session()->has('payment.toPay') && session()->has('cart.boloes') && ! empty(session()->get('cart.boloes')) ){
    
                    $reserves = [];
                    if (session()->has('cart.boloes')){
                        $reserves = $this->bolaoRepo->getReservesByIds(session()->get('cart.boloes'));
                    }
        
                    if (! $reserves ){
                        throw new \Exception('Os bolões selecionados foram expirados');
                    }
        
                    foreach($reserves as $reserve){
                        if (! $reserve->customer_id){
                            $reserve->customer_id = auth()->guard('web')->user()->id;
                            $reserve->save();
                        }

                        $this->bolaoRepo->finishBolaoBuy($reserve->bolao_id, $reserve->cotas, $reserve->customer);
                    }
        
                    auth()->guard('web')->user()->remove_credits(session()->get('payment.toPay'));
                }
                //Else if the buy is only of credits
                else {
                    Mail::to(auth()->guard('web')->user()->email)->send(new CreditsBoughtMail(auth()->guard("web")->user()->getFirstName(), $valueBought, \Carbon\Carbon::now()->format('d/m/Y H:i')));
                }
            }
        }
        catch(\Exception $e){
            return redirect()->route('web.payments.index')->with(['message' => 'Não foi possível finalizar sua compra, <a href="' . route("web.staticPages.contact") . '">entre em contato</a> caso o erro persista', '']);
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

            if(session()->has('cart.customBolao')){
                
            }
            else {
                if ((! session()->has('cart.boloes') || empty(session()->get('cart.boloes')))){
                    throw new \Exception('Cart boloes not available');
                }
    
                $reserves = [];
                if (session()->has('cart.boloes')){
                    $reserves = $this->bolaoRepo->getReservesByIds(session()->get('cart.boloes'));
                }
    
                if (! $reserves ){
                    throw new \Exception('Os bolões selecionados foram expirados');
                }
    
                foreach($reserves as $reserve){
                    $this->bolaoRepo->finishBolaoBuy($reserve->bolao_id, $reserve->cotas, auth()->guard('web')->user());
                }
            }

            auth()->guard('web')->user()->remove_credits($toPay);
        }
        catch(\Exception $e){
            return redirect()->route('web.cart')->with(['message' => 'Não foi possível finalizar a sua compra', '']);
        }

        return redirect()->route('web.payments.finish_boloes');
    }

    public function finish(Request $request, $paymentId = NULL)
    {
        if ( !$paymentId){
            return redirect()->route('web.credits.index');
        }

        $payment = Payment::find($paymentId);

        if ($payment->customer_id != auth()->guard('web')->user()->id ){
            return redirect()->route('web.customers.mybuys');
        }

        $bolaoSuccessResponse = false;
        if ( session()->has('payment.toPay') && session()->has('cart.boloes')){
            $bolaoSuccessResponse = true;
        }

        $error = false;
        $customBolao = false;
        if ($payment->status != 'DECLINED'){
            $bolaoSuccessResponse = true;
            if (session()->has('cart.customBolao')){
                session()->put('cart.customBolao.customer_id', auth()->guard('web')->user()->id);

                $customBolao = true;
                try {
                    $this->bolaoRepo->finalizeBolaoCreation(session()->get('cart.customBolao'));
                }
                catch(\Exception $e){
                    $error = true;
                }
            }

            $this->_cleanUpSessions();
        }

        \LaravelFacebookPixel::createEvent('Purchase', ["content_ids" => $payment->id,"content_name" => $payment->code,"content_type" => $payment->status,"contents" => "Made via " . $payment->gateway,"num_items" => '0', "currency" => "BRL","value" => $payment->total]);
        
        if($bolaoSuccessResponse){
            return view('web.payments.finish_boloes', ['payment' => $payment, 'error' => $error, 'customBolao' => $customBolao]);
        }
        else {
            return view('web.payments.finish', ['payment' => $payment]);
        }
    }

    //This method comes directly from the directPay function
    public function finish_boloes(Request $request)
    {        
        \LaravelFacebookPixel::createEvent('Purchase', ["content_ids" => 02,"content_name" => 'Compra de cotas',"content_type" => 'PAID',"contents" => "Compra de cotas por: " . auth()->guard('web')->user()->full_name,"num_items" => session()->has('cart.boloes') ? count(session()->get('cart.boloes')) : '', "currency" => "BRL","value" => session()->get('payment.toPay')]);

        $hasCustomBolao = session()->has('cart.customBolao');

        $this->_cleanUpSessions();
        
        return view('web.payments.finish_boloes', ['customBolao' => $hasCustomBolao]);
    }

    private function _cleanUpSessions(){
        session()->forget('payment.credits');
            
        $reserves = [];
        if (session()->has('cart.boloes')){
            $reserves = $this->bolaoRepo->getReservesByIds(session()->get('cart.boloes'));

            foreach($reserves as $reserve){
                $reserve->processed = 1;
                $reserve->save();
            }
        }

        session()->forget('cart.boloes');
        session()->forget('cart.customBolao');
        session()->forget('cart.boloesData');  
        session()->forget('payment.toPay');      
        session()->forget('payment.notEnoughCredits');  
    }

    public function notifications($transactionId = '')
    {
        $payloadNotifications = $request->all();

        $payment = Payment::where('code', $transactionId)->get();

        $payment->completed = $payloadNotifications['status'] == 'PAID' ? 1 : 0;
        $payment->status = $payloadNotifications['status'];

        //Add the correspondent credit
        if ($payloadNotifications['status'] == 'PAID'){
            $customer = Customer::find($payment->customer_id);

            if ($customer){
                $customer->add_credits($payment->total);
            }
        }

        return response()->json(['message' => 'Pedido atualizado com sucesso']);
    }
}