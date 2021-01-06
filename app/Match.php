<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Match extends Model
{
     use SoftDeletes;
 	 protected $fillable=[
    	'home_team_id','away_team_id','event_date','event_time'
	];

	
}
