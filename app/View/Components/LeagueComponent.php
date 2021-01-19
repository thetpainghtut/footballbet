<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\League;
use Carbon;
use App\Match;

class LeagueComponent extends Component
{
    public $leagues;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    $start_date=Carbon\Carbon::now()->toDateString();
    $addingday =Carbon\Carbon::now()->addDays(1);
    $end_date=$addingday->toDateString();

    $time =Carbon\Carbon::now();
    $mytime=strtotime($time);
    $addingtime=date("Y-m-d H:i", strtotime('+5 minutes', $mytime));
    //dd($addingtime);

    $matches=Match::with('betrates')->with('league')->with('home_team')->with('away_team')->whereHas('betrates')->doesntHave('result')->whereBetween('event_date',[$start_date,$end_date])->where('datetime','>',$addingtime)->get();
        $this->leagues=$matches->groupBy('league_id');

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.league-component');
    }
}
