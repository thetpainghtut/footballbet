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
                    {{-- <input type="submit" name="btn-submit" class="btn btn-info" value="Search"> --}}
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
                <tbody>
                  @php $i=1; @endphp
                  @foreach($agents as $agent)
                  @foreach($agent->betrates as $betrate)
                  <tr>
                  <td>{{$i++}}</th>
                  <td>{{$agent->user->name}}</td>
                  @if($betrate->odd_team_status==0)
                  <td class="align-middle"><span class="text text-danger">{{$betrate->match->home_team->name}}</span> - {{$betrate->match->away_team->name}}</td>
                  @else
                  <td class="align-middle">{{$betrate->match->home_team->name}} - <span class="text text-danger">{{$betrate->match->away_team->name}}</span></td>
                  @endif
                  <td>
                    @if($betrate->pivot->betting_total_goal_status===null)
                      @if($betrate->pivot->betting_team_status===0)
                        Home
                      @else
                        Away
                      @endif
                    @elseif($betrate->pivot->betting_team_status===null)
                      @if($betrate->pivot->betting_total_goal_status!==0)
                        Goal Under
                      @else
                        Goal Over
                      @endif
                    @endif
                  </td>
                  <td>{{$agent->commission_rate}}</td>
                  <td>
                    @if($betrate->pivot->betting_total_goal_status===null)
                    ({{$betrate->team_goal_different}}{{$betrate->team_bet_odd}})
                    @else
                    ({{$betrate->team_goal}}{{$betrate->team_goal_bet_odd}})
                    @endif
                  </td>
                  <td>{{$betrate->pivot->bet_amount}}</td>

                  
                  @if($betrate->match->result==null)
                  <td>-</td>
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
                     

                      @endphp
                     {{$winloosepoint}}
                    
                    @endif

                  </td>
                  @endif
                  
                  <td><a href="#" class="btn btn-warning btn-sm btncancel" data-id="{{$betrate->pivot->created_at}}" data-agentid="{{$agent->id}}">cancel</a></td>

                  </tr>
                  @endforeach
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
    $(".btncancel").click(function(){
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