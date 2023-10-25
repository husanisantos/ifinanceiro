<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


Route::group([

    'middleware' => CorsMiddleware::class,
    'prefix'    => '/api/v1'

], function () {

    Route::group(['prefix' => '/auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('check', 'AuthController@check');
    });

    // ROUTES WITH AUTH
    Route::group(['middleware' => 'auth:api'], function () {
        
        Route::post('/auth/refresh', 'AuthController@refresh');

        Route::group(['prefix' => 'contas/pagar'], function () {

            Route::get('/', 'ContasPagarController@getAll');
            Route::get('/{id}', 'ContasPagarController@getById');
            Route::post('/', 'ContasPagarController@insert');
            Route::post('/{id}', 'ContasPagarController@update');
            Route::delete('/{id}', 'ContasPagarController@delete');
            
        });
    });
});
