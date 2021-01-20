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
              <span class="float-right">Dec 06, 2020</span>
            </div>
            <div class="card-body">
              <form method="" action="" class="mb-4">
                <div class="form-row">
                  <div class="col-3">
                    <input type="date" class="form-control sdate" placeholder="Start Date">
                  </div>
                  <div class="col-3">
                    <input type="date" class="form-control edate" placeholder="End Date">
                  </div>
                  <div class="col-3">
                    <select name="" class="form-control d-inline agent">
                      <option value="">Choose Agent</option>
                      @foreach($allagents as $row)
                      <option value="{{$row->id}}">{{$row->user->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-3">
                    <a href="#" class="btn btn-info btnsearch">search</a>
                  </div>
                </div>
              </form>
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Agent</th>
                    <th scope="col">Soccer</th>
                    <th scope="col">Type</th>
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
                  @php $totalpoint=0; @endphp
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
                  <td class="align-middle"><span class="text text-danger">{{$betrate->homename}}</span> - {{$betrate->awayname}}</td>
                  @else
                  <td class="align-middle">{{$betrate->homename}} - <span class="text text-danger">{{$betrate->awayname}}</span></td>
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
                  <tr><td colspan="7">totalpoint</td><td colspan="2">{{$totalpoint}}</td></tr>
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

    $(".btnsearch").click(function(){
      //alert("ok");
      var sdate=$(".sdate").val();
      var edate=$(".edate").val();
      var agent_id=$(".agent").val();
      var url="{{route('betsbyagent')}}";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.post(url,{sdate:sdate,edate:edate,agent_id:agent_id},function(res){
        //console.log(res);
        var m=1;
        var html=""; 
        $.each(res,function(j,k){ 
          var totalpoint=0;
          $.each(k,function(i,v){
            if(v.team_goal_different==null){
              v.team_goal_different="";
            }
            if(v.team_bet_odd==null){
              v.team_bet_odd="";
            }
            if(v.team_goal==null){
              v.team_goal="";
            }
            if(v.team_goal_bet_odd==null){
              v.team_goal_bet_odd="";
            }     
          html+=`<tr>
                  <td class="align-middle">${m++}</th>
                  <td class="align-middle">${v.agentname}</td>`
                  if(v.odd_team_status==0)
                  {
                  html+=`<td class="align-middle"><span class="text text-danger">${v.homename}</span> - ${v.awayname}</td>`
                  }else{
                  html+=`<td class="align-middle">${v.homename} - <span class="text text-danger">${v.awayname}</span></td>`
                  }
                  html+=`<td class="align-middle">`
                    if(v.betting_total_goal_status==null){
                      if(v.betting_team_status==0){
                       html+= `Home`
                      }else{
                       html+=`Away`
                      }
                    }else if(v.betting_team_status==null){
                      if(v.betting_total_goal_status!=0){
                       html+=`Goal Under`
                      }else{
                       html+=`Goal Over`
                      }
                    }
                  html+=`</td>
                  <td class="align-middle">${v.rate}</td>
                  <td class="align-middle">`
                    if(v.betting_total_goal_status==null){
                    html+=`(${v.team_goal_different}${v.team_bet_odd})`
                    }else{
                    html+=`(${v.team_goal}${v.team_goal_bet_odd})`
                  }
                    
                  html+=`</td>
                  <td class="align-middle">${v.bet_amount}</td>`
                  if(v.home_team_score==null){
                  html+=`<td class="align-middle">-</td>`
                  }else{
                  html+=`<td class="align-middle">`
                    if(v.betting_total_goal_status===null){
                      var team_goal_different=v.team_goal_different;
                      if(v.odd_team_status==0){
                        var bteam_goal_different=v.home_team_score-v.away_team_score;
                      }else{
                        var bteam_goal_different=v.away_team_score-v.home_team_score;
                      }
                      
                      var winloosepoint=0;
                      if(bteam_goal_different>team_goal_different){
                        winloosepoint+=v.goal_different_greater;
                        }else if(bteam_goal_different<team_goal_different){
                          winloosepoint+=v.goal_different_less;
                        }else{
                          winloosepoint+=v.goal_different_equal;
                        }
                     
                        totalpoint+=winloosepoint;
                    
                     html+=`${winloosepoint}`
                      
                    }else{
                      var team_goal_different=v.team_goal;
                      var bteam_goal_different=v.home_team_score+v.away_team_score;
                      var winloosepoint=0;
                      if(bteam_goal_different>team_goal_different){
                        winloosepoint+=v.goal_different_greater;
                        }else if(bteam_goal_different<team_goal_different){
                          winloosepoint+=v.goal_different_less;
                        }else{
                          winloosepoint+=v.goal_different_equal;
                        }
                     
                        totalpoint+=winloosepoint;
                     
                     html+=`${winloosepoint}`
                    
                    }

                  html+=`</td>`
                  }

                
                 html+= `<td class="align-middle"><a href="#" class="btn btn-warning btn-sm btncancel" data-id="${v.bcreated_at}" data-agentid="${v.agent_id}">cancel</a></td>
                  `
        })
          html+=`<tr><td colspan="7">totalpoint</td><td colspan="2">${totalpoint}</td></tr>`
      })
      $(".mytbody").html(html);

      })

    })
  })
</script>
@endsection