<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BetController extends Controller
{

   
    public function todaybetlist(){
    $start_date=Carbon::now()->toDateString();
    $addingday =Carbon::now()->addDays(1);
    $end_date=$addingday->toDateString();
    	$agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->select('teama.name as homename','teamb.name as awayname','betrates.*','agent_betrate.*')
                ->where('agent_betrate.deleted_at',null)
                ->whereBetween('matches.event_date',[$start_date,$end_date])
                ->get();
        $mymatches=$agents->groupBy('match_id');
        //dd($mymatches);
    	return view('backend.bets.todaybet',compact('mymatches'));
    }
    public function homepoints(Request $request){
        $matchid=$request->id;
        $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->where('betrates.match_id',$matchid)
                ->where('agent_betrate.betting_team_status',0)
                ->where('agent_betrate.deleted_at',null)
                ->get();
        //dd($agents);
        $mymatches=$agents->groupBy('agent_id');
        //dd($mymatches);
        return view('backend.bets.home',compact('mymatches'));

    }

    public function awaypoints(Request $request){
        $matchid=$request->id;
        $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->where('betrates.match_id',$matchid)
                ->where('agent_betrate.betting_team_status',1)
                ->where('agent_betrate.deleted_at',null)
                ->get();
        //dd($agents);
        $mymatches=$agents->groupBy('agent_id');
        //dd($mymatches);
        return view('backend.bets.away',compact('mymatches'));

    }

     public function overpoints(Request $request){
        $matchid=$request->id;
        $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->where('betrates.match_id',$matchid)
                ->where('agent_betrate.betting_total_goal_status',0)
                ->where('agent_betrate.deleted_at',null)
                ->get();
        //dd($agents);
        $mymatches=$agents->groupBy('agent_id');
        //dd($mymatches);
        return view('backend.bets.over',compact('mymatches'));

    }
    public function underpoints(Request $request){
        $matchid=$request->id;
        $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->where('betrates.match_id',$matchid)
                ->where('agent_betrate.betting_total_goal_status',1)
                ->where('agent_betrate.deleted_at',null)
                ->get();
        //dd($agents);
        $mymatches=$agents->groupBy('agent_id');
        //dd($mymatches);
        return view('backend.bets.under',compact('mymatches'));

    }
}
