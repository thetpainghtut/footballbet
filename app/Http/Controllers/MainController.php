<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Match;

class MainController extends Controller
{
    public function main(){

    	$leagues=League::whereHas('matches')->get();
    	//dd($matches);
    	return view('frontend.main',compact('leagues'));
    }

    public function matchbyleague(Request $request){
    	$id=$request->id;
    	//dd($id);
    	$matches=League::with('matches.betrate')->with('matches.home_team')->with('matches.away_team')->whereHas('matches')->where('id',$id)->get();
    	return $matches;
    }
}
