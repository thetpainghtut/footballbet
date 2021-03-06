<!DOCTYPE html>
<html>
<head>
	<title>PDF</title>
</head>
<body>
	<table border="1" cellpadding="5px">
        <thead>
            <tr>
                <th>No</th>
                <th>Agent</th>
                <th>Soccer</th>
                <th>Type</th>
               	<th>Rate</th>
                <th>Bet</th>
                <th>Points</th>
                <th>Win/loose points</th>
            </tr>
        </thead>
        <tbody>
        @php 
                  $i=1;
                  $date = Carbon\Carbon::now();
                  $todaydate=$date->toDateString();
                  $now = Carbon\Carbon::now();
                  $current_time=date("h:i A",strtotime($now));
                  $totalpoint=0;

        @endphp
                  //dd($current_time);
                  @foreach($data as $betrate)
                  @php
                  $time=$betrate->event_time;
                  $event_time=date("h:i A",strtotime($time));
                  @endphp
                  <tr>
                  <td class="align-middle">{{$i++}}</th>
                  <td class="align-middle">{{$betrate->agentname}}</td>
                  @if($betrate->odd_team_status==0)
                  <td class="align-middle"><span class="text text-danger">{{$betrate->homename}}</span>({{$betrate->home_team_score}} )- {{$betrate->awayname}} ({{$betrate->away_team_score}})</td>
                  @else
                  <td class="align-middle">{{$betrate->homename}}({{$betrate->home_team_score}})- <span class="text text-danger">{{$betrate->awayname}}</span>({{$betrate->away_team_score}})</td>
                  @endif
                  <td class="align-middle">
                    @if(is_null($betrate->betting_total_goal_status))
                      @if($betrate->betting_team_status==0)
                        Home
                      @else
                        Away
                      @endif
                    @elseif(is_null($betrate->betting_team_status))
                      @if($betrate->betting_total_goal_status!=0)
                        Goal Under
                      @else
                        Goal Over
                      @endif
                    @endif
                  </td>
                  <td class="align-middle">{{$betrate->rate}}</td>
                  <td class="align-middle">
                    @if(is_null($betrate->betting_total_goal_status))
                    ({{$betrate->team_goal_different}}{{$betrate->team_bet_odd}})
                    @else
                    ({{$betrate->team_goal}}{{$betrate->team_goal_bet_odd}})
                    @endif
                  </td>
                  <td class="align-middle">{{$betrate->bet_amount}}@if($betrate->status==2)<span style="color: yellow;">cancel</span> @endif</td>

                @if($betrate->status!=2)
                  @if($betrate->home_team_score==null)
                  <td class="align-middle">-</td>
                  @else
                  <td class="align-middle">
                    @if($betrate->betting_total_goal_status===null)
                      @php 
                    if($betrate->team_goal_different==null){
                     $betrate->team_goal_different="";
                          }
                    if($betrate->team_bet_odd==null){
                      $betrate->team_bet_odd="";
                        }
                    if($betrate->team_goal==null){
                      $betrate->team_goal="";
                      }
                    if($betrate->team_goal_bet_odd==null){
                      $betrate->team_goal_bet_odd="";
                  }     
                      $team_goal_different=$betrate->team_goal_different;
                      if($betrate->odd_team_status==0){
                        $bteam_goal_different=$betrate->home_team_score-$betrate->away_team_score;
                      }else{
                        $bteam_goal_different=$betrate->away_team_score-$betrate->home_team_score;
                      }
                      
                      $winloosepoint=0;
                      if($bteam_goal_different>$team_goal_different){
                        $winloosepoint+=$betrate->goal_different_greater;
                        }else if($bteam_goal_different<$team_goal_different){
                          $winloosepoint+=$betrate->goal_different_less;
                        }else{
                          $winloosepoint+=$betrate->goal_different_equal;
                        }

                        $totalpoint+=$winloosepoint;
                     
                      @endphp
                     {{$winloosepoint}}
                      
                    @else
                      @php 
                      $team_goal_different=$betrate->team_goal;
                      $bteam_goal_different=$betrate->home_team_score+$betrate->away_team_score;
                      $winloosepoint=0;
                      if($bteam_goal_different>$team_goal_different){
                        $winloosepoint+=$betrate->goal_different_greater;
                        }else if($bteam_goal_different<$team_goal_different){
                          $winloosepoint+=$betrate->goal_different_less;
                        }else{
                          $winloosepoint+=$betrate->goal_different_equal;
                        }
                      $totalpoint+=$winloosepoint;
                      @endphp
                     {{$winloosepoint}}
                    
                    @endif

                  </td>
                  @endif
                  @else
                    <td class="align-middle">-</td>
                  @endif
                    
                  </tr>
                  @endforeach
                  <tr><td colspan="7">Total point</td><td>{{$totalpoint}}</td></tr>
        </tbody>
     </table>
	

</body>
</html>