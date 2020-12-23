<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\League;
class TeamController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams=Team::all();
        return view('backend.teams.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leagues=League::all();
        return view('backend.teams.create',compact('leagues'));
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
            'name'  => ['required', 'string', 'max:255'],
            'league'=>['required'],
        ]);
        if($validator){
            $team = new Team;
            $team->name=$request->name;
            $team->save();
            $team->leagues()->attach($request->league);
            return redirect()->route('teams.index')->with("successMsg",'New Team is ADDED in your data');
        }else{
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
        $team=Team::find($id);
        $leagues=League::all();
        return view('backend.teams.edit',compact('team','leagues'));
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
            'name'  => ['required', 'string', 'max:255'],
        ]);
        if($validator){
            $team = Team::find($id);
            $team->name=$request->name;
            $team->save();
            if($request->league!=null){
                 $team->leagues()->detach();
                 $team->leagues()->attach($request->league);
            }
            return redirect()->route('teams.index')->with("successMsg",'Update Successfully');
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
        $team=Team::find($id);
        $team->leagues()->detach();
        $team->delete();
       return redirect()->route('teams.index')->with('successMsg','Existing team is DELETED in your data');
    }
}
