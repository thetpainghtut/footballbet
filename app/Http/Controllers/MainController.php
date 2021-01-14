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

class MainController extends Controller
{
    public function main(){

    	$leagues=League::whereHas('matches',function($query){
    		$query->whereHas('betrates');
    	})->get();
    	//dd($matches);
    	return view('frontend.main',compact('leagues'));
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

                $agent->betrates()->attach($bet_id, ['bet_amount' => $p, 'betting_team_status' => $status,'goal_different_equal'=>$goal_different_equal,'goal_different_greater' => $goal_different_greater,'goal_different_less' =>$goal_different_less ]);
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
                $agent->betrates()->attach($bet_id, ['bet_amount' => $p, 'betting_team_status' => $status,'goal_different_equal'=>$goal_different_equal,'goal_different_greater' => $goal_different_greater,'goal_different_less' =>$goal_different_less ]);
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
                $agent->betrates()->attach($bet_id, ['bet_amount' => $p, 'betting_total_goal_status' => $goalstatus,'goal_different_equal'=>$goal_different_equal,'goal_different_greater' => $goal_different_greater,'goal_different_less' =>$goal_different_less ]);
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
                $agent->betrates()->attach($bet_id, ['bet_amount' => $p, 'betting_total_goal_status' => $goalstatus,'goal_different_equal'=>$goal_different_equal,'goal_different_greater' => $goal_different_greater,'goal_different_less' =>$goal_different_less ]);
            }
        }
        $agent=Agent::find($id);
        $agent->points=$agent->points-$p;
        $agent->save();
        return "success";
    }

    public function bets(){

        $agents=Agent::with('betrates.match.result')->whereHas('betrates')->get();
        //dd($agents);
        
        return view('backend.bets.index',compact('agents'));
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
        return "success";

    }

    public function generatepoint(Request $request){
        $user = Auth::user();
        $master_id=$user->id;
        $id=$request->id;
        //dd($id);
        $result=Result::find($id);
        $match_id=$result->match_id;
        //dd($match_id);


        $agentbetrates=DB::table('agent_betrate')
            ->join('betrates', 'betrates.id', '=', 'agent_betrate.betrate_id')
            ->where('betrates.match_id',$match_id)
            ->select('betrates.*','agent_betrate.*')
            ->get();
        //dd($agents);
        $winloosepoint=0;


            foreach ($agentbetrates as $betrate) {
                if($betrate->betting_total_goal_status===null){ 
                      $team_goal_different=$betrate->team_goal_different;
                      $bteam_goal_different=$result->home_team_score-$result->away_team_score;
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


        return "success";

    }

    public function result(){
        $results=League::whereHas('matches')->get();
        return view('frontend.result',compact('results'));
    }

    public function bet_list(){
        $user = Auth::user();
        $id=$user->agent->id;
        
        $agent=Agent::with('betrates.match.result')->whereHas('betrates')->where('id',$id)->first();
        //dd($agent);
        return view('frontend.bet_list',compact('agent'));
    }

    public function pagereload($value='')
    {
        $matches=Match::with('league')->with('betrates')->with('home_team')->with('away_team')->get();
        return $matches;
    }

}
