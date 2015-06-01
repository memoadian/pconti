<?php 

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Classes\Cleaner;

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
			'categorias' => Category::all(),
			'productos' => Product::all(),
			'title' => 'Peleteria Continental',
		);
		return view('front/home', $data);
	}

	public function product($slug){

	}

	public function search(){

	}



}
