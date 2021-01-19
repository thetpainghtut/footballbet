<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon;
class Agent extends Model
{
	 use SoftDeletes;
 	 protected $fillable=[
    'user_id','phone_no','address','commission_rate','min_point','max_point',
	];

	public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function betrates(){
		return $this->belongsToMany('App\Betrate','agent_betrate','agent_id','betrate_id')
					->withPivot('bet_amount','betting_team_status','betting_total_goal_status','goal_different_equal','goal_different_greater','goal_different_less')
      				->withTimestamps();
	}
	// public function today_betrates($value='')
	// {
	// 	return $this->belongsToMany('App\Betrate')->wherePivot('created_at',Carbon\Carbon::today());
	// }
}
