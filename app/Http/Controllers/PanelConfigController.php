<?php

namespace App\Http\Controllers;
use Validator;
use Auth;
use Input;
use DB;
use App\Config;

/**
* Controlador CRUD productos
*/
class PanelConfigController extends Controller {

	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$acc = Check::check(Auth::user()->permisos, 1);

		if( $acc || Auth::user()->rol == 1 ){
			$config = Config::find(1);
			$data = array(
				'title' => 'Configuraciones generales',
				'config' => $config
			);

			return view('panel/config', $data);
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function doedit(){
		$acc = Check::check(Auth::user()->permisos, 1);

		if( $acc || Auth::user()->rol == 1 ){

			$config = Config::find(1);
			$config->paypalClientId = Input::get('paypal-client-id');
			$config->paypalSecretId = Input::get('paypal-secret-id');
			$config->analytics = Input::get('analytics');
			$config->gmap = Input::get('gmap');
			$config->mailgun = Input::get('mailgun');
			$config->mail = Input::get('mail');
			$config->facebook = Input::get('facebook');
			$config->twitter = Input::get('twitter');
			$config->gplus = Input::get('gplus');
			$config->save();

			return redirect('appanel/configuracion');
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function getConfig(){
		$config = Config::find(1);
		return $config;
	}

}
?>