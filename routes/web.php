<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'web.home', 'uses' => 'HomeController@index']);
// Route::get('/nao-encontrada', ['as' => 'web.404', 'uses' => 'HomeController@notfound']);

Route::get('sitemap.xml', ['as' => 'web.sitemap', 'uses' => 'StaticPagesController@sitemap']);

//--Pagseguro
Route::get('pagamentos/callback', ['as' => 'web.pagseguro.callback', 'uses' => 'PaymentsController@callback']);
Route::get('pagamentos/notificacoes', ['as' => 'web.pagseguro.notifications', 'uses' => 'PaymentsController@notifications']);

Route::post('/newsletter', [ 'as' => 'web.newsletter.store', 'uses' => [NewsletterController::class, 'store']]);

//Customers
Route::get('cadastre-se', ['as' => 'web.customers.register', 'uses' => 'CustomersController@register']);
Route::post('cadastre-se', ['as' => 'web.customers.store', 'uses' => 'CustomersController@store']);

//Bolões
Route::get('boloes', ['as' => 'web.boloes.listing', 'uses' => 'BoloesController@list']);
Route::get('{loteryName}/boloes', ['as' => 'web.boloes.listingByLot', 'uses' => 'BoloesController@listByLot']);
Route::get('boloes/todos', ['as' => 'web.boloes.listing_all', 'uses' => 'BoloesController@listAll']);
Route::get('boloes/criar/{lotoAlias?}', ['as' => 'web.boloes.create', 'uses' => 'BoloesController@create']);
Route::get('boloes/configurar/{lotoAlias?}', ['as' => 'web.boloes.config', 'uses' => 'BoloesController@configure']);
Route::post('boloes/finalizar/{lotoAlias?}', ['as' => 'web.boloes.finalize', 'uses' => 'BoloesController@finalize']);
Route::post('boloes/criar/{lotoAlias?}', ['as' => 'web.boloes.store', 'uses' => 'BoloesController@store']);
Route::get('boloes/{bolaoId}/games', ['as' => 'web.boloes.games', 'uses' => 'BoloesController@getGames']);
Route::get('boloes/{suggestionId}/suggestions', ['as' => 'web.boloes.suggestions', 'uses' => 'BoloesController@getSuggestions']);
Route::get('boloes/{customerId}/{alias?}/e', ['as' => 'web.boloes.customer', 'uses' => 'BoloesController@getFromCustomer']);

Route::get('boloes/receive_invite/{token}', ['as' => 'web.customers.receiveInvite', 'uses' => 'BoloesController@receiveInvite']);

Route::middleware('auth:web')->group(function(){
    Route::get('boloes/claim_invite/{inviteId}', ['as' => 'web.customers.claimInvite', 'uses' => 'BoloesController@claimInvite']);
});

Route::get('boloes/{bolaoId}/comprar', ['as' => 'web.boloes.buy', 'uses' => 'BoloesController@buy']);
Route::post('boloes/{bolaoId}/comprar', ['as' => 'web.boloes.finishbuy', 'uses' => 'BoloesController@finishBuy']);

//Pagina de resultados
Route::get('ultimos-resultados', ['as' => 'web.results', 'uses' => 'ResultsController@index']);
Route::get('ultimo-resultado/{loteryName}', ['as' => 'web.results.byLotery', 'uses' => 'ResultsController@displayByLotery']);

Route::get('megasena', ['as' => 'web.loteries.megasena', 'uses' => 'StaticPagesController@loteries']);
Route::get('mega-da-virada', ['as' => 'web.loteries.megasenaSpecial', 'uses' => 'StaticPagesController@loteriesSpecial']);
Route::get('lotofacil', ['as' => 'web.loteries.lotofacil', 'uses' => 'StaticPagesController@loteries']);
Route::get('lotofacil-de-independencia', ['as' => 'web.loteries.lotofacilSpecial', 'uses' => 'StaticPagesController@loteriesSpecial']);
Route::get('quina', ['as' => 'web.loteries.quina', 'uses' => 'StaticPagesController@loteries']);
Route::get('quina-de-sao-joao', ['as' => 'web.loteries.quinaSpecial', 'uses' => 'StaticPagesController@loteriesSpecial']);
Route::get('duplasena', ['as' => 'web.loteries.duplasena', 'uses' => 'StaticPagesController@loteries']);
Route::get('dupla-sena-de-pascoa', ['as' => 'web.loteries.duplasenaSpecial', 'uses' => 'StaticPagesController@loteriesSpecial']);

//Cart
Route::get('meu-carrinho', ['as' => 'web.cart', 'uses' => 'CartController@index']);
Route::get('meu-carrinho/cliente', ['as' => 'web.cart.customer', 'uses' => 'CartController@customerManagement']);
Route::post('meu-carrinho/remover-item', ['as' => 'web.cart.removeItem', 'uses' => 'CartController@removeItem']);
Route::post('meu-carrinho/atualizar-quantidade', ['as' => 'web.cart.updateItem', 'uses' => 'CartController@updateItem']);
Route::get('meu-carrinho/triagem', ['as' => 'web.cart.screening', 'uses' => 'CartController@screening']);

