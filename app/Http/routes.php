<?php

Route::group(['prefix' => 'painel', 'middleware' => 'auth:1'], function(){
    
    Route::controller('usuarios', 'Painel\UsuarioController');
    
    Route::controller('cronicas', 'Painel\CronicaController');
    
    Route::controller('relatorios', 'Painel\RelatorioController');

    Route::controller('/', 'Painel\PainelController');
});

Route::group(['prefix' => 'terminal', 'middleware' => 'auth.tipo:2'], function(){
    
    Route::controller('home', 'Terminal\HomeController');
    Route::controller('/', 'Terminal\HomeController');
});

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');


// Password reset link request routes...
//Route::get('recuperar-senha', 'Auth\PasswordController@getEmail');
Route::post('recuperar-senha', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('resetar-senha/{token}', 'Auth\PasswordController@getReset');
Route::post('resetar-senha/', 'Auth\PasswordController@postReset');

//Rota / irá direcionar para o login
Route::controller('/', 'HomeController');