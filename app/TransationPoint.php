<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransationPoint extends Model
{
	use SoftDeletes;
 	 protected $fillable=[
    	'from','to','transation_type_id','points','description',
	];

	public function fromuser()
  {
    return $this->belongsTo('App\User','from');
  }

  public function touser()
  {
    return $this->belongsTo('App\User','to');
  }
    
}
