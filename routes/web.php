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

$router->get('/orders', ['uses' => 'OrderController@lists']);
$router->post('/order', ['uses' => 'OrderController@create']);
$router->post('/order/pay', ['uses' => 'OrderController@pay']);
$router->post('/order/send', ['uses' => 'OrderController@send']);
$router->post('/order/cancel', ['uses' => 'OrderController@cancel']);