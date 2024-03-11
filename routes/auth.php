<?php

//Login
Route::get('/', [ 'as' => 'adm.auth.index', 'uses' => 'LoginController@index']);
Route::post('/', [ 'as' => 'adm.auth.doLogin', 'uses' => 'LoginController@doLogin']);
Route::get('/logout', [ 'as' => 'adm.auth.logout', 'uses' => 'LoginController@logout']);

//Recover password
Route::get('/password/recover', [ 'as' => 'adm.auth.recover', 'uses' => 'ForgotPasswordController@forgotPasswordForm']);
Route::post('/password/recover', [ 'as' => 'adm.auth.sendRecovery', 'uses' => 'ForgotPasswordController@sendEmail']);
Route::get('/password/reset/{token}', [ 'as' => 'adm.auth.reset', 'uses' => 'ResetPasswordController@resetForm']);
Route::post('/password/reset/{token}', [ 'as' => 'adm.auth.doReset', 'uses' => 'ResetPasswordController@doReset']);

//Verify Email
Route::get('/email/verify', ['as' => 'adm.auth.noticeVerification', 'uses' => 'VerificationController@show']);
Route::get('/email/verify/{id}', ['as' => 'adm.auth.verifyEmail', 'uses' => 'VerificationController@verify']);
Route::get('/email/resend', ['as' => 'adm.auth.resendVerificationEmail', 'uses' => 'VerificationController@resend']);