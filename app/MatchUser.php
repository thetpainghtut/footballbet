<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MatchUser extends Model
{
	use SoftDeletes;
 	 protected $fillable=[
     'bet_id','user_id','bet_amount','betting_team_status','betting_total_goal_status',
	];
  
}
