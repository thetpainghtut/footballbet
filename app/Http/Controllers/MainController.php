<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Match;
use Auth;
use App\Agent;
use App\Betrate;
use App\MatchUser;
use App\Result;
use App\TransationPoint;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Response;

class MainController extends Controller
{
    public function main(){ 
        //dd($start_date);
    return view('frontend.main');
    }

    public function maindata(){
    $start_date=Carbon::now()->toDateString();
    $addingday =Carbon::now()->addDays(1);
    $end_date=$addingday->toDateString();

    $time = Carbon::now();
    $mytime=strtotime($time);
    $addingtime=date("Y-m-d H:i", strtotime('+5 minutes', $mytime));
    //dd($addingtime);

    $matches=Match::with('betrates')->with('league')->with('home_team')->with('away_team')->whereHas('betrates')->doesntHave('result')->whereBetween('event_date',[$start_date,$end_date])->where('datetime','>',$addingtime)->get();
    $mymatches=$matches->groupBy('league.name');
    return $mymatches;
    }

    public function matchbyleague(Request $request){
    	$id=$request->id;
    	//dd($id);
    	$matches=League::with('matches.betrates')->with('matches.home_team')->with('matches.away_team')->whereHas('matches')->where('id',$id)->get();
    	return $matches;
    }

    public function loginuser(){
        $user = Auth::user();
        $id=$user->id;
        // dd($id);
        $agent=Agent::where('user_id',$id)->first();
        return $agent;
    }

    public function matchuser(Request $request){
        //dd($request);
        $user = Auth::user();
        $agent=$user->agent;
        $id=$user->agent->id;
        $cr=$user->agent->commission_rate/100;

        $bet_id=$request->bet_id;
        $p=$request->point;
        $status=$request->bstatus;
        $goalstatus=$request->bgoalstatus;
        $bet=Betrate::find($bet_id);
        if($goalstatus==null){
            $goaldifferent=$bet->team_goal_different;
            $betodd=$bet->team_bet_odd;
            if($status==$bet->odd_team_status){
                if($betodd=="="){
                    $goal_different_equal=0;
                }else{
                $equal=$p*($betodd/100);
                //dd($equal);
                $array  = array_map('intval', str_split($equal));
                if($array[0]!=0){
                    $goal_different_equal=$equal*(0.95+$cr);
                }else{
                   $goal_different_equal=$equal*(1-$cr);  
                }
                }
                
                $goal_different_greater=$p*(0.95+$cr);
                $goal_different_less=-$p*(1-$cr);

                $agent->betrates()->attach($bet_id, ['bet_amount' => $p, 'betting_team_status' => $status,'goal_different_equal'=>$goal_different_equal,'goal_different_greater' => $goal_different_greater,'goal_different_less' =>$goal_different_less ,'status'=>0]);
                //dd("hi");

                //$matchuser->goal_different_equal=
            }else{
                
                if($betodd=="="){
                    $goal_different_equal=0;
                }else{
                    $equal=$p*-($betodd/100);
                   $array  = array_map('intval', str_split($equal));
                 if($array[0]!=0){
                    $goal_different_equal=$equal*(0.95+$cr);
                }else{
                   $goal_different_equal=$equal*(1-$cr);  
                } 
                }
                //dd($equal*0.95);
                
                $goal_different_greater=-$p*(1-$cr);
                $goal_different_less=$p*(0.95+$cr);
                $agent->betrates()->attach($bet_id, ['bet_amount' => $p, 'betting_team_status' => $status,'goal_different_equal'=>$goal_different_equal,'goal_different_greater' => $goal_different_greater,'goal_different_less' =>$goal_different_less,'status'=>0]);
            }
        }else{
            $goaldifferent=$bet->team_goal_different;
            $betodd=$bet->team_goal_bet_odd;
            //dd($betodd);
            if($goalstatus==0){
                if($betodd=="="){
                    $goal_different_equal=0;
                }else{
                $equal=$p*($betodd/100);
                $array  = array_map('intval', str_split($equal));
                if($array[0]!=0){
                    $goal_different_equal=$equal*(0.95+$cr);
                }else{
                   $goal_different_equal=$equal*(1-$cr);  
                }
                }
               
                $goal_different_greater=$p*(0.95+$cr);
                $goal_different_less=-$p*(1-$cr);
                $agent->betrates()->attach($bet_id, ['bet_amount' => $p, 'betting_total_goal_status' => $goalstatus,'goal_different_equal'=>$goal_different_equal,'goal_different_greater' => $goal_different_greater,'goal_different_less' =>$goal_different_less,'status'=>0]);
            }else{
               if($betodd=="="){
                    $goal_different_equal=0;
                }else{
                    $equal=$p*-($betodd/100);
                $array  = array_map('intval', str_split($equal));
                 if($array[0]!=0){
                    $goal_different_equal=$equal*(0.95+$cr);
                }else{
                   $goal_different_equal=$equal*(1-$cr);  
                } 
                }
               
                $goal_different_greater=-$p*(1-$cr);
                $goal_different_less=$p*(0.95+$cr);
                $agent->betrates()->attach($bet_id, ['bet_amount' => $p, 'betting_total_goal_status' => $goalstatus,'goal_different_equal'=>$goal_different_equal,'goal_different_greater' => $goal_different_greater,'goal_different_less' =>$goal_different_less,'status'=>0 ]);
            }
        }
        $agent=Agent::find($id);
        $agent->points=$agent->points-$p;
        $agent->save();
        $transation=New TransationPoint;
        $transation->from=$user->id;
        $transation->to=1;
        $transation->transation_type_id=3;
        $transation->points=$p;
        $transation->description="bet point";
        $transation->save();
        return "success";
    }

