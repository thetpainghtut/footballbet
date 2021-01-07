<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class League extends Model
{
     use SoftDeletes;
 	 protected $fillable=[
    'name','country'
	];

	public function teams(){
		return $this->belongsToMany('App\Team')->withTimestamps();
	}

	public function matches(){
		return $this->hasMany('App\Match');
	}

}
