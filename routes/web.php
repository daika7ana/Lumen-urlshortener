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

// Frontend Entrupoint
$router->get('/', ['as' => 'index', 'uses' => 'FrontendController@index']);
// End

$router->get('/{key}', ['as' => 'shortener_entrypoint', 'uses' => 'UrlController@shortener_entrypoint']);
$router->post('/create_url', ['as' => 'create_url', 'uses' => 'UrlController@create_url']);