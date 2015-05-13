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

Route::post('appanel/producto/agregando', 'PanelProductController@doadd');

Route::get('appanel/producto/editar/{id}', 'PanelProductController@edit');

Route::post('appanel/producto/editando/{id}', 'PanelProductController@doedit');

Route::get('appanel/producto/eliminar/{id}', 'PanelProductController@remove');

/*
* Backend Categories
*/

Route::get('appanel/categorias', 'PanelCategoryController@index');

Route::get('appanel/categoria/agregar', 'PanelCategoryController@add');

Route::post('appanel/categoria/agregando', 'PanelCategoryController@doadd');

Route::get('appanel/categoria/editar/{id}', 'PanelCategoryController@edit');

Route::post('appanel/categoria/editando/{id}', 'PanelCategoryController@doedit');

Route::get('appanel/categoria/eliminar/{id}', 'PanelCategoryController@remove');

/*
* Backend Users
*/

Route::get('appanel/usuarios', 'PanelUserController@index');

Route::get('appanel/usuario/agregar', 'PanelUserController@add');

Route::post('appanel/usuario/agregando', 'PanelUserController@doadd');

Route::get('appanel/usuario/editar/{id}', 'PanelUserController@edit');

Route::post('appanel/usuario/editando/{id}', 'PanelUserController@doedit');

Route::get('appanel/usuario/eliminar/{id}', 'PanelUserController@remove');

/*
* Backend Images
*/

Route::get('appanel/imagenes', 'PanelImageController@index');

Route::get('appanel/imagenes/json', 'PanelImageController@picsJSON');

Route::post('appanel/imagen/upload', 'PanelImageController@upload');

Route::get('appanel/imagen/editar/{id}', 'PanelImageController@edit');

Route::post('appanel/imagen/editando/{id}', 'PanelImageController@doedit');

Route::get('appanel/imagen/eliminar/{id}', 'PanelImageController@remove');

/* Auth */

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
