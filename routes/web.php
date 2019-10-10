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

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('users', ['as' => 'users.index', 'uses' => 'UserController@index']);
    $router->get('users/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
    $router->get('users/{id}/relationships/roles', ['as' => 'users.relationships.roles', 'uses' => 'UserController@roles']);
    $router->post('users', ['as' => 'users.create', 'uses' => 'UserController@create']);
    $router->post('users/{id}/change_password', ['as' => 'users.change_password', 'uses' => 'UserController@changePassword']);
    $router->put('users/{id}', ['as' => 'users.update', 'uses' => 'UserController@update']);
    $router->delete('users/{id}', ['as' => 'users.delete', 'uses' => 'UserController@destroy']);

    $router->get('roles', ['as' => 'roles.index', 'uses' => 'RoleController@index']);
    $router->get('roles/{name}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
});

$router->post('auth/login', 'AuthController@authenticate');
