<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\BolaoRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Payment;
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
    public function __construct(PaymentRepositoryInterface $repository, BolaoRepositoryInterface $bolaoRepo)
    {
        $this->repository = $repository;
        $this->bolaoRepo = $bolaoRepo;

        parent::__construct();
    }

    
    public function index(Request $request)
    {
        if (! auth()->guard('web')->check()){
            return redirect()->route('web.cart.customer');
        }

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
                        $reserve->customer_id = auth()->guard('web')->user()->id;
                        $reserve->save();
                    }
                }
            }

            $this->calculateTheCreditsDiffToPay();

            //In order to execute the payment, It's important to keep this execution after the cotas are claimed
            if (auth()->guard('web')->user()->credits >= session()->get('payment.total')){
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
                $lotery = Lotery::find(session()->get('cart.customBolao.lotery_id'));
                return redirect()->route('web.boloes.config', [$lotery->initials])->with(['message' => 'Não foi possível iniciar o pagamento', ['credits' => $request->get('credits')]]);
            }
            else {
                return redirect()->back()->with(['message' => 'Não foi possível iniciar o pagamento', ['credits' => $request->get('credits')]]);
            }
        }

        \LaravelFacebookPixel::createEvent('InitiateCheckout', ["content_ids" => 00111, "content_category" => 'Initiated checkout',"content_name" => (auth()->guard('web')->check() ? auth()->guard('web')->user()->full_name : 'Não logado'),"contents" => 'Initiated checkout',"num_items" => session()->has('cart.boloes') ? count(session()->get('cart.boloes')) : '1',"currency" => "BRL","value" => session()->get('payment.total')]);
        
        return view('web.payments.index', ['sessionId' => $sessionId]);
    }

    /**
     *
     */
    public function doPayment(Request $request)
    {
        try
        {
            $referenceId = \Str::random(9);
            $descriptionBuy = session()->get('payment.toPay') . " reais em créditos para " . auth()->guard('web')->user()->full_name;
            $amountValue = intval(round(session()->get('payment.toPay')*100));
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

            //CPF
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

            if (! $jsonDecoded || isset($jsonDecoded['error_messages'])){
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
                $paidValue = $valueBought/100;
                //Convert the value to insert
                auth()->guard('web')->user()->add_credits($paidValue);

                //Check when to do this
                if ((session()->has('cart.boloes') || session()->has('cart.customBolao')) && ! session()->has('payment.onlyCredits')){
    
                    if(session()->has('cart.boloes') && ! session()->has('payment.onlyCredits')){
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

                        auth()->guard('web')->user()->remove_credits(session()->get('payment.total'));
                    }
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

            if (! session()->has('payment.onlyCredits')){
                if (session()->has('cart.customBolao') && !session()->has('cart.boloes')){
                    session()->put('cart.customBolao.customer_id', auth()->guard('web')->user()->id);

                    $customBolao = true;
                    try {
                        $this->bolaoRepo->finalizeBolaoCreation(session()->get('cart.customBolao'));
                    }
                    catch(\Exception $e){
                        $error = true;
                    }
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
                    }

                    auth()->guard('web')->user()->remove_credits($toPay);
                }
            }
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

        $error = false;
        $customBolao = false;

        if ($payment->status != 'DECLINED'){
            if (session()->has('cart.customBolao') && !session()->has('cart.boloes')){
                session()->put('cart.customBolao.customer_id', auth()->guard('web')->user()->id);

                $customBolao = true;
                try {
                    $this->bolaoRepo->finalizeBolaoCreation(session()->get('cart.customBolao'));
                }
                catch(\Exception $e){
                    $error = true;
                }
            }
        }

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
    }

    private function _cleanUpSessions(){            
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
        session()->forget('payment.total');      
        session()->forget('payment.toPay');  
        session()->forget('payment.toPayDiff');  
        session()->forget('payment.isMinimum');
    }

    public function notifications(Request $request, $transactionId = '')
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