//Paginas estáticas
Route::get('como-funciona', ['as' => 'web.staticPages.howItWorks', 'uses' => 'StaticPagesController@howItWorks']);
Route::get('sobre-nos', ['as' => 'web.staticPages.about', 'uses' => 'StaticPagesController@about']);
Route::get('faq', ['as' => 'web.staticPages.faq', 'uses' => 'StaticPagesController@faq']);
Route::get('termos-de-uso', ['as' => 'web.staticPages.terms', 'uses' => 'StaticPagesController@terms']);
Route::get('contato', ['as' => 'web.staticPages.contact', 'uses' => 'StaticPagesController@contact']);
Route::post('contato', ['as' => 'web.staticPages.contactPost', 'uses' => 'StaticPagesController@contactPost']);
Route::get('adquire-sua-propria-plataforma', ['as' => 'web.staticPages.platform', 'uses' => 'StaticPagesController@platform']);
Route::post('adquire-sua-propria-plataforma', ['as' => 'web.staticPages.postPlatform', 'uses' => 'StaticPagesController@sendEmailPlatform']);

//
Route::get('blog', ['as' => 'web.blog.index', 'uses' => 'BlogController@index']);

//Blog
Route::get('blog', ['as' => 'web.blog.index', 'uses' => 'BlogController@index']);
Route::get('blog/{slug?}', ['as' => 'web.blog.show', 'uses' => 'BlogController@show']);

//Payments
Route::get('pagamentos', ['as' => 'web.payments.index', 'uses' => 'PaymentsController@index']);
Route::get('pagamentos/pagar', ['as' => 'web.payments.pay', 'uses' => 'PaymentsController@pay']);
Route::post('pagamentos', ['as' => 'web.payments.store', 'uses' => 'PaymentsController@doPayment']);
Route::middleware('auth:web')->get('pagamentos/{paymentId}/finalizar', ['as' => 'web.payments.finish', 'uses' => 'PaymentsController@finish']);
Route::middleware('auth:web')->get('pagamentos/compra_finalizada', ['as' => 'web.payments.finish_boloes', 'uses' => 'PaymentsController@finish_boloes']);
Route::withoutMiddleware('web')->middleware('web-wtoken')->post('pagamentos/notificacoes', ['as' => 'web.payments.notifications', 'uses' => 'PaymentsController@notifications']);
// Route::get('pagamentos/callback/{code}', ['as' => 'web.payments.callback', 'uses' => 'PaymentsController@callback']);

//Login
Route::middleware('throttle:10')->post('clientes/login', ['as' => 'web.customers.login', 'uses' => 'LoginController@doLogin']);

//Area do cliente
Route::middleware('auth:web')->group(function(){
    Route::get('logout', ['as' => 'web.customers.logout', 'uses' => 'LoginController@logout']);

    Route::get('minhas-compras', ['as' => 'web.customers.mybuys', 'uses' => 'CustomersController@myBuys']);
    Route::get('jogos', ['as' => 'web.customers.bets', 'uses' => 'CustomersController@myBets']);

    // Route::get('historico-de-creditos', ['as' => 'web.customers.creditsHistory', 'uses' => 'CustomersController@creditsHistory']);
    
    Route::get('meu-perfil', ['as' => 'web.customers.profile', 'uses' => 'CustomersController@myPanel']);

    Route::get('boloes/{bolaoId}/stats', ['as' => 'web.boloes.stats', 'uses' => 'BoloesController@getStats']);
    Route::get('boloes/{bolaoId}/get-invites', ['as' => 'web.boloes.getInvites', 'uses' => 'BoloesController@getInvites']);
    Route::get('boloes/{bolaoId}/invite', ['as' => 'web.boloes.invite', 'uses' => 'BoloesController@inviteByGivingCotas']);
    Route::post('boloes/{bolaoId}/invite', ['as' => 'web.boloes.doInvite', 'uses' => 'BoloesController@doInvite']);


    Route::get('meus-dados', ['as' => 'web.customers.edit', 'uses' => 'CustomersController@edit']);
    Route::post('meus-dados/editar', ['as' => 'web.customers.update', 'uses' => 'CustomersController@update']);

    //Creditos
    Route::get('creditos', ['as' => 'web.customers.rescue', 'uses' => 'CustomersController@rescue']);
    Route::post('creditos', ['as' => 'web.credits.index', 'uses' => 'CreditsController@index']);
    Route::post('resgatar-creditos', ['as' => 'web.customers.rescueSave', 'uses' => 'CustomersController@update_rescue']);
});