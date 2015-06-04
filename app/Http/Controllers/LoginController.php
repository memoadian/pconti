<?php
namespace App\Http\Controllers;

use App\User;
use App\Category;
use Input;
use Auth;
use Mail;
use Validator;
use Hash;

/**
* Login
*/
class LoginController extends Controller{

	public function login(){
		if( Auth::check() ){
			return redirect('/');
		}else{
			$categorias = Category::all();
			$data = array(
				'title' => 'Entrar',
				'categorias' => $categorias,
			);

			return view('front/login', $data);
		}
	}

	public function dologin(){
		$email = Input::get('email');
		$password = Input::get('password');

		if(Auth::attempt(['email' => $email, 'password' => $password])){
			return redirect()->back();
		}else{
			return redirect('login')->with('error-login', 'Error');
		}
	}

	public function recover(){
		$categorias = Category::all();
		$data = array(
			'title' => 'Recuperar email',
			'categorias' => $categorias
		);

		return view('front/recover', $data);
	}

	public function recovering(){
		$email = Input::get('email');
		if( $email == '' ){
			return redirect()->back();
		}else{
			$exists = User::where('email', $email)->get();
			if( !$exists->isEmpty() ){
				$random = $this->random();
				$user = User::find( $exists[0]->id );
				$user->recover = $random;
				$user->save();

				$email_data = array(
					'email' => Input::get('email'),
				);

				$view_data = array(
					'random' => $random,
				);

				Mail::send('mails.recover', $view_data, function($message) use ($email_data){
					$message->from('admin@pconti.com', 'PCONTI');
					$message->to($email_data['email'])->subject('Recuperación de contraseña');
				});

				return redirect('recover')->with('send-recover', 'send');
			}else{
				return redirect('recover')->with('error-recover', 'error');
			}
		}
	}

	public function set(){
		$token = Input::get('token');

		if( !empty($token) ){
			$user = User::where('recover', $token)->get();

			if( !$user->isEmpty() ){
				$categorias = Category::all();
				$data = array(
					'title' => 'Nueva Contraseña',
					'categorias' => $categorias,
					'user' => $user,
				);

				return view('front/set', $data);
			}else{
				return redirect('/');
			}
		}else{
			return redirect('/');
		}
	}

	public function seting(){
		$token = Input::get('token');
		if( !empty($token) ){
			$user = User::where('recover', $token)->get();

			if( !$user->isEmpty() ){
				$validator = Validator::make(
					array(
						'password' => Input::get('password'),
						'repass' => Input::get('repass'),
					),
					array(
						'password' => 'required',
						'repass' => ['same:password', 'required_with:password'],
					),
					array(
						'required' => 'Este campo es obligatorio',
						'required_with' => 'Debes repetir la contraseña',
						'same' => 'La contraseña no coincide',
					)
				);

				if ($validator->fails()){
					$messages = $validator->messages();
					return redirect()
						->back()
						->withErrors($validator);
				}else{
					$user = User::find($user[0]->id);
					$user->password = Hash::make(Input::get('password'));
					$user->recover = '';
					$user->save();

					return redirect('login')->with('repass', 'seteado');
				}
			}else{
				return redirect('/');
			}
		}else{
			return redirect('/');
		}
	}

	public function logout(){
		Auth::logout();
		return redirect()->back();
	}


	function random($length = 100) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

?>