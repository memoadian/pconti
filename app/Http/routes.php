<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
* Frontend
*/
Route::get('/', 'HomeController@index');

Route::get('producto', 'ProductoController@index');

Route::get('buscar', 'BuscarController@index');

Route::get('categoria/{categoryName}', 'CategoryController@index');

Route::get('contacto', 'ContactoController@index');

Route::get('ubicacion', 'UbicacionController@index');

Route::get('politicas/{politicName}', 'PoliticasController@index');

Route::get('pagar', 'PagarController@index');

Route::get('registro', 'RegistroController@index');

/*
* Backend
*/

Route::get('appanel/login', 'Panel\LoginController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
