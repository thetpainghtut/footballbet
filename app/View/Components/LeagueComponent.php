<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\League;

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
        $this->leagues = League::all();
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
