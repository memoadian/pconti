<?php

namespace App\Http\Controllers;
use App\Product;

/**
* Controlador CRUD productos
*/
class PanelProductController extends Controller {

	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$productos = Product::all();
		$data = array(
			'title' => 'Lista de Productos',
			'productos' => $productos,
		);
		return view('panel/products/index', $data);
	}

	public function add(){
		$data = array(
			'title' => 'Agregar un nuevo producto',
		);
		return view('panel/products/add', $data);
	}

	public function edit(){
		$data = array('title' => 'Editar Producto', );
		return view('panel/products/edit', $data);
	}

	public function doedit(){

	}

	public function remove(){

	}
}

?>