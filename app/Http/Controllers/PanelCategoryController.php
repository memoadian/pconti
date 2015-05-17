<?php

namespace App\Http\Controllers;
use App\Category;
use Validator;
use Input;

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
	}

	public function edit($id){
		$categorias = Category::all();
		$categoria = Category::find($id);
		$data = array(
			'title' => 'Editar Categoría',
			'categorias' => $categorias,
			'categoria' => $categoria,
		);
		return view('panel/categories/edit', $data);
	}

	public function doedit($id){
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

			$categoria = new Category;
			$categoria->name = $catname;
			$categoria->slug = $slug;
			$categoria->save();

			return redirect('appanel/categorias');
		}
	}

	public function remove($id){
		$categoria = Category::find($id);
		$categoría->delete();
	}
}

?>