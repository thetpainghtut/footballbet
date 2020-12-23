<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Agent extends Model
{
	 use SoftDeletes;
 	 protected $fillable=[
    'user_id','phone_no','address','commission_rate'
	];

	public function user()
  {
    return $this->belongsTo('App\User');
  }
}
