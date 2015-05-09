<?php

namespace App\Http\Controllers;
use App\Category;

/**
* Controlador CRUD productos
*/
class PanelCategoryController extends Controller {

	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$categories = Category::all();
		$data = array(
			'title' => 'Lista de Categorías',
			'categories' => $categories,
		);
		return view('panel/categories/index', $data);
	}

	public function add(){
		$data = array(
			'title' => 'Agregar una nueva Categoría',
		);
		return view('panel/categories/add', $data);
	}

	public function edit(){
		$data = array('title' => 'Editar Categoría', );
		return view('panel/categories/edit', $data);
	}

	public function doedit(){

	}

	public function remove(){

	}
}

?>