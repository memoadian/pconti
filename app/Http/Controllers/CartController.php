<?php

namespace App\Http\Controllers;
use Cart;
use Input;
use App\Classes\Cleaner;

/**
* Carrito
*/
class CartController extends Controller{

	public function add(){
		$id = Input::get('id');
		$name = Input::get('name');
		$qty = 1;
		$price = Input::get('price');
		$image = Input::get('image');
		$sku = Input::get('sku');

		Cart::add(
			array(
				'id' => $id,
				'name' => $name,
				'qty' => $qty,
				'price' => $price,
				'options' => array(
					'image' => $image,
					'sku' => $sku,
					'slug' => Cleaner::url($name)
				),
			)
		);

		return Cart::content();
	}

	public function content(){
		return Cart::content();
	}

	public function total(){
		return Cart::total();
	}

	public function items(){
		return Cart::count();
	}

	public function vaciar(){
		Cart::destroy();
	}

	public function remove(){
		$rowId = Input::get('remove');
		Cart::remove($rowId);
	}

}

?>