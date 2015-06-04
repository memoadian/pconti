<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Orders
*/
class Order extends Model{
	
	public function usuario(){
		return $this->belongsTo('App\User', 'id_user', 'id');
	}
}

?>