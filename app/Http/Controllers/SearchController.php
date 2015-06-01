<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Input;

/**
* Buscador
*/
class SearchController extends Controller{
	
	public function index(){
		$query = Input::get('s');
		$productos = Product::search($query)->get();
		$categorias = Category::all();
		$data = array(
			'title' => 'Resultados de búsqueda',
			'productos' => $productos,
			'categorias' => $categorias
		);

		return view('front/search', $data);
	}
}

?>