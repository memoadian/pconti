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
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index'] );

Route::get('/p/{id}/{slug}', 'ProductController@index');

Route::get('buscar', 'SearchController@index');

Route::get('categoria/{categorySlug}', 'CategoryController@index');

Route::get('contacto', 'ContactController@index');

Route::post('contactar', 'ContactController@send');

Route::get('legal', 'LegalController@index');

Route::get('pagar', 'CheckoutController@index');

Route::get('registro', 'CheckoutController@register');

Route::post('registrando', 'CheckoutController@doregister');

Route::post('editme/{id}', 'CheckoutController@editregister');

Route::get('login', 'LoginController@login');

Route::post('dologin', 'LoginController@dologin');

Route::get('recover', 'LoginController@recover');

Route::post('recovering', 'LoginController@recovering');

Route::get('set', 'LoginController@set');

Route::post('seteando/', 'LoginController@seting');

Route::get('salir', 'LoginController@logout');

/*
* Cart
*/

Route::post('add', 'CartController@add');

Route::get('content', 'CartController@content');

Route::get('total', 'CartController@total');

Route::get('items', 'CartController@items');

Route::get('vaciar', 'CartController@vaciar');

Route::post('remove', 'CartController@remove');

/*
* Payment
*/

Route::get('payment', 'PaypalPaymentController@postPayment');

Route::get('payment/status', 'PaypalPaymentController@getPaymentStatus');

/*
* Backend login/out
*/


Route::get('appanel/login', ['as' => 'login', 'uses' => 'PanelLoginController@index']);

Route::post('appanel/dologin', 'PanelLoginController@dologin');

Route::get('appanel/logout', 'PanelLoginController@logout');

/*
* Backend Slider
*/

Route::get('appanel/sliders', 'PanelSliderController@index');

Route::get('appanel/slider/agregar', 'PanelSliderController@add');

Route::post('appanel/slider/agregando', 'PanelSliderController@doadd');

Route::get('appanel/slider/editar/{id}', 'PanelSliderController@edit');

Route::post('appanel/slider/editando/{id}', 'PanelSliderController@doedit');

Route::get('appanel/slider/eliminar/{id}', 'PanelSliderController@remove');

/*
* Backend Orders
*/

Route::get('appanel', 'OrderController@index');

Route::get('appanel/orden/{id}', 'OrderController@order');

Route::get('appanel/enviadas', 'OrderController@sends');

Route::get('appanel/enviar/{id}', 'OrderController@check');

Route::get('appanel/regresar/{id}', 'OrderController@uncheck');

Route::get('appanel/orden/eliminar/{id}', 'OrderController@remove');

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

Route::post('appanel/categoria/agregando', 'PanelCategoryController@doadd');

Route::get('appanel/categoria/editar/{id}', 'PanelCategoryController@edit');

Route::post('appanel/categoria/editando/{id}', 'PanelCategoryController@doedit');

Route::get('appanel/categoria/eliminar/{id}', 'PanelCategoryController@remove');

/*
* Tags
*/

Route::get('appanel/tags', 'PanelTagController@index');

Route::get('appanel/tags/first', 'PanelTagController@first');

Route::get('appanel/tags/json', 'PanelTagController@json');

Route::post('appanel/tag/agregando', 'PanelTagController@doadd');

Route::get('appanel/tag/eliminar/{id}', 'PanelTagController@remove');

/*
* Backend Users
*/

Route::get('appanel/usuarios', 'PanelUserController@index');

Route::post('appanel/usuario/agregando', 'PanelUserController@doadd');

Route::get('appanel/usuario/editar/{id}', 'PanelUserController@edit');

Route::post('appanel/usuario/editando/{id}', 'PanelUserController@doedit');

Route::get('appanel/usuario/eliminar/{id}', 'PanelUserController@remove');

/*
* backend Clientes
*/

Route::get('appanel/clientes', 'PanelUserController@clients');

Route::get('appanel/cliente/{id}', 'PanelUserController@client');

/*
* Backend Images
*/

Route::get('appanel/imagenes', 'PanelImageController@index');

Route::get('appanel/imagenes/json', 'PanelImageController@picsJSON');

Route::post('appanel/imagen/upload', 'PanelImageController@upload');

Route::get('appanel/imagen/editar/{id}', 'PanelImageController@edit');

Route::post('appanel/imagen/editando/{id}', 'PanelImageController@doedit');

Route::get('appanel/imagen/eliminar/{id}', 'PanelImageController@remove');

/*
* Backend Config
*/

Route::get('appanel/configuracion', 'PanelConfigController@index');

Route::post('appanel/configuracion/editando', 'PanelConfigController@doedit');

/* Auth */

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
