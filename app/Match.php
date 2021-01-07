<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Match extends Model
{
     use SoftDeletes;
 	 protected $fillable=[
    	'league_id','home_team_id','away_team_id','event_date','event_time'
	];

	public function league(){
		return $this->belongsTo('App\League');
	}

	public function home_team(){
		return $this->belongsTo('App\Team','home_team_id');
	}

	public function away_team(){
		return $this->belongsTo('App\Team','away_team_id');
	}

	public function betrate(){
		return $this->hasMany('App\Betrate');
	}

	public function result(){
		return $this->hasOne('App\Result');
	}
	
}
