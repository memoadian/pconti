<?php

namespace App\Http\Controllers;
use App\Category;
use App\User;
use Auth;
use Hash;
use Validator;
use Input;

/**
* Checkout
*/
class CheckoutController extends Controller{
	public function index(){
		if( Auth::check() ){
			$user = User::find( Auth::user()->id );
			$data = array(
				'categorias' => Category::all(),
				'title' => 'Pagar',
				'user' => $user
			);

			return view('front/checkout', $data);
		}else{
			return redirect('registro');
		}
	}

	public function register(){
		$states = array(
			'Aguascalientes' => 'Aguascalientes',
			'Baja California' => 'Baja California',
			'Baja California Sur' => 'Baja California Sur',
			'Campeche' => 'Campeche',
			'Chiapas' => 'Chiapas',
			'Chihuahua' => 'Chihuahua',
			'Coahuila' => 'Coahuila',
			'Colima' => 'Colima',
			'Distrito Federal' => 'Distrito Federal',
			'Durango' => 'Durango',
			'Estado de México' => 'Estado de México',
			'Guanajuato' => 'Guanajuato',
			'Guerrero' => 'Guerrero',
			'Hidalgo' => 'Hidalgo',
			'Jalisco' => 'Jalisco',
			'Michoacán' => 'Michoacán',
			'Morelos' => 'Morelos',
			'Nayarit' => 'Nayarit',
			'Nuevo León' => 'Nuevo León',
			'Oaxaca' => 'Oaxaca',
			'Puebla' => 'Puebla',
			'Querétaro' => 'Querétaro',
			'Quintana Roo' => 'Quintana Roo',
			'San Luis Potosí' => 'San Luis Potosí',
			'Sinaloa' => 'Sinaloa',
			'Sonora' => 'Sonora',
			'Tabasco' => 'Tabasco',
			'Tamaulipas' => 'Tamaulipas',
			'Tlaxcala' => 'Tlaxcala',
			'Veracruz' => 'Veracruz',
			'Yucatán' => 'Yucatán',
			'Zacatecas' => 'Zacatecas'
		);

		if( Auth::check() ){
			$user = User::find(Auth::user()->id);
			$data = array(
				'categorias' => Category::all(),
				'title' => 'Registrar',
				'user' => $user,
				'states' => $states
			);

			return view('front/editregister', $data);
		}else{
			$data = array(
				'categorias' => Category::all(),
				'title' => 'Editar Registro',
				'states' => $states
			);

			return view('front/register', $data);
		}
	}

	public function doregister(){
		$validator = Validator::make(
			array(
				'name' => Input::get('name'),
				'surname' => Input::get('surname'),
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'repass' => Input::get('repass'),
				'street' => Input::get('street'),
				'number' => Input::get('number'),
				'colony' => Input::get('colony'),
				'zip' => Input::get('zip'),
				'delegation' => Input::get('delegation'),
				'state' => Input::get('state')
			),
			array(
				'name' => 'required',
				'surname' => 'required',
				'email' => 'required|unique:users|email',
				'password' => 'required',
				'repass' => ['same:password', 'required_with:password'],
				'street' => 'required',
				'number' => ['required', 'integer'],
				'colony' => 'required',
				'zip' => 'required',
				'delegation' => 'required',
				'state' => 'required',
			),
			array(
				'required' => 'Este campo es obligatorio',
				'required_with' => 'Debes repetir la contraseña',
				'same' => 'La contraseña no coincide',
				'unique' => 'Este email ya ha sido registrado'
			)
		);

		if ($validator->fails()){
			$messages = $validator->messages();
			return redirect('registro')
				->withErrors($validator)
				->withInput();
		}else{
			$user = new User;
			$user->name = Input::get('name');
			$user->surname = Input::get('surname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->street = Input::get('street');
			$user->number = Input::get('number');
			$user->colony = Input::get('colony');
			$user->zip = Input::get('zip');
			$user->delegation = Input::get('delegation');
			$user->state = Input::get('state');
			$user->rol = 2;

			$user->save();

			$credentials = array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
			);

			if (Auth::attempt($credentials)) {
				return redirect('/registro')->with('register', 'Registrado');
			}
		}
	}

	public function editregister($id){
		$validator = Validator::make(
			array(
				'name' => Input::get('name'),
				'surname' => Input::get('surname'),
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'repass' => Input::get('repass'),
				'street' => Input::get('street'),
				'number' => Input::get('number'),
				'colony' => Input::get('colony'),
				'zip' => Input::get('zip'),
				'delegation' => Input::get('delegation'),
				'state' => Input::get('state')
			),
			array(
				'name' => 'required',
				'surname' => 'required',
				'email' => 'required|unique:users,email,'.$id,
				'repass' => ['same:password', 'required_with:password'],
				'street' => 'required',
				'number' => ['required', 'integer'],
				'colony' => 'required',
				'zip' => 'required',
				'delegation' => 'required',
				'state' => 'required',
			),
			array(
				'required' => 'Este campo es obligatorio',
				'required_with' => 'Debes repetir la contraseña',
				'same' => 'La contraseña no coincide',
				'unique' => 'Este email ya ha sido registrado'
			)
		);

		if ($validator->fails()){
			$messages = $validator->messages();
			return redirect('registro')
				->withErrors($validator)
				->withInput();
		}else{
			$user = User::find($id);
			$user->name = Input::get('name');
			$user->surname = Input::get('surname');
			$user->email = Input::get('email');
			if( null != Input::get('password') ){
				$user->password = Hash::make(Input::get('password'));
			}
			$user->street = Input::get('street');
			$user->number = Input::get('number');
			$user->colony = Input::get('colony');
			$user->zip = Input::get('zip');
			$user->delegation = Input::get('delegation');
			$user->state = Input::get('state');
			$user->rol = 2;

			$user->save();

			return redirect('/registro')->with('edit', 'Editado');
		}
	}

}

?>