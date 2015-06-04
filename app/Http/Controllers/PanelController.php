<?php

namespace App\Http\Controllers;
use App\Product;

/**
* Panel Controller
*/

class PanelController extends Controller{

	public function __construct(){
		$this->middleware('auth');
	}



}

?>