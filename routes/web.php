<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('main', function (){
  return view('frontend.main');
})->name('main');

Route::get('bet_list', function (){
  return view('frontend.bet_list');
})->name('bet_list');

Route::get('result', function (){
  return view('frontend.result');
})->name('result');

Route::get('report', function (){
  return view('frontend.report');
})->name('report');

Route::get('report_detail', function (){
  return view('frontend.report_detail');
})->name('report_detail');

// backend
Route::get('dashboard', function (){
  return view('backend.dashboard');
})->name('dashboard');

// bets
Route::get('bets', function (){
  return view('backend.bets.index');
})->name('bets.index');

Route::prefix('master')->group(function () {
Route::resource('agents','AgentController');
Route::resource('leagues','LeagueController');
Route::resource('teams','TeamController');
Route::resource('matches','MatchController');
});
