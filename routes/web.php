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

$router->get('/[{key}]', ['as' => 'index', 'uses' => 'UrlController@index']);

$router->post('/create_url', ['as' => 'create_url', 'uses' => 'UrlController@create_url']);