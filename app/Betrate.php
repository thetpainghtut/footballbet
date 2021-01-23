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

	public function agents(){
		return $this->belongsToMany('App\Agent','agent_betrate','agent_id','betrate_id')
					->withPivot('bet_amount','betting_team_status','betting_total_goal_status','goal_different_equal','goal_different_greater','goal_different_less','status')
      				->withTimestamps();
	}
}
