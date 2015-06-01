<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model{

	public $timestamps = false;
	
	public function usuario(){
		return $this->belongsToMany('App\User');
	}
}

?>