<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use Carbon\Carbon;
class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date=Carbon::now()->toDateString();
        //dd($date);
        $results=Result::with('match')->whereHas('match',function($query) use($date){
            $query->where('event_date',$date);
        })->get();
        return view('backend.result.index',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $result=Result::find($id);
        return $result;
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
            'h_goal'=> ['required'],
            'a_goal'=> ['required'],
        ]);
        if($validator){
            $result = Result::find($id);
            $result->home_team_score=$request->h_goal;
            $result->away_team_score=$request->a_goal;
            $result->total_goal=$request->h_goal+$request->a_goal;
            $result->save();
            return response()->json(['success'=>'Result is successfully updated!']);
        }else{
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
        //
    }

    public function resultbydate(Request $request){
        $date=$request->date;
        //dd($date);
        $results=Result::with('match.home_team')->with('match.away_team')->with('match.league')->whereHas('match',function($query) use($date){
            $query->where('event_date',$date);
        })->get();

        return $results;
    }
}
