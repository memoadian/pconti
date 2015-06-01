<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use Input;

/**
* Producto Front
*/
class ProductController extends Controller{
	
	public function index($id, $slug){
		$producto = Product::find($id);
		$categorias = Category::all();
		$data = array(
			'title' => $producto->name,
			'categorias' => $categorias,
			'p' => $producto,
		);

		return view('front/product', $data);
	}
}

?>