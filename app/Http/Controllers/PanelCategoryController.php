<?php

namespace App\Http\Controllers;
use Validator;
use Auth;
use Input;
use DB;
use App\Category;

/**
* Controlador CRUD productos
*/
class PanelCategoryController extends Controller {

	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$categorias = Category::all();
		$data = array(
			'title' => 'Lista de Categorías',
			'categorias' => $categorias,
		);
		return view('panel/categories/index', $data);
	}

	public function doadd(){
		$acc = Check::check(Auth::user()->permisos, 5);

		if($acc){
			$validator = Validator::make(
				array(
					'catname' => Input::get('catname'),
					'slug' => Input::get('slug'),
				),
				array(
					'catname' => 'required',
					'slug' => 'required',
				),
				array(
					'catname.required' => 'El Nombre de la categoría es obligatorio',
					'slug.required' => 'El slug no puede estar vacío',
				)
			);

			if ($validator->fails()){
				$messages = $validator->messages();
				return redirect('appanel/categoria/agregar')
					->withErrors($validator)
					->withInput();
			}else{
				$catname = Input::get('catname');
				$slug = Input::get('slug');

				$categoria = new Category;
				$categoria->name = $catname;
				$categoria->slug = $slug;
				$categoria->save();

				return redirect('appanel/categorias');
			}
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function edit($id){
		$acc = Check::check(Auth::user()->permisos, 5);

		if($acc){
			$categorias = Category::all();
			$categoria = Category::find($id);
			$data = array(
				'title' => 'Editar Categoría',
				'categorias' => $categorias,
				'categoria' => $categoria,
			);
			return view('panel/categories/edit', $data);
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function doedit($id){
		$acc = Check::check(Auth::user()->permisos, 5);

		if($acc){
			$validator = Validator::make(
				array(
					'catname' => Input::get('catname'),
					'slug' => Input::get('slug'),
				),
				array(
					'catname' => 'required',
					'slug' => 'required',
				),
				array(
					'catname.required' => 'El Nombre de la categoría es obligatorio',
					'slug.required' => 'El slug no puede estar vacío',
				)
			);

			if ($validator->fails()){
				$messages = $validator->messages();
				return redirect('appanel/categoria/agregar/'.$id)
					->withErrors($validator)
					->withInput();
			}else{
				$catname = Input::get('catname');
				$slug = Input::get('slug');

				$categoria = Category::find($id);
				$categoria->name = $catname;
				$categoria->slug = $slug;
				$categoria->save();

				return redirect('appanel/categorias');
			}
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function remove($id){
		$acc = Check::check(Auth::user()->permisos, 6);

		if($acc){
			$categoria = Category::find($id);
			$categoria->delete();

			DB::table('products')
				->where('id_category', $id)
				->update(['id_category' => 1]);

			return 'Categoría borrada con éxito';
		}else{
			return "No tienes permisos para realizar esta acción";
		}
	}
}

?>