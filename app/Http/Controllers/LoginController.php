<?php
namespace App\Http\Controllers;

use App\User;
use Input;
use Auth;

/**
* Login
*/
class LoginController extends Controller{

	public function dologin(){
		$email = Input::get('email');
		$password = Input::get('password');

		if(Auth::attempt(['email' => $email, 'password' => $password])){
			return redirect()->back();
		}else{
			return redirect()->back();
		}
	}

	public function logout(){
		Auth::logout();
		return redirect()->back();
	}

}

?>