    public function bets(){
        $allagents=Agent::all();

        /*$agents=Agent::with('betrates.match.result')->whereHas('betrates')->get();
        //dd($agents);*/

        $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->whereDate('agent_betrate.created_at',Carbon::today())
                ->where('agent_betrate.deleted_at',null)
                ->get();
        $mymatches=$agents->groupBy('agent_id');
       // dd($mymatches);
        
        return view('backend.bets.index',compact('mymatches','allagents'));
    }


    public function betsbyagent(Request $request){
        $sdate=$request->sdate;
        //dd($sdate);
        $edate=$request->edate;
        $agent_id=$request->agent_id;
        $betrates="";

        if($agent_id==null){
        $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->whereBetween('agent_betrate.created_at',[$sdate.' 00:00:00',$edate.' 23:59:59'])
                ->where('agent_betrate.deleted_at',null)
                ->get();
            $betrates=$agents->groupBy('agent_id');
        }else if($sdate==null &&$edate==null){
            $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->where('agent_betrate.agent_id',$agent_id)
                ->where('agent_betrate.deleted_at',null)
                ->get();
                $betrates=$agents->groupBy('agent_id');
        }else{
             $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->where('agent_betrate.agent_id',$agent_id)
                ->whereBetween('agent_betrate.created_at',[$sdate.' 00:00:00',$edate.' 23:59:59'])
                ->where('agent_betrate.deleted_at',null)
                ->get();
                $betrates=$agents->groupBy('agent_id');
        }
        return $betrates;

    }

    public function storeresult(Request $request){
        $validator = $request->validate([
            'h_goal'=> ['required'],
            'a_goal'=> ['required'],
        ]);
        if($validator){
            $result = new Result;
            $result->match_id=$request->match_id;
            $result->home_team_score=$request->h_goal;
            $result->away_team_score=$request->a_goal;
            $result->total_goal=$request->h_goal+$request->a_goal;
            $result->match_status=1;
            $result->save();
            return response()->json(['success'=>'Result is successfully added!']);
        }else{
             return redirect::back()->withErrors($validator);
        }
    }

    public function cancelbet(Request $request){
        $id=$request->id;
        $agent_id=$request->agent_id;

        $agent=Agent::find($agent_id);
        $agentbetrate=$agent->betrates()->wherePivot('created_at','=',$id)->first();
        $addingpoints=$agentbetrate->pivot->bet_amount;
        $agent->points+=$addingpoints;
        $agent->save();
        $agent->betrates()->wherePivot('created_at','=',$id)->detach();
        $user = Auth::user();
        $master_id=$user->id;
        $transation=New TransationPoint;
        $transation->from=$master_id;
        $transation->to=$agent->user_id;
        $transation->transation_type_id=3;
        $transation->points=$addingpoints;
        $transation->description="cancel point";
        $transation->save();
        return "success";

    }

