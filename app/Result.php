<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
	 use SoftDeletes;
 	 protected $fillable=[
   		 'match_id','home_team_score','away_team_score','total_goal','match_status',
   		];


   public function match(){
		return $this->belongsTo('App\Match');
	}
}
