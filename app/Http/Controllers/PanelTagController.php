<?php

namespace App\Http\Controllers;

use Input;
use DB;
use Auth;
use App\Tag;
use App\Classes\Cleaner;

/**
* TagController
*/
class PanelTagController extends Controller{
	
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$tags = Tag::orderBy('name', 'asc')->paginate(50);
		$data = array(
			'title' => 'Tags',
			'tags' => $tags,
		);
		return view('panel/tags/index', $data);
	}

	public function first(){
		$search = Input::get('search');
		$tags = Tag::where('name', 'LIKE', $search.'%')->get();;
		return response()->json($tags);
	}

	public function json(){
		$search = Input::get('search');
		$tags = Tag::where('name', 'LIKE', '%'.$search.'%')->get();;
		return response()->json($tags);
	}

	public function doadd(){
		$name = strtolower(Input::get('name'));
		$slug = Cleaner::url($name);

		$tag = Tag::whereSlug($slug)->first();

		if( is_null($tag) ){

			$tag = new Tag;
			$tag->name = $name;
			$tag->slug = $slug;
			$tag->save();

			$id = $tag->id;
			$tag = Tag::find($id); 
			return response()->json($tag);
		}else{
			return response()->json($tag);
		}
	}

	public function remove($id){
		$acc = Check::check(Auth::user()->permisos, 9);

		if($acc){
			$tag = Tag::find($id);
			$tag->delete();

			$tag->producto()->detach();

			return 'Tag borrado con éxito';
		}else{
			return "No tienes permisos para realizar esta acción";
		}
	}
}

?>