@extends('layouts.master')
@section('title','Bet_List')
@section('content')
<div class="col-lg-9">
  <div class="row my-4">
    <div class="col-12">
      <form method="" action="" class="mb-4">
                <div class="form-row">
                  <div class="col-3">
                    <input type="date" class="form-control sdate" placeholder="Start Date">
                  </div>
                  <div class="col-3">
                    <input type="date" class="form-control edate" placeholder="End Date">
                  </div>
                  <div class="col-3">
                    <a href="#" class="btn btn-info btnsearch">search</a>
                  </div>
                </div>
              </form>
    </div>
    <div class="col-md-12">
      <div class="table-responsive">
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
                <tbody class="mytbody">
                  @php $totalpoint=0; $i=1;@endphp
                  @foreach($agents as $betrate)
                  @php
                  $time=$betrate->event_time;
                  $event_time=date("h:i A",strtotime($time));
                  //dd($event_time);
                  @endphp
                  <tr>
                  <td class="align-middle">{{$i++}}</th>
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
                  <td class="align-middle">{{number_format($betrate->bet_amount)}}</td>

                  
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
                     {{number_format($winloosepoint)}}
                      
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
                     {{number_format($winloosepoint)}}
                    
                    @endif

                  </td>
                  @endif        
                  </tr>
                  @endforeach
                  <tr><td colspan="6">totalpoint</td><td colspan="2">{{number_format($totalpoint)}}</td></tr>
                </tbody>
        </table>
      </div>
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

       $(".btnsearch").click(function(){
      //alert("ok");
      var sdate=$(".sdate").val();
      var edate=$(".edate").val();
      var agent_id=null;
      var url="{{route('agentbetlist')}}";
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
                  <td class="align-middle">${m++}</th>`
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
                  <td class="align-middle">${thousands_separators(v.bet_amount)}</td>`
                  if(v.home_team_score==null){
                  html+=`<td class="align-middle">-</td>`
                  }else{
                  html+=`<td class="align-middle">`
                    if(v.betting_total_goal_status===null){
                      var team_goal_different=v.team_goal_different;
                      if(v.odd_team_status==0){
                        var bteam_goal_different=Number(v.home_team_score)-Number(v.away_team_score);
                      }else{
                        var bteam_goal_different=Number(v.away_team_score)-Number(v.home_team_score);
                      }
                      
                      var winloosepoint=0;
                      if(bteam_goal_different>team_goal_different){
                        winloosepoint+=Number(v.goal_different_greater);
                        }else if(bteam_goal_different<team_goal_different){
                          winloosepoint+=Number(v.goal_different_less);
                        }else{
                          winloosepoint+=Number(v.goal_different_equal);
                        }
                     
                        totalpoint+=winloosepoint;
                    
                     html+=`${thousands_separators(winloosepoint)}`
                      
                    }else{
                      var team_goal_different=v.team_goal;
                      var bteam_goal_different=Number(v.home_team_score)+Number(v.away_team_score);
                      var winloosepoint=0;
                      if(bteam_goal_different>team_goal_different){
                        winloosepoint+=Number(v.goal_different_greater);
                        }else if(bteam_goal_different<team_goal_different){
                          winloosepoint+=Number(v.goal_different_less);
                        }else{
                          winloosepoint+=Number(v.goal_different_equal);
                        }
                     
                        totalpoint+=winloosepoint;
                     
                     html+=`${thousands_separators(winloosepoint)}`
                    
                    }

                  html+=`</td>`
                  }

                
        })
          html+=`<tr><td colspan="6">totalpoint</td><td colspan="2">${thousands_separators(totalpoint)}</td></tr>`
      })
      $(".mytbody").html(html);

      })

    })
    function thousands_separators(num){
      var num_parts = num.toString().split(".");
      num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return num_parts.join(".");
    }
    });
  </script>
@endsection