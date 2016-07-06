<?php

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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group([
    'prefix' => 'api/v1',
    'namespace' => 'App\Http\Controllers',
], function () use ($app) {
    $app->get('me', 'UserController@me');

    $app->get('user', 'UserController@index');
    $app->post('user', 'UserController@store');
    $app->get('user/{id}', 'UserController@show');
    $app->put('user/{id}', 'UserController@update');
    $app->delete('user/{id}', 'UserController@destroy');

    $app->post('auth/login', 'AuthController@login');
    $app->get('auth/logout', 'AuthController@logout');
});
