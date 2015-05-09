<?php 

namespace App\Http\Controllers;
use App\Product;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| Controlador de la parte frontal de la tienda
	|
	*/

	/**
	 * Muestra el index de la tienda.
	 *
	 * @return Response
	 */
	public function index(){
		$data = array(
			'products' => Product::all(),
			'title' => 'Peleteria Continental',
		);
		return view('front/home', $data);
	}

}