    public function generatepoint(Request $request){
        $user = Auth::user();
        $master_id=$user->id;
        $id=$request->id;
        //dd($id);
        $result=Result::find($id);
        $match_id=$result->match_id;
       // dd($match_id);


        $agentbetrates=DB::table('agent_betrate')
            ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
            ->where('betrates.match_id',$match_id)
            ->select('betrates.*','agent_betrate.*')
            ->where('agent_betrate.deleted_at',null)
            ->get();
        //dd($agents);
                $winloosepoint=0;


            foreach ($agentbetrates as $betrate) {
                if($betrate->team_goal_different==null){
                     $betrate->team_goal_different="";
                          }
                    if($betrate->team_bet_odd==null){
                      $betrate->team_bet_odd="";
                        }
                    if($betrate->team_goal==null){
                      $betrate->team_goal="";
                      }
                    if($betrate->team_goal_bet_odd==null){
                      $betrate->team_goal_bet_odd="";
                  }  
                if($match_id==$betrate->match_id){
                if($betrate->betting_total_goal_status===null){ 
                      $team_goal_different=$betrate->team_goal_different;
                      if($betrate->odd_team_status==0){
                         $bteam_goal_different=$result->home_team_score-$result->away_team_score;
                     }else{
                         $bteam_goal_different=$result->away_team_score-$result->home_team_score;
                     }   
                      //dd($bteam_goal_different);
                      $winloosepoint=0;
                      if($bteam_goal_different>$team_goal_different){
                        $winloosepoint+=$betrate->goal_different_greater;
                        }else if($bteam_goal_different<$team_goal_different){
                          $winloosepoint+=$betrate->goal_different_less;
                        }else{
                          $winloosepoint+=$betrate->goal_different_equal;
                        }
                }else{
                    $team_goal_different=$betrate->team_goal;
                    $bteam_goal_different=$result->home_team_score+$result->away_team_score;
                    $winloosepoint=0;
                    if($bteam_goal_different>$team_goal_different){
                    $winloosepoint+=$betrate->goal_different_greater;
                    }else if($bteam_goal_different<$team_goal_different){
                    $winloosepoint+=$betrate->goal_different_less;
                    }else{
                     $winloosepoint+=$betrate->goal_different_equal;
                    }
                    
                }

                    $agent=Agent::find($betrate->agent_id);
                    $agentpoint=$agent->points;
                    $betpoint=$betrate->bet_amount;
                    $beforebetpoint=$agentpoint+$betpoint;
                    //dd($beforebetpoint);
                    $afterpoint=$beforebetpoint+$winloosepoint;
                    //dd($afterpoint);
                    $agent->points=$afterpoint;
                    $agent->save();
                    $transation=New TransationPoint;
                    $transation->from=$master_id;
                    $transation->to=$agent->user_id;
                    $transation->transation_type_id=4;
                    $transation->points=$winloosepoint;
                    $transation->description="refund point";
                    $transation->save();
                   
                    $result->match_status=2;
                    $result->save();
        }
    }

        return "success";

    }

    public function result(){
        $results=League::whereHas('matches')->get();
        return view('frontend.result',compact('results'));
    }

    public function bet_list(){
        $user = Auth::user();
        $id=$user->agent->id;
        
        
         $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->whereDate('agent_betrate.created_at',Carbon::today())
                ->where('agent_betrate.agent_id',$id)
                ->where('agent_betrate.deleted_at',null)
                ->get();
        //dd($agent);
        return view('frontend.bet_list',compact('agents'));
    }

    public function pagereload($value='')
    {
        $matches=Match::with('league')->with('betrates')->with('home_team')->with('away_team')->get();
        return $matches;
    }

