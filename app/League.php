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

}
