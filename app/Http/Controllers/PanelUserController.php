<?php
namespace App\Http\Controllers;
use App\User;

/**
* Controller Categories
*/
class PanelUserController extends Controller{
	
	public function index(){
		$usuarios = User::all();
		$data = array(
			'title' => 'Lista de usuarios',
			'usuarios' => $usuarios,
		);
		return view('panel/users/index', $data);
	}

	public function add(){
		
	}

	public function doadd(){
		echo "agregando";
	}

	public function edit(){
		
	}

	public function doedit(){
		
	}

	public function remove(){
		
	}
}
?>