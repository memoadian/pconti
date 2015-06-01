<?php
namespace App\Http\Controllers;
use App\Picture;
use Image;
use Input;
use DB;
use App\Classes\Cleaner;

/**
* Image Controller
*/
class PanelImageController extends Controller{

	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$images = Picture::paginate(10);
		$data = array(
			'title' => 'Galería de imágenes',
			'images' => $images
		);
		return view('panel/images/index', $data);
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
				$name = Cleaner::url($upload->getClientOriginalName());
				$name = substr($name, 0, 10);

				//generamos el nombre de la imagen
				$filename = $name.'-'.$md5.'.'.$ext;

				//se mueve la imágen a la carpeta uploads
				$upload->move('uploads', $filename);
				$fileUrl = asset('uploads/'.$filename);
				$fileUrlMiddle = asset('uploads/sq/'.$filename);
				$file = public_path('uploads/'.$filename);

				//asignamos las carpetas a variables
				$pathMedium = public_path('uploads/medium/'.$filename);
				$pathSmall = public_path('uploads/small/'.$filename);
				$pathSq = public_path('uploads/sq/'.$filename);

				//redimensiones, a todos tamaños  de carpetascuidando el upsize
				Image::make($file)->resize(640, 640, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				})->save($pathMedium);
				Image::make($file)->fit(320, 320, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				})->save($pathSmall);
				Image::make($file)->fit(128, 128)->save($pathSq);

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

				$filename = $name.'-'.$md5.'.'.$ext;

				$fileUrlMiddle = asset('uploads/sq/'.$filename);
				//guardamos el status en json
				$status = array(
					'status' => 'repeat',
					'time'=> array(
						'time' => time()
					),
					'description' => 'La imágen ya existe',
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
		$pictures = Picture::paginate(50);
		$res = array();
		foreach($pictures as $p){
			$res[0] = array(
				'pages' => $pictures->render(),
			);
			$res[] = array(
				'id' => $p->id,
				'url' => $p->name.'-'.$p->md5.'.'.$p->ext,
			);
		}
		return response()->json($res);
	}

	public function remove($id){
		$img = Picture::find($id);
		$imgName = $img->name.'-'.$img->md5.'.'.$img->ext;
		if( file_exists( public_path( 'uploads/'.$imgName) ) ){
			unlink(	public_path( 'uploads/'.$imgName ) );
		}
		if( file_exists( public_path( 'uploads/medium/'.$imgName) ) ){
			unlink(	public_path( 'uploads/medium/'.$imgName ) );
		}
		if( file_exists( public_path( 'uploads/small/'.$imgName) ) ){
			unlink(	public_path( 'uploads/small/'.$imgName ) );
		}
		if( file_exists( public_path( 'uploads/sq/'.$imgName) ) ){
			unlink(	public_path( 'uploads/sq/'.$imgName ) );
		}

		$img->producto()->detach();
		$img->delete();

		DB::table('products')
            ->where('image', $imgName)
            ->update(['image' => '']);

		return 'Imágen eliminada correctamente';
	}

}

?>