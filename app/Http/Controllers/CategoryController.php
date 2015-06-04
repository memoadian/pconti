<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Product;
use Input;

/**
* Categories
*/
class CategoryController extends Controller{

	public function index($categorySlug){
		$categoria = Category::where('slug', $categorySlug)->first();
		$categorias = Category::all();
		$tags = Tag::orderBy('name', 'asc')->get();

		$id = $categoria->id;
		if( Input::get('tag') ){
			$tagSlug = Input::get('tag');
			$tag = Tag::where('slug', $tagSlug)->first();
			

			$productos = Tag::where('id', $tag->id)->get();

			$data = array(
				'title' => 'Productos con tag '.$tag->name,
				'categorias' => $categorias,
				'categoria' => $categoria,
				'productos' => $productos,
				'tags' => $tags
			);

			return view('front/tag', $data);
		}else{
			$productos = Product::where('id_category', $categoria->id)->paginate(20);

			$data = array(
				'title' => 'Productos en la categoría '.$categoria->name,
				'categorias' => $categorias,
				'categoria' => $categoria,
				'productos' => $productos,
				'tags' => $tags
			);

			return view('front/categoria', $data);
		}
	}
	
}

?>