<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Category Model
*/
class Category extends Model{
	
	public $timestamps = false;
	protected $table = 'categories';

	public function producto(){
		$this->hasMany('App\Product');
	}

}

?>