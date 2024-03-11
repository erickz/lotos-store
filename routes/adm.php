<?php

Route::middleware('auth:adm')->group(function(){
    Route::get('/dashboard', [ 'as' => 'adm.dashboard.index', 'uses' => 'DashboardController@index']);

    //USERS:
    Route::middleware('permission:read-users')->get('/users', ['as' => 'adm.users.index', 'uses' => 'UsersController@index']);
    Route::middleware('permission:create-users')->get('/users/new', ['as' => 'adm.users.create', 'uses' => 'UsersController@create']);
    Route::middleware('permission:create-users')->post('/users', ['as' => 'adm.users.store', 'uses' => 'UsersController@store']);
    Route::middleware('permission:update-users')->get('/users/{id}', ['as' => 'adm.users.edit', 'uses' => 'UsersController@edit']);
    Route::middleware('permission:update-users')->patch('/users/{id}', ['as' => 'adm.users.update', 'uses' => 'UsersController@update']);
    Route::middleware('permission:update-users')->get('/users/{id}/password', ['as' => 'adm.users.password', 'uses' => 'UsersController@password']);
    Route::middleware('permission:update-users')->patch('/users/{id}/password', ['as' => 'adm.users.updatePassword', 'uses' => 'UsersController@updatePassword']);
    Route::middleware('permission:delete-users')->get('/users/{id}/delete', ['as' => 'adm.users.destroy', 'uses' => 'UsersController@delete']);
    Route::middleware('permission:delete-users')->delete('/users/{id?}', ['as' => 'adm.users.delete', 'uses' => 'UsersController@delete']);

    //CUSTOMERS:
    Route::middleware('permission:read-customers')->get('/customers', ['as' => 'adm.customers.index', 'uses' => 'CustomersController@index']);
    Route::middleware('permission:create-customers')->get('/customers/new', ['as' => 'adm.customers.create', 'uses' => 'CustomersController@create']);
    Route::middleware('permission:create-customers')->post('/customers', ['as' => 'adm.customers.store', 'uses' => 'CustomersController@store']);
    Route::middleware('permission:update-customers')->get('/customers/{id}', ['as' => 'adm.customers.edit', 'uses' => 'CustomersController@edit']);
    Route::middleware('permission:update-customers')->patch('/customers/{id}', ['as' => 'adm.customers.update', 'uses' => 'CustomersController@update']);
    Route::middleware('permission:delete-customers')->get('/customers/{id}/delete', ['as' => 'adm.customers.destroy', 'uses' => 'CustomersController@delete']);
    Route::middleware('permission:delete-customers')->delete('/customers/{id?}', ['as' => 'adm.customers.delete', 'uses' => 'CustomersController@delete']);
    Route::get('/customers/{id}/add_credit', ['as' => 'adm.customers.add_credit', 'uses' => 'CustomersController@add_credit']);

    Route::middleware('permission:create-customers')->get('/customers-credit/rescue', ['as' => 'adm.customers.rescue', 'uses' => 'CustomersController@rescue']);
    Route::middleware('permission:create-customers')->get('/customers-credit/{id}/rescue', ['as' => 'adm.customers.markRescued', 'uses' => 'CustomersController@markRescued']);

    //CUSTOMERS BANK:
    Route::middleware('permission:update-customers')->get('/customers/{idParent}/bank/new', ['as' => 'adm.customers.bank.create', 'uses' => 'CustomersBankController@create']);
    Route::middleware('permission:update-customers')->post('/customers/{idParent}/bank/new', ['as' => 'adm.customers.bank.store', 'uses' => 'CustomersBankController@store']);
    Route::middleware('permission:update-customers')->get('/customers/{idParent}/bank/{id}', ['as' => 'adm.customers.bank.edit', 'uses' => 'CustomersBankController@edit']);
    Route::middleware('permission:update-customers')->patch('/customers/{idParent}/bank/{id}', ['as' => 'adm.customers.bank.update', 'uses' => 'CustomersBankController@update']);
    Route::middleware('permission:update-customers')->get('/customers/{idParent}/bank/{id}/delete', ['as' => 'adm.customers.bank.destroy', 'uses' => 'CustomersBankController@delete']);
    Route::middleware('permission:update-customers')->delete('/customers/{idParent}/bank/{id?}', ['as' => 'adm.customers.bank.delete', 'uses' => 'CustomersBankController@delete']);

    //LOTERIES:
    Route::middleware('permission:read-loteries')->get('/loteries', ['as' => 'adm.loteries.index', 'uses' => 'LoteriesController@index']);
    Route::middleware('permission:read-loteries')->get('/loteries/{id}/show', ['as' => 'adm.loteries.show', 'uses' => 'LoteriesController@show']);
//    Route::middleware('permission:create-loteries')->get('/loteries/new', ['as' => 'adm.loteries.create', 'uses' => 'loteriesController@create']);
//    Route::middleware('permission:create-loteries')->post('/loteries', ['as' => 'adm.loteries.store', 'uses' => 'loteriesController@store']);
//    Route::middleware('permission:update-loteries')->get('/loteries/{id}', ['as' => 'adm.loteries.edit', 'uses' => 'loteriesController@edit']);
//    Route::middleware('permission:update-loteries')->patch('/loteries/{id}', ['as' => 'adm.loteries.update', 'uses' => 'loteriesController@update']);
//    Route::middleware('permission:delete-loteries')->get('/loteries/{id}/delete', ['as' => 'adm.loteries.destroy', 'uses' => 'loteriesController@delete']);
//    Route::middleware('permission:delete-loteries')->delete('/loteries/{id?}', ['as' => 'adm.loteries.delete', 'uses' => 'loteriesController@delete']);

    //CONCURSOS:
    Route::middleware('permission:read-concursos')->get('/concursos', ['as' => 'adm.concursos.index', 'uses' => 'ConcursosController@index']);
    Route::middleware('permission:read-concursos')->get('/concursos/todo', ['as' => 'adm.concursos.todo', 'uses' => 'ConcursosController@todo']);
    Route::middleware('permission:create-concursos')->get('/concursos/new', ['as' => 'adm.concursos.create', 'uses' => 'ConcursosController@create']);
    Route::middleware('permission:create-concursos')->post('/concursos', ['as' => 'adm.concursos.store', 'uses' => 'ConcursosController@store']);
    Route::middleware('permission:update-concursos')->get('/concursos/{id}', ['as' => 'adm.concursos.edit', 'uses' => 'ConcursosController@edit']);
    Route::middleware('permission:update-concursos')->patch('/concursos/{id}', ['as' => 'adm.concursos.update', 'uses' => 'ConcursosController@update']);
    Route::middleware('permission:delete-concursos')->get('/concursos/{id}/delete', ['as' => 'adm.concursos.destroy', 'uses' => 'ConcursosController@delete']);
    Route::middleware('permission:delete-concursos')->delete('/concursos/{id?}', ['as' => 'adm.concursos.delete', 'uses' => 'ConcursosController@delete']);
    Route::middleware('permission:update-concursos')->get('/concursos/{id}/check', ['as' => 'adm.concursos.check', 'uses' => 'ConcursosController@check']);

    Route::middleware('permission:update-concursos')->get('/concursos/{id}/see-all-games', ['as' => 'adm.concursos.allGames', 'uses' => 'ConcursosController@allGames']);
    Route::middleware('permission:update-concursos')->get('/concursos/{id}/generateCode', ['as' => 'adm.concursos.generateCode', 'uses' => 'ConcursosController@generateCode']);
    
    Route::middleware('permission:update-concursos')->get('/concursos/{id}/mark-boloes', ['as' => 'adm.concursos.markAllBoloes', 'uses' => 'ConcursosController@markAllBoloes']);
    Route::middleware('permission:update-concursos')->get('/concursos/{id}/mark-boloes/{bolaoId}', ['as' => 'adm.concursos.markBoloes', 'uses' => 'ConcursosController@markBoloes']);

    Route::middleware('permission:update-concursos')->get('/concursos/{id}/repay-boloes', ['as' => 'adm.concursos.repayAll', 'uses' => 'ConcursosController@repayAllBoloes']);
    Route::middleware('permission:update-concursos')->get('/concursos/{id}/repay-boloes/{bolaoId}', ['as' => 'adm.concursos.repayBolao', 'uses' => 'ConcursosController@repayBolao']);


    Route::middleware('permission:update-concursos')->get('/concursos/{id}/do-check', ['as' => 'adm.concursos.doCheck', 'uses' => 'ConcursosController@doCheck']);
    Route::middleware('permission:update-concursos')->get('/concursos/{id}/prize-check', ['as' => 'adm.concursos.prizeCheck', 'uses' => 'ConcursosController@prizeCheck']);
    Route::middleware('permission:update-concursos')->get('/concursos/{id}/revenue-check', ['as' => 'adm.concursos.revenueCheck', 'uses' => 'ConcursosController@revenueCheck']);

    //BOLÕES:
    Route::middleware('permission:read-boloes')->get('/boloes', ['as' => 'adm.boloes.index', 'uses' => 'BoloesController@index']);
    Route::middleware('permission:create-boloes')->get('/boloes/new', ['as' => 'adm.boloes.create', 'uses' => 'BoloesController@create']);
    Route::middleware('permission:create-boloes')->post('/boloes', ['as' => 'adm.boloes.store', 'uses' => 'BoloesController@store']);
    Route::middleware('permission:update-boloes')->get('/boloes/{id}', ['as' => 'adm.boloes.edit', 'uses' => 'BoloesController@edit']);
    Route::middleware('permission:update-boloes')->post('/boloes/{id}/add', ['as' => 'adm.boloes.addGame', 'uses' => 'BoloesController@addGame']);
    Route::middleware('permission:update-boloes')->post('/boloes/games/remove', ['as' => 'adm.boloes.removeGame', 'uses' => 'BoloesController@removeGame']);
    Route::middleware('permission:update-boloes')->patch('/boloes/{id}', ['as' => 'adm.boloes.update', 'uses' => 'BoloesController@update']);
    Route::middleware('permission:delete-boloes')->get('/boloes/{id}/delete', ['as' => 'adm.boloes.destroy', 'uses' => 'BoloesController@delete']);
    Route::middleware('permission:delete-boloes')->delete('/boloes/{id?}', ['as' => 'adm.boloes.delete', 'uses' => 'BoloesController@delete']);

    //BLOG:
    Route::get('/blog', ['as' => 'adm.blogs.index', 'uses' => 'BlogsController@index']);
    Route::get('/blog/new', ['as' => 'adm.blogs.create', 'uses' => 'BlogsController@create']);
    Route::post('/blog', ['as' => 'adm.blogs.store', 'uses' => 'BlogsController@store']);
    Route::get('/blog/{id}', ['as' => 'adm.blogs.edit', 'uses' => 'BlogsController@edit']);
    Route::patch('/blog/{id}', ['as' => 'adm.blogs.update', 'uses' => 'BlogsController@update']);
    Route::get('/blog/{id}/delete', ['as' => 'adm.blogs.destroy', 'uses' => 'BlogsController@delete']);
    Route::delete('/blog/{id?}', ['as' => 'adm.blogs.delete', 'uses' => 'BlogsController@delete']);
});