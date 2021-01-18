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
Route::middleware('auth')->group(function () {
Route::get('/home', 'HomeController@index')->name('home');

Route::get('main','MainController@main')->name('main');
Route::get('maindata',"MainController@maindata")->name('maindata');
Route::get('pagereload','MainController@pagereload')->name('pagereload');

Route::post('matchbyleague','MainController@matchbyleague')->name('matchbyleague');
Route::get('loginuser','MainController@loginuser')->name('loginuser');
Route::post('matchuser','MainController@matchuser')->name('matchuser');
Route::get('bets','MainController@bets')->name('bets.index');
Route::post('storeresult','MainController@storeresult')->name('storeresult');
Route::post('cancelbet','MainController@cancelbet')->name('cancelbet');
Route::post('generatepoint','MainController@generatepoint')->name('generatepoint');
Route::get('result','MainController@result')->name('result');
Route::get('bet_list','MainController@bet_list')->name('bet_list');
Route::post('betsbyagent','MainController@betsbyagent')->name('betsbyagent');
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


Route::prefix('master')->group(function () {
  Route::resource('agents','AgentController');
  Route::resource('leagues','LeagueController');
  Route::resource('teams','TeamController');
  Route::resource('matches','MatchController');
  Route::get('matches/viewbet/{id}','MatchController@viewbet')->name('viewbet');

  Route::resource('results','ResultController');
});
Route::post('teambyleague','MatchController@teambyleague')->name('teambyleague');
Route::post('storebet','MatchController@storebet')->name('storebet');
Route::post('betbymatch','MatchController@betbymatch')->name('betbymatch');
});