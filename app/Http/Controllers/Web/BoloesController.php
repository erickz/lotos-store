<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BolaoRepositoryInterface;
use App\Models\Lotery;
use App\Models\Concurso;
use App\Models\BolaoReserve;
use App\Models\BolaoInvite;
use App\Models\Customer;
use App\Models\BolaoSuggestion;

use App\Mail\BolaoInviteMail;
use Mail;

class BoloesController extends WebBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BolaoRepositoryInterface $repository)
    {
        $this->repository = $repository;
        \LaravelFacebookPixel::createEvent('ViewContent', ["content_ids" => 00123,"content_category" => "Normal","content_name" => request()->route()->getName(),"content_type" => "Product","contents" => "a","currency" => "BRL","value" => "AAA"]);

        parent::__construct();
    }

    public function create(Request $request, $lotoAlias = '')
    {
        // if (! auth()->guard('web')->check()){
        //     return redirect()->route('web.customers.register');
        // }
        
        $loteries = NULL;
        $lotery = NULL;
        $suggestions = NULL;
        $followingConcursos = Concurso::following()->orderBy('type', 'DESC')->get();
        $currentMenu = 1;
        
        if ($lotoAlias){
            $currentMenu = 2;
            $lotery = Lotery::byInitials(strtolower($lotoAlias))->first();
            $suggestions = BolaoSuggestion::where('lotery_id', $lotery->id)->get();

            // $followingConcursos = Concurso::following()->where('lotery_id', $lotery->id)->get();
        }
        else {
            $loteries = Lotery::where('active', 1)->get();
        }

        // $luckBird = $this->generateLuckBird();

        return view('web.boloes.create', ['lotery' => $lotery, 'suggestions' => $suggestions,'followingConcursos' => $followingConcursos, 'currentMenu' => $currentMenu, 'loteries' => $loteries]);
    }

    public function configure(Request $request, $lotoAlias = '')
    {
        $lotery = Lotery::byInitials(strtoupper($lotoAlias))->first();
        $followingConcursos = Concurso::following()->where('lotery_id', $lotery->id)->orderBy('type', 'DESC')->get();
        $currentMenu = 3;
        $luckBird = $this->generateLuckBird();

        return view('web.boloes.wizard.finalize', ['currentMenu' => $currentMenu, 'lotery' => $lotery, 'followingConcursos' => $followingConcursos, 'luckBird' => $luckBird]);   
    }

    public function finalize(Request $request, $lotoAlias = '')
    {
        // if (is_null($request->get('concurso_id'))){
        //     return redirect()->back()->with(['message' => 'Não existem concursos cadastrados para a loteria em questão, favor tentar mais tarde!']);
        // }

        $lotery = Lotery::byInitials(strtoupper($lotoAlias))->first();
        $followingConcursos = Concurso::following()->where('lotery_id', $lotery->id)->orderBy('type', 'DESC')->get();
        $currentMenu = 3;
        $luckBird = $this->generateLuckBird();
        // $formData = $request->only(['concurso_id', 'keepCotas', 'price', 'qtCotas', 'totalToPay']);
        // $taxPlatform = ($formData['price'] * 0.13) * $formData['qtCotas'];
        // $revenue = ($formData['price'] * ($formData['qtCotas'])) - $taxPlatform;
        // $profit = $revenue - $formData['totalToPay'];

        return view('web.boloes.wizard.finalize', ['currentMenu' => $currentMenu, 'lotery' => $lotery, 'followingConcursos' => $followingConcursos, 'luckBird' => $luckBird]); 
    }

     /**
     * 
     */
    private function generateLuckBird()
    {
        $qualities = [
            "Próspero"
            ,"Vitorioso"
            ,"Triunfante"
            ,"Brilhante"
            ,"Sortudo"
            ,"Realizador"
            ,"Visionário"
            ,"Excelente"
            ,"Poderoso"
            ,"Abençoado"
            ,"Radiante"
            ,"Sucesso"
            ,"Encantador"
            ,"Estrelado"
            ,"Lucrativo"
            ,"Triunfal"
            ,"Inspirador"
            ,"Espetacular"
            ,"Oportunidade"
            ,"Fortunado"
            ,"Misterioso"
            ,"Maravilhoso"
            ,"Genial"
            ,"Fantástico"
            ,"Resiliente"
            ,"Fascinante"
            ,"Próspero"
            ,"Notável"
            ,"Corajoso"
            ,"Aventureiro"
            ,"Sagaz"
            ,"Valente"
            ,"Afortunado"
            ,"Perspicaz"
            ,"Carismático"
            ,"Radiante"
            ,"Surpreendente"
            ,"Estimulante"
            ,"Empreendedor"
            ,"Magnífico"
            ,"Inovador"
            ,"Empolgante"
            ,"Fantasia"
            ,"Invencível"
            ,"Desafiador"
            ,"Atrevido"
            ,"Arrojado"
            ,"Persuasivo"
            ,"Bravio"
            ,'Vital'
        ];

        $birds = [
            "Bem-te-vi"
            ,"Canário"
            ,"Coleiro"
            ,"Pintassilgo"
            ,"Sanhaçu"
            ,"Corrupião"
            ,"Tiê-sangue"
            ,"Cardeal"
            ,"Tico-tico"
            ,"Araponga"
            ,"Uirapuru"
            ,"Tucano"
            ,"Jacu"
            ,"Seriema"
            ,"Anu-branco"
            ,"Beija-flor"
            ,"Papagaio"
            ,"Gavião"
            ,"Falcão"
            ,"Socó"
            ,"Quero-quero"
            ,"João-de-barro"
            ,"Periquito"
            ,"Curicaca"
            ,"Garça"
            ,"Pica-pau"
            // ,"Rolinha"
            ,"Saracura"
            ,"Gaivota"
            ,"Suiriri"
            ,"Martim-pescador"
            ,"Surucuá"
            ,"Saíra"
            ,"Asa-branca"
            ,"Gralha-azul"
            ,"Coruja-buraqueira"
            ,"Andorinha"
            ,"Anumara"
            ,"Curiango"
            ,"Fogo-apagou"
            ,"Maria-preta"
            ,"Sanhaço-cinzento"
            ,"Tico-tico-rei"
        ];

        $generatedName = $birds[rand(0, (count($birds)-1))] . ' ' . $qualities[rand(0, (count($qualities)-1))];

        return $generatedName;
    }

    public function store(Request $request, $lotoAlias = '')
    {
        $lotery = Lotery::byInitials(strtoupper($lotoAlias))->first();
        // $followingConcursos = Concurso::following()->where('lotery_id', $lotery->id)->get();
        
        if (! $lotery ){
            return redirect()->back()->with(['message' => 'Loteria não encontrada', 'error' => 1]);
        }

        if (! $request->has('games')){
            return redirect()->back()->with(['message' => 'Erro ao enviar jogos', 'error' => 1]); 
        }

        if (! $this->repository->priceIsValid($request->get('games'), $request->get('totalToPay'), $lotery)){
            return redirect()->back()->with(['message' => 'Valor total inválido, atualize seus jogos e caso o erro persista entre em contato.', 'error' => 1]); 
        }

        $customerId = auth()->guard('web')->check() ? auth()->guard('web')->user()->id : NULL;
        $keepCotas = $request->get('keepCotas');
        $games = $request->get('games');

        $qtGames = count($games);
        $chances = $lotery->calculateChances($games, $lotery->id);

        try {
            $newBolao = $this->repository->finalizeBolaoCreation([
                'lotery_id' => $lotery->id,
                'lotery_name' => $lotery->name,
                'customer_id' => $customerId,
                'concurso_id' => $request->get('concurso_id'),
                'active' => 0,
                'name' => $request->has('luckBird') ? $request->get('luckBird') : $this->generateLuckBird(),
                'display_for_selling' => 1,
                'price' => $request->get('price'),
                'keepCotas' => $keepCotas,
                'cotas' => $request->get('qtCotas'),
                'cotas_available' => $request->get('qtCotas') - $keepCotas,
                'description' => $request->get('description'),
                'games' => $games,
                'quantity_games' => $qtGames,
                'chances' => $chances,
                'total_value' => $request->get('totalToPay'),
                //Used in sessions:
                'totalToPay' => $request->get('totalToPay')
            ]);
        }
        catch (\Exception $e){
            return redirect()->back()->with(['message' => 'Error ocurred', 'error' => 1]); 
        }

        $bolaoData = ['bolao_id' => $newBolao->id];

        if (! auth()->guard('web')->check() || auth()->guard('web')->user()->credits < $request->get('totalToPay')){
            session()->put('payment.total', $request->get('totalToPay'));
            session()->put('cart.customBolao', $bolaoData);
            session()->forget('payment.onlyCredits');

            return redirect()->route('web.payments.index');
        }
        else {
            session()->put('cart.customBolao', $bolaoData);
            session()->forget('payment.onlyCredits');

            $this->repository->activateBolao($newBolao->id);
            auth()->guard('web')->user()->remove_credits($request->get('totalToPay'));
    
            return redirect()->route('web.payments.finish_boloes')->with(['message' => "Bolão criado com sucesso! Confira a <a href='" . route("web.boloes.listing") . "'>lista de bolões</a> para visualizá-lo!", 'error' => 0]);    
        }
    }

    /**
     * 
     */
    public function getGames(Request $request, $bolaoId)
    {
        try{

            $bolao = $bolao = $this->repository->find($bolaoId);
            $bolao->visits = $bolao->visits + 1;
            $bolao->save();

            $games = $bolao->games()->orderBy('quantity_numbers', 'DESC')->get();
        }
        catch( \Exception $e){
            return response()->json(['message' => $e->getMessage(), 'error' => 1], 400);
        }

        return view('web.boloes.games_list', ['games' => $games, 'bolao' => $bolao, 'shareButtons' => $this->getShareButtons()]);
    }

    /**
     * 
     */
    public function getSuggestions(Request $request, $suggestionId)
    {
        try{
            $suggestion = BolaoSuggestion::find($suggestionId);
        }
        catch( \Exception $e){
            return response()->json(['message' => $e->getMessage(), 'error' => 1], 400);
        }

        $games = $suggestion->generateGames();

        //Get the last concurso
        $followingConcursos = Concurso::following()->orderBy('type', 'DESC')->get();

        return view('web.boloes.bolao_suggestions', ['suggestion' => $suggestion, 'games' => $games, 'lotery' => $suggestion->lotery, 'followingConcursos' => $followingConcursos]);
    }

    /**
     * 
     */
    public function buySuggestion(Request $request, $suggestionId)
    {
        try{
            $suggestion = BolaoSuggestion::find($suggestionId);
        }
        catch( \Exception $e){
            return response()->json(['message' => $e->getMessage(), 'error' => 1], 400);
        }

        $games = $suggestion->generateGames();
        $lotery = $suggestion->lotery;
        $customerId = auth()->guard('web')->user()->id;
        $chances = $lotery->calculateChances($games, $lotery->id);
        
        $lastConcurso = Concurso::following()->where('lotery_id', $lotery->id)->first();
        
        try {
            $newBolao = $this->repository->finalizeBolaoCreation([
                'lotery_id' => $lotery->id,
                'lotery_name' => $lotery->name,
                'customer_id' => $customerId,
                'concurso_id' => $lastConcurso->id,
                'active' => 0,
                'name' => $suggestion->buildName(strtoupper($lotery->initials), $lastConcurso->number),
                'display_for_selling' => 1,
                'price' => $suggestion->price_cota,
                'keepCotas' => 1,
                'cotas' => $suggestion->cotas,
                'cotas_available' => $suggestion->cotas,
                'description' => $suggestion->buildDescription(),
                'games' => $games,
                'quantity_games' => count($games),
                'chances' => $chances,
                'total_value' => $suggestion->price,
                //Used in sessions:
                'totalToPay' => $suggestion->price
            ]);
        }
        catch (\Exception $e){
            return redirect()->back()->with(['message' => 'Error ocurred', 'error' => 1]); 
        }

        $bolaoData = ['bolao_id' => $newBolao->id];

        if (! auth()->guard('web')->check() || auth()->guard('web')->user()->credits < $suggestion->price){
            session()->put('payment.total', $suggestion->price);
            session()->put('cart.customBolao', $bolaoData);
            session()->forget('payment.onlyCredits');

            return response()->json(['url' => route('web.payments.index')]);
        }
        else {
            session()->put('cart.customBolao', $bolaoData);
            session()->forget('payment.onlyCredits');

            $this->repository->activateBolao($newBolao->id);
            auth()->guard('web')->user()->remove_credits($suggestion->price);
    
            return response()->json(['url' => route('web.payments.finish_boloes')]);    
        }
    }

    /**
     * 
     */
    public function getStats(Request $request, $bolaoId)
    {
        try{
            $bolao = $bolao = $this->repository->find($bolaoId);
            
            if (auth()->guard('web')->user()->id != $bolao->customer_id){
                throw new \Exception('Forbidden');
            }
        }
        catch( \Exception $e){
            return response()->json(['message' => $e->getMessage(), 'error' => 1], 400);
        }

        return view('web.boloes.bolao_stats', ['bolao' => $bolao, 'keptCotas' => $bolao->buyers()->where('customer_id', auth()->guard('web')->user()->id)->get()->sum('cotas')]);
    }

    /**
     * 
     */
    public function inviteByGivingCotas(Request $request, $bolaoId)
    {
        try {
            $bolao = $bolao = $this->repository->find($bolaoId);
            
            if (auth()->guard('web')->user()->id != $bolao->customer_id){
                throw new \Exception('Forbidden');
            }
        }
        catch( \Exception $e){
            return response()->json(['message' => $e->getMessage(), 'error' => 1], 400);
        }

        return view('web.boloes.bolao_invite', ['bolao' => $bolao]);
    }

    /**
     * 
     */
    public function getInvites(Request $request, $bolaoId)
    {
        try {
            $bolao = $bolao = $this->repository->find($bolaoId);
            
            if (auth()->guard('web')->user()->id != $bolao->customer_id){
                throw new \Exception('Forbidden');
            }

            $invites = $bolao->getFormattedInvites();
        }
        catch( \Exception $e){
            return response()->json(['message' => $e->getMessage(), 'error' => 1], 400);
        }

        return response()->json(['data' => $invites]);
    }

    /**
     * 
     */
    public function doInvite(Request $request, $bolaoId)
    {
        try {
            $bolao = $this->repository->find($bolaoId);

            $validated = $request->validate([
                'email' => 'required|email'
            ]);

            if ( $request->get('cotas') <= 0){
                throw new \Exception('A cota selecionada é inválida');
            }
            
            if (auth()->guard('web')->user()->id != $bolao->customer_id){
                throw new \Exception('Você não tem permissões para fazer doações deste bolão');
            }

            if (! $bolao->canTransactionCotas()){
                throw new \Exception('O convite foi expirado ou está proximo de expirar para transacionar cotas');
            }

            $token = \Illuminate\Support\Str::random(32);
            $nextDay = \Carbon\Carbon::now()->addDay(1)->format('Y-m-d H:i:s');

            $invite = BolaoInvite::create([
                'bolao_id' => $bolaoId,
                'owner_id' => auth()->guard('web')->user()->id,
                'customer_id' => null,
                'email' => $request->get('email'),
                'token' => $token,
                'cotas' => $request->get('cotas'),
                'expire_at' => $nextDay
            ]);            

            Mail::to($invite->email)->send(new BolaoInviteMail([
                'invite' => $invite
                ,'concurso' => $invite->bolao->concurso
                ,'bolao' => $invite->bolao
                ,'owner' => $invite->owner
                ,'lotery' => $invite->bolao->lotery
            ]));
        }
        catch( \Exception $e){
            return response()->json(['message' => $e->getMessage(), 'error' => 1], 400);
        }

        return response()->json(['message' => 'Convite enviado com sucesso!', 'error' => 0, 'data' => $bolao->getFormattedInvites()]);
    }

    /**
     * 
     */
    public function receiveInvite(Request $request, $token)
    {
        $message = '';
        try {
            $bolaoInvite = BolaoInvite::where('token', $token)->first();

            if (auth()->guard('web')->check()){
                return redirect()->route('web.customers.claimInvite', $bolaoInvite->id);
            }

            if (! $bolaoInvite){
                throw new \Exception('O Token do convite é inválido');
            }

            $bolao = $bolaoInvite->bolao;

            if (! $bolao->canTransactionCotas()){
                throw new \Exception('O convite foi expirado e não pode transacionar cotas');
            }

            $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            
            if ( $now >= $bolaoInvite->expire_at ){
                throw new \Exception('O convite foi expirado');
            }
        }
        catch( \Exception $e){
            $message = $e->getMessage();
        }

        return view('web.customers.receive_invite', [
            'message' => $message,
            'invite' => $bolaoInvite
        ]);
    }

    public function claimInvite(Request $request, $idInvite)
    {
        if (! auth()->guard('web')->check()){
            return redirect()->back()->with(['message' => 'Must to be logged in ']);
        }

        $message = null;
        $error = 0;
        
        try {
            $bolaoInvite = BolaoInvite::find($idInvite);
            $bolao = $bolaoInvite->bolao;

            if ($bolao->checked){
                throw new \Exception('O bolão já foi verificado e portanto não pode transacionar cotas');
            }

            if (! $bolao->canTransactionCotas()){
                throw new \Exception('O convite foi expirado e não pode transacionar cotas');
            }

            $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            
            if ( $now >= $bolaoInvite->expire_at ){
                throw new \Exception('O convite foi expirado');
            }

            if ( $bolaoInvite->claimed){
                throw new \Exception('O convite já foi efetivado');
            }

            if ( $bolaoInvite->cotas > $bolaoInvite->bolao->cotas_available){
                $error = 1;
                throw new \Exception('A quantidade de cotas do convite está indisponível nesse bolão');
            }

            $bolaoInvite->claimed = 1;
            $bolaoInvite->customer_id = auth()->guard('web')->user()->id;
            $bolaoInvite->save();

            $this->repository->finishBolaoBuy($bolaoInvite->bolao->id, $bolaoInvite->cotas, auth()->guard('web')->user(), FALSE);
        }
        catch( \Exception $e){
            $message = $e->getMessage();
        }

        return view('web.customers.claim_invite', [
            'message' => $message,
            'invite' => $bolaoInvite
        ]);
    }

    public function list(Request $request)
    {        
        $followingConcursos = Concurso::following()->whereIn('lotery_id', [1, 2, 3, 4])->get();

        $boloesSelected = [];

        $specialBoloes = $this->repository->getSpecialBoloes($boloesSelected);
        $boloesSelected = array_merge($boloesSelected, $specialBoloes->pluck('id')->toArray());

        $mostPopulars = $this->repository->getMostPopular($boloesSelected);
        $boloesSelected = array_merge($boloesSelected, $mostPopulars->pluck('id')->toArray());

        // $biggestChances = $this->repository->getBiggestChances($boloesSelected);
        // $boloesSelected = array_merge($boloesSelected, $biggestChances->pluck('id')->toArray());

        // $mostEconomics = $this->repository->getMostEconomics($boloesSelected);

        return view('web.boloes.listing', ['followingConcursos' => $followingConcursos, 'specialBoloes' => $specialBoloes, 'mostPopulars' => $mostPopulars, 'biggestChances' => $biggestChances, 'mostEconomics' => $mostEconomics]);
    }

    public function listByLot(Request $request, $loterySlug = 'megasena')
    {   
        $lotery = Lotery::getBySlug($loterySlug)->first();  
        
        if (! $lotery){
            return redirect()->route('web.home');
        }

        $filters['lotery_id'] = $lotery->id;
        
        $boloes = $this->repository->getToListing($filters);
        $followingConcursos = Concurso::following()->whereIn('lotery_id', [1, 2, 3, 4])->get();

        return view('web.boloes.listing_all', ['followingConcursos' => $followingConcursos, 'boloes' => $boloes, 'lotery' => $lotery]);
    }

    public function listAll(Request $request)
    {
        $filters = [];

        if ( $request->has('lotery_id') && $request->get('lotery_id') ){
            $filters['lotery_id'] = $request->get('lotery_id');
        }

        if ( $request->has('concurso_id') && $request->get('concurso_id') ){
            $filters['concurso_id'] = $request->get('concurso_id');
        }
        
        if ( $request->has('order_by') && $request->get('order_by') ){
            $filters['order_by'] = $request->get('order_by');
        }
        
        $boloes = $this->repository->getToListing($filters);
        $followingConcursos = Concurso::following()->whereIn('lotery_id', [1, 2, 3, 4])->get();

        return view('web.boloes.listing_all', ['followingConcursos' => $followingConcursos, 'boloes' => $boloes]);
    }

    public function activate(Request $request, $bolaoId = NULL)
    {
        if( ! auth()->guard('web')->check()){
            return back();
        }

        $bolao = $this->repository->find($bolaoId);

        if( ! $bolao){
            return back();
        }

        if (! $bolao->customer_id = auth()->guard('web')->user()->id){
            return back();
        }

        if (auth()->guard('web')->user()->credits < $bolao->total_value){
            $totalToPay = $bolao->total_value;

            session()->put('payment.total', $totalToPay);
            session()->put('cart.customBolao', ['bolao_id' => $bolao->id]);
            session()->forget('payment.onlyCredits');

            return redirect()->route('web.payments.index');
        }
        else {
            try{
                $bolao = $this->repository->activateBolao($bolao->id);

                auth()->guard('web')->user()->remove_credits($bolao->total_value);
            }
            catch(\Exception $e){
                return back()->with(['message' => $e->getMessage()]);
            }
        }

        return back()->with(['message' => 'Bolão ativado com sucesso!']);
    }

    public function getFromCustomer(Request $request, $customerId = NULL)
    {
        $filters = [];

        if ( $request->has('lotery_id') && $request->get('lotery_id') ){
            $filters['lotery_id'] = $request->get('lotery_id');
        }

        if ( $request->has('concurso_id') && $request->get('concurso_id') ){
            $filters['concurso_id'] = $request->get('concurso_id');
        }
        
        if ( $request->has('order_by') && $request->get('order_by') ){
            $filters['order_by'] = $request->get('order_by');
        }
        
        $boloes = $this->repository->getToListing($filters, $customerId);
        $followingConcursos = Concurso::following()->whereIn('lotery_id', [1, 2, 3, 4])->get();
        
        $customer = Customer::find($customerId);

        if (! $customer){
            return redirect()->route('web.home');
        }

        $shareButtons = $this->getShareButtons($customer->getFirstName());

        $bolaoFeatured = null;
        if($boloes->count() > 0){
            $bolaoFeatured = $boloes[0];

            unset($boloes[0]);
        }

        return view('web.boloes.listing-customer', ['boloes' => $boloes, 'bolaoFeatured' => $bolaoFeatured, 'followingConcursos' => $followingConcursos, 'customer' => $customer, 'shareButtons' => $shareButtons]);
    }
    
    private function getShareButtons($customerName = NULL){
        $shareButtons = \Share::page(url()->current(), '🎉🏆 Junte-se a Bolões vencedores e receba prêmios imperdíveis! 🏆

        🔥 Confira a lista dos melhores grupos de jogos ' . ($customerName ? 'de ' . $customerName : '') . 'e venha ganhar prêmios! 💰🚀
        
        👉 ' . url()->current())
            ->facebook()
            ->twitter()
            ->telegram()
            ->whatsapp()
        ;

        return $shareButtons;
    }

    /**
     * 
     */
    public function buy(Request $request, $bolaoId = NULL)
    {
        try{
            $bolao = $this->repository->find($bolaoId);
        }
        catch( \Exception $e){
            return response()->json(['message' => $e->getMessage(), 'error' => 1], 400);
        }

        return view('web.boloes.buy_confirmation', ['bolao' => $bolao, 'cotasSelected' => request()->get('cotas')]);
    }

    /**
     * 
     */
    public function finishBuy(Request $request, $bolaoId = NULL)
    {
        if (! $bolaoId){
            return response()->json(['message' => 'Bolão não encontrado', 'error' => 1]); 
        }

        if (! request()->has('cotas')){
            return response()->json(['message' => 'Quantidade de cotas não passada', 'error' => 1]); 
        }

        try {
            $customerId = auth()->guard('web')->check() ? auth()->guard('web')->user()->id : null;
            $cotasSelected = request()->get('cotas');

            if (session()->has('cart.boloes') && ! empty(session()->get('cart.boloes'))){
                $reserves = $this->repository->getReservesByIds(session()->get('cart.boloes'));
    
                foreach($reserves as $reserve){
                    if ($reserve->bolao_id == $bolaoId){
                        if ( $cotasSelected <= $reserve->bolao->getAvailableCotas() ){
                            $reserve->cotas = $cotasSelected;
                            $reserve->save();
                        }
                    }
                }

                if (! $reserves->contains('bolao_id', $bolaoId)){
                    $reserve = $this->repository->reserveCotas($bolaoId, $customerId, $cotasSelected);
                    session()->push('cart.boloes', $reserve->id);
                }                        
            }
            else {
                $reserve = $this->repository->reserveCotas($bolaoId, $customerId, $cotasSelected);
                session()->push('cart.boloes', $reserve->id);
            }

            $bolao = $this->repository->find($bolaoId);
            \LaravelFacebookPixel::createEvent('AddToCart', ["content_ids" => $bolao->id,"content_category" => $bolao->lotery->name,"content_name" => $bolao->name,"content_type" => "Product","contents" => $bolao->games->count() . ' jogos.',"currency" => "BRL","value" => $bolao->price]);

            // $bolao = $this->repository->finishBolaoBuy($bolaoId, $cotasSelected, $customer);

            // $buyTotalPrice = $bolao->price * $cotasSelected;

            // $customer->remove_credits($buyTotalPrice);
        }
        catch (\Exception $e){
            return response()->json(['message' => $e->getMessage(), 'error' => 1], 400);
        }

        $plural = ($cotasSelected > 1 ? 's' : '');


        return response()->json(['message' => "Cota" . ($plural) . " adicionada" . ($plural) . " ao carrinho e reservada" . ($plural) . " por 15 minutos. <a class='text-white' href='" . route('web.cart')  . "'><u>Clique aqui para visualizar</u></a> <button type='button' class='close pe-2 position-absolute top-0 right-0' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>", 'error' => 0, 'cartItemsQt' => count(session()->get('cart.boloes')), 'redirectTo' => route('web.customers.bets')]);
    }
}
