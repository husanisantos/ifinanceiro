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

], function () {

    Route::group(['prefix' => '/auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('check', 'AuthController@check');
        Route::post('refresh', 'AuthController@refresh');
    });

    Route::group(['middleware' => 'auth:api'], function () {
        
        /**
         * Rotas para CRUD de serviços 
         * @return Void
         */
        Route::group(['prefix' => 'services'], function () {

            Route::get('/', 'ServiceController@getAll');
            Route::get('/{id}', 'ServiceController@getById');
            Route::put('/{id}', 'ServiceController@update');
            Route::post('/', 'ServiceController@insert');
            Route::delete('/{id}', 'ServiceController@delete');
            
        });

        /**
         * Rotas para CRUD de veículos 
         * @return Void
         */
        Route::group(['prefix' => 'vehicles'], function () {

            Route::get('/', 'VehicleController@getAll');
            Route::get('/{id}', 'VehicleController@getById');
            Route::put('/{id}', 'VehicleController@update');
            Route::post('/', 'VehicleController@insert');
            Route::delete('/{id}', 'VehicleController@delete');
            
        });
    });
});
