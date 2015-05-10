<?php

namespace App\Http\Controllers;
use Validator;
use Input;
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

	public function doadd(){
		$validator = Validator::make(
			array(
				'name' => Input::get('name'),
				'description' => Input::get('description'),
				'sku' => Input::get('sku'),
				'price' => Input::get('price'),
				'category' => Input::get('category'),
				'quantity' => Input::get('quantity'),
			),
			array(
				'name' => 'required',
				'description' => 'required',
				'sku' => 'required',
				'price' => 'required',
				'category' => 'required',
				'quantity' => ['required', 'integer'],
			),
			array(
				'name.required' => 'El Nombre del producto es obligatorio',
				'description.required' => 'La descripción es obligatoria',
				'sku.required' => 'La clave del producto es obligatoria',
				'price.required' => 'El precio es obligatorio',
				'category.required' => 'Necesitas asignar una categoría al producto',
				'quantity.required' => 'Cantidad de productos disponibles',
				'quantity.integer' => 'La cantidad debe ser un número entero'
			)
		);

		if ($validator->fails()){
			$messages = $validator->messages();
			return redirect('appanel/producto/agregar')
				->withErrors($validator)
				->withInput();
		}else{
			$name = Input::get('name');
			$slug = cleaner($name);

			$producto = new Product;
			$producto->name = Input::get('name');
			$producto->slug = Input::get('slug');
			$producto->description = Input::get('description');
			$producto->price = Input::get('price');
			$producto->sku = Input::get('sku');
			$producto->quantity = Input::get('quantity');
			if(null !== Input::get('status')){
				$producto->stock = 0;
			}else{
				$producto->stock = 1;
			}
			$producto->save();
		}
	}

	public function edit(){
		$data = array(
			'title' => 'Editar Producto',
		);
		return view('panel/products/edit', $data);
	}

	public function doedit(){

	}

	public function remove(){

	}

	function cleaner($str, $replace=array(), $delimiter='-') {
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}
}

?>