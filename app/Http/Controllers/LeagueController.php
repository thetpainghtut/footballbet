<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues=League::all();
        return view('backend.leagues.index',compact('leagues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.leagues.create');
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
            'country'  => ['required', 'string', 'max:255'],
        ]);
        if($validator){
            $league = new League;
            $league->name=$request->name;
            $league->country=$request->country;
            $league->save();
            return redirect()->route('leagues.index')->with("successMsg",'New League is ADDED in your data');
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
        $league=League::find($id);
        return view('backend.leagues.edit',compact('league'));
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
            'country'  => ['required', 'string', 'max:255'],
        ]);
        if($validator){
            $league = League::find($id);
            $league->name=$request->name;
            $league->country=$request->country;
            $league->save();
            return redirect()->route('leagues.index')->with("successMsg",'Update Successfully');
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
        $league=League::find($id);
        $league->delete();
       return redirect()->route('leagues.index')->with('successMsg','Existing league is DELETED in your data');
    }
}