    public function agentbetlist(Request $request){
        $sdate=$request->sdate;
        //dd($sdate);
        $edate=$request->edate;
        $user = Auth::user();
        $id=$user->agent->id;
        $agents=DB::table('agent_betrate')
                ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
                ->join('matches','matches.id','=','betrates.match_id')
                ->leftJoin('results','results.match_id','=','matches.id')
                ->join('teams as teama','teama.id','=','matches.home_team_id')
                ->join('teams as teamb','teamb.id','=','matches.away_team_id')
                ->join('agents','agents.id','=','agent_betrate.agent_id')
                ->join('users','users.id','=','agents.user_id')
                ->select('agent_betrate.*','matches.*','results.*','teama.name as homename','teamb.name as awayname','users.name as agentname','agents.commission_rate as rate','agent_betrate.created_at as bcreated_at','betrates.*')
                ->whereBetween('agent_betrate.created_at',[$sdate.' 00:00:00',$edate.' 23:59:59'])
                ->where('agent_betrate.agent_id',$id)
                ->where('agent_betrate.deleted_at',null)
                ->get();
            $betrates=$agents->groupBy('agent_id');

            return $betrates;
    }


    public function sellpoint(Request $request){
        $validator = $request->validate([
            'sellpoint'=> ['required'],
        ]);
        if($validator){
        DB::transaction(function() use($request){
        $agent_id=$request->agent_id;
        $sellpoint=$request->sellpoint;
        $user = Auth::user();
        $master_id=$user->id;
        //dd($agent_id);
        $agent=Agent::find($agent_id);
        $agent_points=$agent->points;
        $agent->points=$agent_points-$sellpoint;
        $agent->save();
        $transation=New TransationPoint;
        $transation->from=$master_id;
        $transation->to=$agent->user->id;
        $transation->transation_type_id=2;
        $transation->points=$sellpoint;
        $transation->description="sell point";
        $transation->save();
        });
        return response()->json(['success'=>'successfully sell!']);
        }else{
             return redirect::back()->withErrors($validator);
        }
    }

    public function addpoint(Request $request){
        $validator = $request->validate([
            'addpoint'=> ['required'],
        ]);
        if($validator){
        DB::transaction(function() use($request){
        $agent_id=$request->agent_id;
        $addpoint=$request->addpoint;
        $user = Auth::user();
        $master_id=$user->id;
        //dd($agent_id);
        $agent=Agent::find($agent_id);
        $agent_points=$agent->points;
        $agent->points=$agent_points+$addpoint;
        $agent->save();
        $transation=New TransationPoint;
        $transation->from=$master_id;
        $transation->to=$agent->user->id;
        $transation->transation_type_id=1;
        $transation->points=$addpoint;
        $transation->description="add point";
        $transation->save();
        });
        return response()->json(['success'=>'successfully add!']);
        }else{
             return redirect::back()->withErrors($validator);
        }
    }

    public function generatestartingpoint(Request $request){
       $validator = $request->validate([
            'agents'=> ['required'],
        ]);
        if($validator){
            $requestagents=$request->agents; // 1,2
            $agenttransaction=[];
            foreach ($requestagents as $key => $value) {
                $transation=TransationPoint::with('touser.agent')->whereHas('touser.agent',function($query) use($value){
                    $query->where('id',$value);
                })->where('transation_type_id',5)->first();
                array_push($agenttransaction, $transation);
            }
            foreach ($agenttransaction as $row) {
                $agent=Agent::find($row->touser->agent->id);
                $points=$agent->points;
                $tpoints=$row->points;
                dd($agent->fixbetrates()->get());
                if($points>=$tpoints){
                 DB::transaction(function() use($agent,$tpoints){
                    $transactionpoints=$agent->points-$tpoints;
                    $agent->points=$tpoints;
                    $agent->save();
                    $user = Auth::user();
                    $master_id=$user->id;
                    $transation=New TransationPoint;
                    $transation->from=$master_id;
                    $transation->to=$agent->user->id;
                    $transation->transation_type_id=1;
                    $transation->points=$transactionpoints;
                    $transation->description="generate add point";
                    $transation->save();
                 });
                }elseif($points<$tpoints){
                    DB::transaction(function() use($agent,$tpoints){
                    $transactionpoints=$tpoints-$agent->points;
                    $agent->points=$tpoints;
                    $agent->save();
                    $user = Auth::user();
                    $master_id=$user->id;
                    $transation=New TransationPoint;
                    $transation->from=$master_id;
                    $transation->to=$agent->user->id;
                    $transation->transation_type_id=2;
                    $transation->points=$transactionpoints;
                    $transation->description="generate sell point";
                    $transation->save();
                 });
                }
            }

            return response()->json(['success'=>'successfully generate!']);
        }else{
           return redirect::back()->withErrors($validator); 
        }

    }

}
