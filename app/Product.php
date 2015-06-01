<?php

namespace App;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	use SearchableTrait;

	public $timestamps = false;

    protected $searchable = [
		'columns' => [
			'name' => 10,
		],
    ];

	public function imgs(){
		return $this->belongsToMany('App\Picture');
	}

	public function tags(){
		return $this->belongsToMany('App\Tag');
	}

	public function categoria(){
		return $this->belongsTo('App\Category', 'id_category', 'id');
	}

}
