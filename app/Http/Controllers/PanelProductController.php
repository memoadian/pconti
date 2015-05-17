<?php

namespace App\Http\Controllers;
use Validator;
use Input;
use App\Product;
use App\Category;
use App\Classes\Cleaner;

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
		$categorias = Category::all();
		$data = array(
			'title' => 'Agregar un nuevo producto',
			'categorias' => $categorias,
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
				//'description' => 'required',
				'sku' => 'required',
				'price' => 'required',
				//'category' => 'required',
				'quantity' => ['required', 'integer'],
			),
			array(
				'name.required' => 'El Nombre del producto es obligatorio',
				//'description.required' => 'La descripción es obligatoria',
				'sku.required' => 'La clave del producto es obligatoria',
				'price.required' => 'El precio es obligatorio',
				'price.integer' => 'El precio sólo admite números',
				'category.required' => 'Necesitas asignar una categoría al producto',
				'quantity.required' => 'La cantidad de productos es obligatoria',
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
			$slug = Cleaner::url($name);
			$image = Input::get('image');

			$image = explode('_', $image);
			$image = $image[0];
			$image = explode('/', $image);
			$image = end($image);

			$producto = new Product;
			$producto->name = Input::get('name');
			$producto->slug = $slug;
			$producto->description = Input::get('description');
			$producto->image = $image;
			$producto->price = Input::get('price');
			$producto->sku = Input::get('sku');
			$producto->quantity = Input::get('quantity');
			$producto->category = Input::get('category_id');
			if(null !== Input::get('stock')){
				$producto->stock = 1;
			}else{
				$producto->stock = 0;
			}
			$producto->save();

			//agregamos la imagenes extras
			$id = $producto->id;

			$producto = Product::find($id);

			$images = Input::get('images');
			if(!empty($images)){
				$images = explode(',', $images);
				foreach($images as $img){
					$img = explode('_', $img);
					//$producto->imgs()->attach($img[0]);
					$producto->imgs()->sync([$img[0]], false);
				}
			}

			return redirect('appanel/productos');
		}
	}

	public function edit($id){
		$categorias = Category::all();
		$p = Product::find($id);
		$data = array(
			'title' => 'Editar Producto',
			'categorias' => $categorias,
			'p' => $p,
		);
		return view('panel/products/edit', $data);
	}

	public function doedit($id){
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
				//'description' => 'required',
				'sku' => 'required',
				'price' => 'required',
				//'category' => 'required',
				'quantity' => ['required', 'integer'],
			),
			array(
				'name.required' => 'El Nombre del producto es obligatorio',
				//'description.required' => 'La descripción es obligatoria',
				'sku.required' => 'La clave del producto es obligatoria',
				'price.required' => 'El precio es obligatorio',
				'category.required' => 'Necesitas asignar una categoría al producto',
				'quantity.required' => 'La cantidad de productos es obligatoria',
				'quantity.integer' => 'La cantidad debe ser un número entero'
			)
		);

		if ($validator->fails()){
			$messages = $validator->messages();
			return redirect('appanel/producto/editar/'.$id)
				->withErrors($validator)
				->withInput();
		}else{
			$name = Input::get('name');
			$slug = Cleaner::url($name);
			$image = Input::get('image');

			$image = explode('_', $image);
			$image = $image[0];
			$image = explode('/', $image);
			$image = end($image);

			$producto = Product::find($id);
			$producto->name = Input::get('name');
			$producto->slug = $slug;
			$producto->description = Input::get('description');
			$producto->image = $image;
			$producto->price = Input::get('price');
			$producto->sku = Input::get('sku');
			$producto->quantity = Input::get('quantity');
			$producto->category = Input::get('category_id');
			if(null !== Input::get('stock')){
				$producto->stock = 1;
			}else{
				$producto->stock = 0;
			}
			$producto->save();

			$images = Input::get('images');
			if(!empty($images)){
				$images = explode(',', $images);
				foreach($images as $img){
					$img = explode('_', $img);
					//$producto->imgs()->attach($img[0]);
					$producto->imgs()->sync([$img[0]], false);
				}
			}

			return redirect('appanel/producto/editar/'.$id);
		}
	}

	public function remove(){

	}

}

?>