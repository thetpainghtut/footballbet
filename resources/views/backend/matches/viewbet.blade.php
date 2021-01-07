@extends('layouts.backendtemplate')
@section('title', 'Bets')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Bet List</h6>
            </div>
            <div class="card-body">
             {{--  <form method="" action="" class="mb-4">
                <div class="form-row">
                  <div class="col">
                    <input type="date" class="form-control" placeholder="Start Date">
                  </div>
                  <div class="col">
                    <input type="date" class="form-control" placeholder="End Date">
                  </div>
                  <div class="col">
                    <select name="" class="form-control d-inline">
                      <option value="">Mg Mg</option>
                      <option value="">Ko Ko</option>
                      <option value="">Aung Aung</option>
                    </select>
                    <input type="submit" name="btn-submit" class="btn btn-info" value="Search"> 
                  </div>
                </div>
              </form>--}}
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Match</th>
                    <th scope="col">FT HDP</th>
                    <th scope="col">FT OU</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach($bets as $row)
                  @php 
                  $time=$row->created_at;
                  $latest_time=date("h:i A",strtotime($time));
                  @endphp
                  <tr>
                    <td>{{$i++}}</td>
                     @if($row->odd_team_status==0)
                    <td>
                     <span class="text-danger">{{$row->match->home_team->name}}</span>
                      -{{$row->match->away_team->name}}
                    </td>
                    @else
                    <td>
                      {{$row->match->home_team->name}}-<span class="text-danger">{{$row->match->away_team->name}}</span>
                    </td>
                    @endif
                    <td>({{$row->team_goal_different}}{{$row->team_bet_odd}})</td>
                    <td>({{$row->team_goal}}{{$row->team_goal_bet_odd }})</td>
                    <td>{{$row->created_at->toDateString()}}</td>
                    <td>{{$latest_time}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection