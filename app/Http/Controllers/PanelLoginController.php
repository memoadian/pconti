<?php

namespace App\Http\Controllers;
use Auth;
use Input;
use App\User;

class PanelLoginController extends Controller{

	public function index(){
		$data = array(
			'title' => 'Login de Usaurio',
		);
		return view('panel/login/login', $data);
	}

	public function dologin(){
		$username = Input::get('username');
		$password = Input::get('password');

		if(Auth::attempt(['username' => $username, 'password' => $password])){
			return redirect('appanel');
		}else{
			return redirect('appanel');
		}
	}

	public function logout(){
		Auth::logout();
		return redirect('appanel');
	}
}

?>