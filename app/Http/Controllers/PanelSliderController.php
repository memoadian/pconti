<?php

namespace App\Http\Controllers;
use Input;
use Auth;
use App\Slider;

/**
* Controlador CRUD Slides
*/
class PanelSliderController extends Controller {

	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$slides = Slider::all();
		$data = array(
			'title' => 'Lista de Slides',
			'slides' => $slides,
		);
		return view('panel/slides/index', $data);
	}

	public function add(){
		$data = array(
			'title' => 'Agregar un nuevo slide',
		);

		return view('panel/slides/add', $data);
	}

	public function doadd(){
		$image = Input::get('img');
		$image = explode('_', $image);
		$image = $image[0];
		$image = explode('/', $image);
		$image = end($image);

		$slide = new Slider;
		$slide->img = $image;
		$slide->link = Input::get('link');

		$slide->save();

		return redirect('appanel/sliders');
	}

	public function edit($id){
		$s = Slider::find($id);
		$data = array(
			'title' => 'Editar Slide',
			's' => $s,
		);

		return view('panel/slides/edit', $data);
	}

	public function doedit($id){
		$image = Input::get('img');
		$image = explode('_', $image);
		$image = $image[0];
		$image = explode('/', $image);
		$image = end($image);

		$slide = Slider::find($id);
		$slide->img = $image;
		$slide->link = Input::get('link');

		$slide->save();

		return redirect('appanel/sliders');
	}

	public function remove($id){
		$slide = Slider::find($id);
		$slide->delete();

		return "El producto ha sido eliminado exitosamente";
	}

}

?>