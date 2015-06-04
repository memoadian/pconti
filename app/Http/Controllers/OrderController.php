<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Auth;

/**
* Orders
*/
class OrderController extends Controller{
	
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$acc = Check::check(Auth::user()->permisos, 12);

		if( $acc || Auth::user()->rol == 1 ){
			$ordenes = Order::where('status', 1)->paginate(20);
			$data = array(
				'title' => 'Ordenes pendientes de enviar',
				'ordenes' => $ordenes
			);

			return view('panel/orders/index', $data);
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function order($id){
		$acc = Check::check(Auth::user()->permisos, 12);

		if( $acc || Auth::user()->rol == 1 ){
			$orden = Order::find($id);
			$data = array(
				'title' => 'Ordenes pendientes de enviar',
				'o' => $orden
			);

			return view('panel/orders/order', $data);
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function check($id){
		$acc = Check::check(Auth::user()->permisos, 10);

		if( $acc || Auth::user()->rol == 1 ){
			$orden = Order::find($id);
			$orden->status = 2;
			$orden->save();

			return redirect('appanel');
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function uncheck($id){
		$acc = Check::check(Auth::user()->permisos, 10);

		if( $acc || Auth::user()->rol == 1 ){
			$orden = Order::find($id);
			$orden->status = 1;
			$orden->save();

			return redirect('appanel/enviadas');
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function sends(){
		$acc = Check::check(Auth::user()->permisos, 10);

		if( $acc || Auth::user()->rol == 1 ){
			$ordenes = Order::where('status', 2)->paginate(20);
			$data = array(
				'title' => 'Ordenes enviadas',
				'ordenes' => $ordenes
			);

			return view('panel/orders/sends', $data);
		}else{
			return view( 'panel/noaccess', ['title' => 'Acceso denegado'] );
		}
	}

	public function remove($id){
		$acc = Check::check(Auth::user()->permisos, 11);

		if( $acc || Auth::user()->rol == 1 ){
			$orden = Order::find($id);
			$orden->delete();

			return 'La orden ha sido borrada con éxito';
		}else{
			return 'No tienes permisos para realizar esta acción';
		}
	}
}

?>