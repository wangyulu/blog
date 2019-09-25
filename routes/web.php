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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('users/save', ['uses' => 'UserController@save']);

$router->get('users/{id}', ['uses' => 'UserController@detail']);

$router->get('author/{id}', ['uses' => 'AuthorController@detail']);

$router->get('book/list', ['uses' => 'BookController@list']);

$router->get('book/{id}', ['uses' => 'BookController@detail']);
