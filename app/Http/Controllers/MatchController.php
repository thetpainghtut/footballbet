<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\League;
use Illuminate\Support\Facades\DB;
use App\Match;
use App\Betrate;
class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches=Match::doesntHave('result')->with('betrates')->get();
       // dd($matches);
        return view('backend.matches.index',compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams=Team::orderBy('name','asc')->get();
        $leagues=League::orderBy('name','asc')->get();
        return view('backend.matches.create',compact('teams','leagues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
        'league'  => ['required'],
        'hteam'=>['required'],
        'ateam'=>['required'],
        'date'=>['required','date'],
        ]);
        if($validator){
            //dd($request->date);
            $new_date = date("Y-m-d H:i",strtotime($request->date));
            //dd($new_date);
            $date_ar = explode(' ', $new_date);
            //dd($date_ar);
            $match=new Match;
            $match->league_id=$request->league;
            $match->home_team_id=$request->hteam;
            $match->away_team_id=$request->ateam;
            $match->event_date=$date_ar[0];
            $match->event_time=$date_ar[1];
            $match->datetime=$new_date;
            $match->save();
            return redirect()->route('matches.index')->with("successMsg",'New Match is ADDED in your data');
        }
        else
        {
            return redirect::back()->withErrors($validator);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $match=Match::find($id);
        $league_id=$match->league_id;
        $teams=DB::table('teams')
            ->join('team_leagues', 'teams.id', '=', 'team_leagues.team_id')
            ->join('leagues', 'leagues.id', '=', 'team_leagues.league_id')
            ->select('teams.*')
            ->where('team_leagues.league_id',$league_id)
            ->orderBy('name','asc')
            ->get();
        $leagues=League::orderBy('name','asc')->get();
        return view('backend.matches.edit',compact('match','teams','leagues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validator = $request->validate([
        'league'  => ['required'],
        'hteam'=>['required'],
        'ateam'=>['required'],
        'date'=>['required'],
        ]);
        if($validator){
            //dd($request->date);
            $new_date = date("Y-m-d H:i",strtotime($request->date));
            //dd($new_date);
            $date_ar = explode(' ', $new_date);
            $match=Match::find($id);
            $match->league_id=$request->league;
            $match->home_team_id=$request->hteam;
            $match->away_team_id=$request->ateam;
            $match->event_date=$date_ar[0];
            $match->event_time=$date_ar[1];
            $match->datetime=$new_date;
            $match->save();
            return redirect()->route('matches.index')->with("successMsg",'Update Successfully');
        }
        else
        {
            return redirect::back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $match=Match::find($id);
        $match->delete();
       return redirect()->route('matches.index')->with('successMsg','Existing match is DELETED in your data');
    }

    public function teambyleague(Request $request){
        $id=$request->id;

        $teams=DB::table('teams')
            ->join('team_leagues', 'teams.id', '=', 'team_leagues.team_id')
            ->join('leagues', 'leagues.id', '=', 'team_leagues.league_id')
            ->select('teams.*')
            ->where('team_leagues.league_id',$id)
            ->orderBy('name','asc')
            ->get();
        //dd($teams);
        return $teams;

    }

    public function storebet(Request $request){
        $validator = $request->validate([
        'sign'  => ['required'],
        'status'=>['required'],
        'overundersign'=>['required'],
        ]);
        if($validator){
            $bet=new Betrate;
            $bet->match_id=$request->match_id;
            $bet->team_goal_different=$request->normalbet;
            $bet->team_bet_odd=$request->sign.$request->bet;
            $bet->odd_team_status=$request->status;
            $bet->team_goal_bet_odd=$request->overundersign.$request->obet;
            $bet->team_goal=$request->overunderbet;
            $bet->save();
            return redirect()->route('matches.index')->with("successMsg",'Bet is ADDED in your data');
        }
        else
        {
            return redirect::back()->withErrors($validator);
        }
        
    }


    public function betbymatch(Request $request){
        $id=$request->id;
        //dd($id);
        $bet=Betrate::where('match_id',$id)->latest()->first();
        return $bet;
    }


    public function viewbet($id){
        $bets=Betrate::where('match_id',$id)->get(); 

        return view('backend.matches.viewbet',compact('bets'));

    }
}
