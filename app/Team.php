<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Team extends Model
{
    use SoftDeletes;
 	 protected $fillable=[
    'name'
	];
	 public function leagues(){
             return $this->belongsToMany('App\League','team_leagues','team_id','league_id')
      ->withTimestamps();;
    }
}
