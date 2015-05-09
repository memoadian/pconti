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
* Backend login/out
*/

Route::get('appanel', 'PanelController@index');

Route::get('appanel/login', 'PanelLoginController@index');

Route::post('appanel/dologin', 'PanelLoginController@dologin');

Route::get('appanel/logout', 'PanelLoginController@logout');

/*
* Backend Productos
*/

Route::get('appanel/productos', 'PanelProductController@index');

Route::get('appanel/producto/agregar', 'PanelProductController@add');

Route::get('appanel/producto/editar/{id}', 'PanelProductController@edit');

Route::get('appanel/producto/editando/{id}', 'PanelProductController@doedit');

Route::get('appanel/producto/eliminar/{id}', 'PanelProductController@remove');

/* Auth */

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
