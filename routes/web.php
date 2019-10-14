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

/*
|--------------------------------------------------------------------------
| Endpoint yang tidak membutuhkan izin akses khusus dan
| TIDAK membutuhkan Token Authentication untuk mengakses endpoint ini
|--------------------------------------------------------------------------
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post('auth/login', 'AuthController@authenticate');

/*
|--------------------------------------------------------------------------
| Endpoint yang tidak membutuhkan izin akses khusus dan
| membutuhkan Token Authentication untuk mengakses endpoint ini
|--------------------------------------------------------------------------
|
*/

$router->group(['middleware' => ['auth']], function () use ($router) {
    $router->get('users/self', 'UserController@showSelf');
    $router->get('users/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
});

/*
|--------------------------------------------------------------------------
| Endpoint yang mempunyai izin akses sebagai "Administrator" atau "Guru"
| dan membutuhkan Token Authentication untuk mengakses endpoint ini
|--------------------------------------------------------------------------
|
*/

$router->group(['middleware' => ['auth', 'admin', 'teacher']], function () use ($router) {

    // Endpoint untuk memanage data users
    $router->get('users', ['as' => 'users.index', 'uses' => 'UserController@index']);
    $router->get('users/{id}/relationships/roles', ['as' => 'users.relationships.roles', 'uses' => 'UserController@roles']);
    $router->post('users', ['as' => 'users.create', 'uses' => 'UserController@create']);
    $router->post('users/{id}/change_password', ['as' => 'users.change_password', 'uses' => 'UserController@changePassword']);
    $router->put('users/{id}', ['as' => 'users.update', 'uses' => 'UserController@update']);
    $router->delete('users/{id}', ['as' => 'users.delete', 'uses' => 'UserController@destroy']);

    // Endpoint untuk memanage data peran users
    $router->get('roles', ['as' => 'roles.index', 'uses' => 'RoleController@index']);
    $router->get('roles/{name}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
});

/*
|--------------------------------------------------------------------------
| Endpoint yang mempunyai izin akses sebagai "Siswa" dan
| membutuhkan Token Authentication untuk mengakses endpoint ini
|--------------------------------------------------------------------------
|
*/

$router->group(['middleware' => ['auth', 'student']], function () use ($router) {

});
