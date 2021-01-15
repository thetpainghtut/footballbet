<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Agent;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\TransationPoint;
class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents=Agent::all();
         return view('backend.agents.index',compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.agents.create');
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
            'email'  => ['required','string','email','max:255','unique:users'],
            'password'  => ['required','min:6','confirmed'],
            'phone'  => ['required'],
            'address'  => ['required','string'],
            'point' =>['required','numeric'],
            'rate' =>['required']
        ]);
        if($validator){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole('agent');
            $agent=new Agent;
            $agent->phone_no =$request->phone;
            $agent->address = $request->address;
            $agent->user_id=$user->id;
            $agent->points=$request->point;
            $agent->min_point=$request->min_point;
            $agent->max_point=$request->max_point;
            $agent->commission_rate=$request->rate;
            $agent->save();
            $master = Auth::user();
            $master_id=$user->id;
            $transation=New TransationPoint;
            $transation->from=$master_id;
            $transation->to=$agent->user_id;
            $transation->transation_type_id=5;
            $transation->points=$agent->points;
            $transation->description="opening point";
            $transation->save();
            return redirect()->route('agents.index')->with("successMsg",'New Agent is ADDED in your data');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $agent=Agent::find($id);
        return view('backend.agents.edit',compact('agent'));
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
            'email'  => ['required','string','email','max:255'],
            'phone'  => ['required'],
            'address'  => ['required','string'],
            'point' =>['required','numeric'],
            'rate' =>['required']
        ]);
         //dd($request);
        if($validator){
            $agent=Agent::find($id);
            $user =User::find($agent->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->password!=null){
              $user->password = Hash::make($request->password);   
          }else{
              $user->password = $request->oldpassword;
          }
           
            $user->save();
            
            $agent->phone_no =$request->phone;
            $agent->address = $request->address;
            $agent->user_id=$user->id;
            $agent->points=$request->point;
            $agent->min_point=$request->min_point;
            $agent->max_point=$request->max_point;
            $agent->commission_rate=$request->rate;
            $agent->save();
           
            return redirect()->route('agents.index')->with("successMsg",'Update Successfully');
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
        $agent=Agent::find($id);
        $user =User::find($agent->user_id);
        $user->delete();
        $agent->delete();
       return redirect()->route('agents.index')->with('successMsg','Existing Agent is DELETED in your data');
    }
}
