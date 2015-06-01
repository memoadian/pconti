<?php

namespace App\Classes;

/**
* Cleaner
*/
class Cleaner{
	
	static function url($str, $replace=array(), $delimiter='-') {
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}

	static function excerpt($str, $word_limit){
		$words = explode(" ",$str);
		$result = implode(" ", array_splice($words, 0, $word_limit));
		return $result.'...';
	}
}

?>