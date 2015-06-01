<?php

namespace App\Http\Controllers;
use App\Category;

/**
* Políticas
*/
class LegalController extends Controller{
	
	public function index(){
		$data = array(
			'categorias' => Category::all(),
			'title' => 'Políticas PCONTI',
		);

		return view('front/legal', $data);
	}
}

?>