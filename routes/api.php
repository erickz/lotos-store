<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['throttle:60,1'])->post('login', ['as' => 'api.auth.doLogin', 'uses' => [LoginController::class, 'doLogin']]);

Route::middleware(['api'])->group(function(){
    Route::get('boloes/{loteryInitials}/{concursoNumber}/to-do', ['as' => 'api.boloes.todo', 'uses' => 'ChromeExtensionController@getBoloesTodo']);
    // Route::get('boloes/{id}/mark-as-done', ['as' => 'api.boloes.markAsDone', 'uses' => 'ChromeExtensionController@markAsDone']);
    Route::get('concursos/to-do', ['as' => 'api.concursos.todo', 'uses' => 'ChromeExtensionController@getConcursosTodo']);
    Route::get('loteries', ['as' => 'api.loteries.get', 'uses' => 'LoteriesController@get']);
    Route::get('loteries/{loteryAlias}', ['as' => 'api.loteries.find', 'uses' => [LoteriesController::class, 'find']]);
    Route::get('boloes/{bolaoId}/games', ['as' => 'api.boloes.games.get', 'uses' => [BoloesGamesController::class, 'get']]);
    Route::post('boloes/{bolaoId}/games', ['as' => 'api.boloes.games.store', 'uses' => [BoloesGamesController::class, 'store']]);
    Route::delete('boloes/{bolaoId}/games/{gameId}', ['as' => 'api.boloes.games.delete', 'uses' => [BoloesGamesController::class, 'delete']]);
});