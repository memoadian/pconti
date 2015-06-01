<?php
namespace App\Http\Controllers;
use Validator;
use Input;
use Hash;
use Auth;
use App\User;
use App\Permit;

/**
* Controller Categories
*/
class PanelUserController extends Controller{

	public function __construct(){
		$this->middleware('auth');
	}
	
	public function index(){
		$usuarios = User::all();
		$permisos = Permit::all();

		$data = array(
			'title' => 'Lista de usuarios',
			'usuarios' => $usuarios,
			'permisos' => $permisos,
		);
		return view('panel/users/index', $data);
	}

	public function doadd(){
		$acc = Check::check(Auth::user()->permisos, 1);

		if( $acc || Auth::user()->rol == 1 ){
			$validator = Validator::make(
				array(
					'username' => Input::get('username'),
					'email' => Input::get('email'),
					'pass' => Input::get('pass'),
					'repass' => Input::get('repass'),
				),
				array(
					'username' => 'required|max:20',
					'email' => 'required|unique:users|email',
					'pass' => 'required',
					'repass' => 'same:pass',
				),
				array(
					'username.required' => 'El Nombre de usuario es obligatorio',
					'username.max' => 'El Nombre de usuario no puede exceder los 20 caractéres',
					'email.required' => 'El correo de usuario es obligatorio',
					'email.unique' => 'El correo ya es usado por otro usuario',
					'pass.required' => 'La contraseña es obligatoria',
					'same' => 'Las contraseñas no coinciden',
				)
			);

			if ($validator->fails()){
				$messages = $validator->messages();
				return redirect('appanel/usuarios')
					->withErrors($validator)
					->withInput();
			}else{
				$user = new User;

				$user->name = Input::get('name');
				$user->surname = Input::get('surname');
				$user->username = Input::get('username');
				$user->email = Input::get('email');
				$user->password = Hash::make(Input::get('password'));
				$user->save();

				$permisos = Input::get('permits');

				if(!empty($permisos)){
					foreach($permisos as $p){
						$data[] = $p;
					}
					print_r($data);
					$user->permisos()->sync($data);
				}

				return redirect('appanel/usuarios');
			}
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function edit($id){
		$acc = Check::check(Auth::user()->permisos, 1);

		if( $acc || Auth::user()->rol == 1 ){
			$usuarios = User::all();
			$permisos = Permit::all();
			$usuario = User::find($id);

			$permitidos = array();

			foreach( $usuario->permisos as $p ){
				$permitidos[] = $p->id;
			}

			$data = array(
				'title' => 'Lista de usuarios',
				'usuarios' => $usuarios,
				'usuario' => $usuario,
				'permisos' => $permisos,
				'permitidos' => $permitidos,
			);
			return view('panel/users/edit', $data);
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function doedit($id){
		$acc = Check::check(Auth::user()->permisos, 1);

		if( $acc || Auth::user()->rol == 1 ){
			$validator = Validator::make(
				array(
					'username' => Input::get('username'),
					'email' => Input::get('email'),
					'pass' => Input::get('pass'),
					'repass' => Input::get('repass'),
				),
				array(
					'username' => 'required|max:20',
					'email' => 'required|email|unique:users,email,'.$id,
					'repass' => 'same:pass|required_with:pass',
				),
				array(
					'username.required' => 'El Nombre de usuario es obligatorio',
					'username.max' => 'El Nombre de usuario no puede exceder los 20 caractéres',
					'email.required' => 'El correo de usuario es obligatorio',
					'email.unique' => 'El correo ya es usado por otro usuario',
					'email' => 'El correo no es válido',
					'pass.required' => 'La contraseña es obligatoria',
					'same' => 'Las contraseñas no coinciden',
					'required_with' => 'Las contraseñas no coinciden',
				)
			);

			if ($validator->fails()){
				$messages = $validator->messages();
				return redirect('appanel/usuario/editar/'.$id)
					->withErrors($validator)
					->withInput();
			}else{
				$user = User::find($id);

				if( !count($user) ){
					return redirect('appanel');
				}else{
					$user->name = Input::get('name');
					$user->surname = Input::get('surname');
					$user->username = Input::get('username');
					$user->email = Input::get('email');
					if( null != Input::get('pass') ){
						$user->password = Hash::make(Input::get('pass'));
					}
					$user->save();

					$permisos = Input::get('permits');

					if(!empty($permisos)){
						foreach($permisos as $p){
							$data[] = $p;
						}
						$user->permisos()->sync($data);
					}

					return redirect('appanel/usuario/editar/'.$id);
				}
			}
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function remove($id){
		$acc = Check::check(Auth::user()->permisos, 2);

		if( $acc || Auth::user()->rol == 1 ){
			$usuario = User::find($id);
			$usuario->permisos()->detach();
			$usuario->delete();

			return "El usuario ha sido eliminado exitosamente";
		}else{
			return "No tienes permisos para realizar esta acción";
		}
	}
}

?>