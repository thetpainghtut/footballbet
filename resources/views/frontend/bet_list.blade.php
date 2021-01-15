@extends('layouts.master')
@section('title','Bet_List')
@section('content')
<div class="col-lg-9">
  <div class="row my-4">
    <div class="col-md-12">
      <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Soccer</th>
                    <th scope="col">Type</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Bet</th>
                    <th scope="col">Points</th>
                    <th scope="col">Win/loose points</th>

                  </tr>
                </thead>
                <tbody>
                  @php $i=1;$totalpoint=0; @endphp
                  @foreach($agent->betrates as $betrate)
                  <tr>
                  <td>{{$i++}}</th>
                  @if($betrate->odd_team_status==0)
                  <td class="align-middle"><span class="text text-danger">{{$betrate->match->home_team->name}}</span> - {{$betrate->match->away_team->name}}</td>
                  @else
                  <td class="align-middle">{{$betrate->match->home_team->name}} - <span class="text text-danger">{{$betrate->match->away_team->name}}</span></td>
                  @endif
                  <td>
                    @if(is_null($betrate->pivot->betting_total_goal_status))
                      @if($betrate->pivot->betting_team_status==0)
                        Home
                      @else
                        Away
                      @endif
                    @elseif(is_null($betrate->pivot->betting_team_status))
                      @if($betrate->pivot->betting_total_goal_status!=0)
                        Goal Under
                      @else
                        Goal Over
                      @endif
                    @endif
                  </td>
                  <td>{{$agent->commission_rate}}</td>
                  <td>
                    @if(is_null($betrate->pivot->betting_total_goal_status))
                    ({{$betrate->team_goal_different}}{{$betrate->team_bet_odd}})
                    @else
                    ({{$betrate->team_goal}}{{$betrate->team_goal_bet_odd}})
                    @endif
                  </td>
                  <td>{{$betrate->pivot->bet_amount}}</td>

                  
                  @if($betrate->match->result==null)
                  <td><span class="badge badge-info">match does not end</span></td>
                  @else
                  <td>
                    @if($betrate->pivot->betting_total_goal_status===null)
                      @php 
                      $team_goal_different=$betrate->team_goal_different;
                      $bteam_goal_different=$betrate->match->result->home_team_score-$betrate->match->result->away_team_score;
                      $winloosepoint=0;
                      if($bteam_goal_different>$team_goal_different){
                        $winloosepoint+=$betrate->pivot->goal_different_greater;
                        }else if($bteam_goal_different<$team_goal_different){
                          $winloosepoint+=$betrate->pivot->goal_different_less;
                        }else{
                          $winloosepoint+=$betrate->pivot->goal_different_equal;
                        }
                       $totalpoint+=$winloosepoint; 
                      @endphp
                     {{$winloosepoint}}
                      
                    @else
                      @php 
                      $team_goal_different=$betrate->team_goal;
                      $bteam_goal_different=$betrate->match->result->home_team_score+$betrate->match->result->away_team_score;
                      $winloosepoint=0;
                      if($bteam_goal_different>$team_goal_different){
                        $winloosepoint+=$betrate->pivot->goal_different_greater;
                        }else if($bteam_goal_different<$team_goal_different){
                          $winloosepoint+=$betrate->pivot->goal_different_less;
                        }else{
                          $winloosepoint+=$betrate->pivot->goal_different_equal;
                        }
                        $totalpoint+=$winloosepoint; 
                      @endphp
                     {{$winloosepoint}}
                    
                    @endif

                  </td>
                  @endif
                  

                  </tr>
                  @endforeach
                  <tr><td colspan="6">totalpoint</td><td>{{$totalpoint}}</td></tr>
                </tbody>
              </table>
    </div>
  </div>
  {{-- end row --}}

  {{-- <div class="row my-4">
    <div class="col-md-12">
      <h4>Point Rates:</h4>
    </div>
    
    
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
      </div>
    </div>

  </div> --}}
  <!-- /.row -->
</div>
<!-- /.col-lg-9 -->
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      
    });
  </script>
@endsection