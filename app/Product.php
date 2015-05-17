<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	public $timestamps = false;

	public function imgs(){
		return $this->belongsToMany('App\Picture');
	}

	public function categoria(){
		return $this->belongsTo('App\Category', 'id_category', 'id');
	}

}
