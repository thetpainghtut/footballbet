@extends('layouts.backendtemplate')
@section('title', 'Bets')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Goal Over Detail</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered dataTable">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Agent</th>
                    <th scope="col">Soccer</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Bet</th>
                    <th scope="col">Points</th>
                    <th scope="col">Win/loose points</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody class="mytbody">
                  @php 
                  $i=1;
                  $date = Carbon\Carbon::now();
                  $todaydate=$date->toDateString();
                  $now = Carbon\Carbon::now();
                  $current_time=date("h:i A",strtotime($now));
                  //dd($current_time);
                  @endphp
                  @foreach($mymatches as $agents)
                  @foreach($agents as $betrate)
                  @php
                  $time=$betrate->event_time;
                  $event_time=date("h:i A",strtotime($time));
                  //dd($event_time);
                  @endphp
                  <tr>
                  <td class="align-middle">{{$i++}}</th>
                  <td class="align-middle">{{$betrate->agentname}}</td>
                  @if($betrate->odd_team_status==0)
                  <td class="align-middle"><span class="text text-danger">{{$betrate->homename}}</span>({{$betrate->home_team_score}} )- {{$betrate->awayname}} ({{$betrate->away_team_score}})</td>
                  @else
                  <td class="align-middle">{{$betrate->homename}}({{$betrate->home_team_score}})- <span class="text text-danger">{{$betrate->awayname}}</span>({{$betrate->away_team_score}})</td>
                  @endif
                  <td class="align-middle">{{$betrate->rate}}</td>
                  <td class="align-middle">
                    @if(is_null($betrate->betting_total_goal_status))
                    ({{$betrate->team_goal_different}}{{$betrate->team_bet_odd}})
                    @else
                    ({{$betrate->team_goal}}{{$betrate->team_goal_bet_odd}})
                    @endif
                  </td>
                  <td class="align-middle">{{$betrate->bet_amount}}</td>

                  
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
                     
                
                      @endphp
                     {{$winloosepoint}}
                    
                    @endif

                  </td>
                  @endif

                
                 {{--  @if($todaydate==$betrate->match->event_date)

                    @if($current_time>=$event_time)
                      <td class="align-middle"><a href="#" class="badge badge-primary">time up</a></td>
                    @else
                     <td class="align-middle"><a href="#" class="btn btn-warning btn-sm btncancel" data-id="{{$betrate->pivot->created_at}}" data-agentid="{{$agent->id}}">cancel</a></td>
                    @endif
                  
                  @else --}}
                  <td class="align-middle"><a href="#" class="btn btn-warning btn-sm btncancel" data-id="{{$betrate->bcreated_at}}" data-agentid="{{$betrate->agent_id}}">cancel</a></td>
                  {{-- @endif --}}
                    
                  </tr>
                  @endforeach
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
<script type="text/javascript">
  $(document).ready(function(){
    $(".mytbody").on('click','.btncancel',function(){
      var id=$(this).data('id');
      var agent_id=$(this).data('agentid');

     // console.log(id);
     var url="{{route('cancelbet')}}";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
     $.post(url,{id:id,agent_id:agent_id},function(res){
      //console.log(res);
      if(res=="success"){
        alert("cancel successfully");
        window.location.reload();
      }
     })

    })
  })
</script>

@endsection