<?php
namespace App\Http\Controllers;
use App\Picture;
use Image;
use Input;

/**
* Image Controller
*/
class PanelImageController extends Controller{

	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){

	}

	public function upload(){
		set_time_limit(3600);
		$up = Input::hasFile('file');
		$status = array();
		if($up){
			//guardamos la imágen en una variabñe
			$upload = Input::file('file');
			//obtenemos el md5
			$md5 = md5_file($upload);
			//consultamos el md5 en la bd
			$imagen = Picture::whereMd5($md5)->get();
			
			//si no encontramos coincidencias subimos
			if($imagen->isEmpty()){
				//traemos la extensión
				$ext = $upload->getClientOriginalExtension();
				if($ext == 'jpeg'){
					$ext = 'jpg';
				}

				//traemos el nobre d ela imagen para que sea más fácil encontrar la imagen
				$name = $this->cleaner($upload->getClientOriginalName());
				$name = substr($name, 0, 10);

				//generamos el nombre de la imagen
				$filename = $name.'-'.$md5.'.'.$ext;

				//se mueve la imágen a la carpeta uploads
				$upload->move('uploads', $filename);
				$fileUrl = asset('uploads/'.$filename);
				$fileUrlMiddle = asset('uploads/medium/'.$filename);
				$file = public_path('uploads/'.$filename);

				//asignamos las carpetas a variables
				$pathMedium = public_path('uploads/medium/'.$filename);
				$pathSq = public_path('uploads/sq/'.$filename);

				//redimensiones, a todos tamaños  de carpetascuidando el upsize
				Image::make($file)->resize(640, 640, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				})->save($pathMedium);
				Image::make($file)->resize(128, 128)->save($pathSq);

				//insertamos la imagen en la bd
				$nuevaImagen = new Picture;
				$nuevaImagen->md5 = $md5;
				$nuevaImagen->name = $name;
				$nuevaImagen->ext = $ext;
				$nuevaImagen->save();

				//obtenemos el id
				$id = $nuevaImagen->id;

				//guardamos el status
				$status = array(
					'status' => 'success',
					'time'=> array(
						'time' => time()
					),
					'description' => 'Se guardó la imagen',
					'pic' => $fileUrl,
					'filelink' => $fileUrlMiddle,
					'id' => $id
				);
			}else{
				//si la imágen ya existe obtenemos la url
				$name = $imagen[0]->name;
				$md5 = $imagen[0]->md5;
				$ext = $imagen[0]->ext;

				$fileUrl = asset('pictures/'.$imagen[0]->url);
				$fileUrlMiddle = asset('pictures/medium/'.$imagen[0]->url);
				//guardamos el status en json
				$status = array(
					'status' => 'repeat',
					'time'=> array(
						'time' => time()
					),
					'description' => 'La imágen ya existe',
					'pic' => $fileUrl,
					'filelink' => $fileUrlMiddle,
					'id' => $imagen[0]->id
				);
			}
		}else{
			//si la imagen no sube guardamos el error
			$status = array(
				'status' => 'error no se subió',
			);
		}
		//$status = json_encode($status);
		return response()->json($status);
	}

	public function picsJSON(){
		$pictures = Picture::all();
		$res = array();
		foreach($pictures as $p){
			$res[] = array(
				'id' => $p->id,
				'url' => $p->name.'-'.$p->md5.'.'.$p->ext
			);
		}
		return response()->json($res);
	}

	function cleaner($str, $replace=array(), $delimiter='-') {
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}

}

?>