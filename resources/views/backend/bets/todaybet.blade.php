@extends('layouts.backendtemplate')
@section('title', 'Bets')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Today Bet List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered dataTable">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Soccer</th>
                    <th scope="col">Home points</th>
                    <th scope="col">Away Points</th>
                    <th scope="col">Goal Over points</th>
                    <th scope="col">Goal Under points</th>
                  </tr>
                </thead>
                <tbody>
                  @php  $i=1; @endphp
                  @foreach($mymatches as $key=>$value)
                    @php $homepoints=0;$awaypoints=0;$overpoints=0;$underpoints=0; @endphp
                    @foreach($value as $row)
                    @php
                     $hometeam=$row->homename;
                     $awayteam=$row->awayname; 
                     $odd_team_status=$row->odd_team_status;
                     if(is_null($row->betting_total_goal_status)){
                      if($row->betting_team_status==0){
                        $homepoints+=$row->bet_amount;
                      }else{
                        $awaypoints+=$row->bet_amount;
                      }
                     }else{
                      if($row->betting_total_goal_status==0){
                        $overpoints+=$row->bet_amount;
                      }else{
                        $underpoints+=$row->bet_amount;
                      }
                     }
                     @endphp
                    @endforeach
                      <tr>
                      <td>{{$i++}}</td>
                      @if($odd_team_status==0)
                      <td class="align-middle"><span class="text text-danger">{{$hometeam}}</span> - {{$awayteam}}</td>
                      @else
                      <td class="align-middle">{{$hometeam}} - <span class="text text-danger">{{$awayteam}}</span></td>
                      @endif
                      <td><a  href="{{route('homepoints',$row->match_id)}}" class="badge badge-primary" style="cursor: pointer;">{{$homepoints}}</a></td>
                      <td><a href="{{route('awaypoints',$row->match_id)}}" class="badge badge-primary"  style="cursor: pointer;">{{$awaypoints}}</a></td>
                      <td><a href="{{route('overpoints',$row->match_id)}}" class="badge badge-primary"  style="cursor: pointer;">{{$overpoints}}</a></td>
                      <td><a href="{{route('underpoints',$row->match_id)}}" class="badge badge-primary"  style="cursor: pointer;">{{$underpoints}}</a></td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('script')

@endsection