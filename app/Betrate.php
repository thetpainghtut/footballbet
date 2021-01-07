<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Betrate extends Model
{
    use SoftDeletes;
 	 protected $fillable=[
    'match_id','team_bet_odd','team_goal_different','odd_team_status','team_goal_bet_odd','team_goal',
	];
    public function match(){
		return $this->belongsTo('App\Match');
	}
}
