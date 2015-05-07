<?php
namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller as Controller;

class LoginController extends Controller{

	public function index(){
		$data = array(
			'title' => 'Login de Usaurio',
		);
		return view('panel/login/login', $data);
	}
}

?>