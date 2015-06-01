<?php

namespace App\Http\Controllers;
use Validator;
use Input;
use Auth;
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
		$productos = Product::paginate(10);
		$data = array(
			'title' => 'Lista de Productos',
			'productos' => $productos,
		);
		return view('panel/products/index', $data);
	}

	public function add(){
		$acc = Check::check(Auth::user()->permisos, 3);

		if($acc){
			$categorias = Category::all();
			$data = array(
				'title' => 'Agregar un nuevo producto',
				'categorias' => $categorias,
			);
			return view('panel/products/add', $data);
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function doadd(){
		$acc = Check::check(Auth::user()->permisos, 3);

		if($acc){
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
				$producto->id_category = Input::get('category');

				if(null !== Input::get('stock')){
					$producto->stock = 1;
				}else{
					$producto->stock = 0;
				}

				if(null !== Input::get('supply')){
					$producto->supply = 1;
				}else{
					$producto->supply = 0;
				}

				if(null !== Input::get('outstanding')){
					$producto->outstanding = 1;
				}else{
					$producto->outstanding = 0;
				}

				$producto->save();

				//agregamos las imagenes extras
				$id = $producto->id;

				$producto = Product::find($id);

				$images = Input::get('images');
				if( !empty($images) ){
					$images = explode(',', $images);
					foreach($images as $img){
						$img = explode('_', $img);
						$imgs[] = $img[0];
					}
					$producto->imgs()->sync($imgs);
				}
				
				//y los tags
				$tags = Input::get('tags');
				if( !empty($tags) ){
					$tags = explode(',', $tags);
					foreach($tags as $t){
						$tag = explode('_', $t);
						$sync[] = $tag[0];
					}
					$producto->tags()->sync($sync);
				}else{
					$producto->tags()->detach();
				}

				return redirect('appanel/productos');
			}
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function edit($id){
		$acc = Check::check(Auth::user()->permisos, 3);

		if($acc){
			$categorias = Category::all();
			$p = Product::find($id);
			$data = array(
				'title' => 'Editar Producto',
				'categorias' => $categorias,
				'p' => $p,
			);
			return view('panel/products/edit', $data);
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function doedit($id){
		$acc = Check::check(Auth::user()->permisos, 3);

		if($acc){
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
				$producto->id_category = Input::get('category');

				if(null !== Input::get('stock')){
					$producto->stock = 1;
				}else{
					$producto->stock = 0;
				}

				if(null !== Input::get('supply')){
					$producto->supply = 1;
				}else{
					$producto->supply = 0;
				}

				if(null !== Input::get('outstanding')){
					$producto->outstanding = 1;
				}else{
					$producto->outstanding = 0;
				}

				$producto->save();

				$images = Input::get('images');
				if(!empty($images)){
					$images = explode(',', $images);
					foreach($images as $img){
						$img = explode('_', $img);
						$imgs[] = $img[0];
					}
					$producto->imgs()->sync($imgs);
				}else{
					$producto->imgs()->detach();
				}

				//y los tags
				$tags = Input::get('tags');
				if( !empty($tags) ){
					$tags = explode(',', $tags);
					foreach($tags as $t){
						$tag = explode('_', $t);
						$sync[] = $tag[0];
					}
					$producto->tags()->sync($sync, true);
				}else{
					$producto->tags()->detach();
				}

				return redirect('appanel/producto/editar/'.$id);
			}
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function remove($id){
		$acc = Check::check(Auth::user()->permisos, 4);

		if($acc){
			$producto = Product::find($id);
			$producto->imgs()->detach();
			$producto->delete();

			return "El producto ha sido eliminado exitosamente";
		}else{
			return "No tienes permisos para realizar esta acción";
		}
	}

}

?>