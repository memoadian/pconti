<?php

namespace App\Http\Controllers;

/**
* Chear permisos
*/
class Check{
	
	public static function check($auth, $permiso){
		$array = json_decode($auth, true);
		$permitido = array();
		foreach( $array as $a){
			$permitido[] = $a['permit_key'];
		}
		if( in_array($permiso, $permitido) ){
			return true;
		}else{
			return false;
		}
	}
}

?>