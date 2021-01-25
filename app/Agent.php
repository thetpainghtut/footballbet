<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
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
					->withPivot('bet_amount','betting_team_status','betting_total_goal_status','goal_different_equal','goal_different_greater','goal_different_less','status')
      				->withTimestamps();
	}

	public function fixbetrates($value='')
	{
		$end_date=Carbon::now();
        $addingday =Carbon::now()->subDays(4);
        $start_date=$addingday->toDateTimeString();

        $end_date=$end_date->hour(11)->minute(59)->second(59)->toDateTimeString();
        // dd($end_date);die();

		return $this->belongsToMany('App\Betrate')
					->withPivot('bet_amount','betting_team_status','betting_total_goal_status','goal_different_equal','goal_different_greater','goal_different_less','status')
      				->withTimestamps()
					->wherePivot('status',0)
					->wherePivot('created_at','<=',$end_date);
	}

	public function printbetrates($value=''){
		$end_date=Carbon::now();
        $addingday =Carbon::now()->subDays(4);
        $start_date=$addingday->toDateTimeString();

        $end_date=$end_date->hour(11)->minute(59)->second(59)->toDateTimeString();
        // dd($end_date);die();

		return $this->belongsToMany('App\Betrate')
					->withPivot('bet_amount','betting_team_status','betting_total_goal_status','goal_different_equal','goal_different_greater','goal_different_less','status')
      				->withTimestamps()
					->wherePivot('status',0)
					->orwherePivot('status',2)
					->wherePivot('created_at','<=',$end_date);
	}
	
}
