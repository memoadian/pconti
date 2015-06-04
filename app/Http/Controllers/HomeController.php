<?php 

namespace App\Http\Controllers;
use Auth;
use App\Product;
use App\Slider;
use App\Category;
use App\Classes\Cleaner;

class HomeController extends Controller {

	public function index(){
		if( Auth::check() ){
			$slider = Slider::all();

			$data = array(
				'categorias' => Category::take(6),
				'productos' => Product::take(4)->get(),
				'destacados' => Product::take(4)->where('outstanding', 1)->get(),
				'ofertas' => Product::take(4)->where('supply', 1)->get(),
				'slider' => $slider,
				'title' => 'Peleteria Continental',
			);
			return view('front/home', $data);
		}else{
			echo '<meta name="viewport" content="width=device-width, user-scalable=no"><img style="display:block; margin:0 auto; width:500px; max-width: 100%" src="http://www.inv.gov.ar/images/contenidos/pagina_en_construccion.jpg">';
		}
	}

}