<?php
namespace App\Http\Controllers;
use App\User;
use Validator;
use Input;

/**
* Controller Categories
*/
class PanelUserController extends Controller{

	public function __construct(){
		$this->middleware('auth');
	}
	
	public function index(){
		$usuarios = User::all();
		$data = array(
			'title' => 'Lista de usuarios',
			'usuarios' => $usuarios,
		);
		return view('panel/users/index', $data);
	}

	public function doadd(){
		$validator = Validator::make(
			array(
				'username' => Input::get('username'),
				'mail' => Input::get('mail'),
				'password' => Input::get('password'),
			),
			array(
				'username' => 'required|max:20',
				'mail' => 'required|exists:email',
				'password' => 'required',
			),
			array(
				'username.required' => 'El Nombre de usuario es obligatorio',
				'mail.required' => 'El correo de usuario es obligatorio',
				'password.required' => 'La contraseña de usuario es obligatorio',
			)
		);

		if ($validator->fails()){
			$messages = $validator->messages();
			return redirect('appanel/usuarios')
				->withErrors($validator)
				->withInput();
		}else{

		}
	}

	public function edit($id){
		$usuarios = User::all();
		$data = array(
			'title' => 'Editar usuario',
		);
		return view('panel/users/edit', $data);
	}

	public function doedit(){
		
	}

	public function remove(){
		
	}
}
?>