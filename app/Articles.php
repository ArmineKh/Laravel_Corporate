<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';

	public function user(){
		return $this->belongsTo("App\User.phgp", "user_id");
	}
	public function categores(){
		return $this->belongsTo("App\Categories.php", "category_id");
	}
	
}
