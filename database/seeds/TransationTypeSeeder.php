<?php

use Illuminate\Database\Seeder;
use App\TransationType;
class TransationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     TransationType::create(['name' => 'ADD Points']);
     TransationType::create(['name' => 'Sell Points']);
     TransationType::create(['name' => 'Bet Points']);
     TransationType::create(['name' => 'Refund Points']);
     TransationType::create(['name' => 'Opening Points']);  
    }
}
