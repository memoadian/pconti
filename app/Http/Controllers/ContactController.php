<?php

namespace App\Http\Controllers;
use App\Category;

/**
* Contact
*/
class ContactController extends Controller{
	
	public function index(){
		$data = array(
			'categorias' => Category::all(),
			'title' => 'Contacto PCONTI',
		);

		return view('front/contact', $data);
	}
}

?>