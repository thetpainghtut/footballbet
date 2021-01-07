@extends('layouts.master')
@section('title','Main')
@section('content')
  <div class="col-lg-9">

    {{-- <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div> --}}

    <div class="row my-4">

      {{-- <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Item One</a>
            </h4>
            <h5>$24.99</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Item Two</a>
            </h4>
            <h5>$24.99</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Item Three</a>
            </h4>
            <h5>$24.99</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
          </div>
        </div>
      </div> --}}
      <div class="col-md-12">
        <div class="alert alert-success" role="alert">
          A simple success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
      </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <table class="table table-sm table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">TIME</th>
              <th scope="col">EVENT</th>
              <th scope="col">FT HDP</th>
              <th scope="col">HOME</th>
              <th scope="col">AWAY</th>
              <th scope="col">FT OU</th>
              <th scope="col">OVER</th>
              <th scope="col">UNDER</th>
            </tr>
          </thead>
          <tbody class="mytbody">
            @foreach($leagues as $league)
            <tr class="table-primary">
              <td colspan="8">{{$league->name}}</td>
            </tr>

            @foreach($league->matches as $match)
            @php
              $betrate = App\Betrate::where('match_id',$match->id)->latest()->first();
              // dd($betrate);
            @endphp
            @if($betrate)
             @php 
              $time=$match->event_time;
              $event_time=date("h:i A",strtotime($time));
              @endphp
            <tr class="text-center">
              <th scope="row">
                {{$event_time}}
                <p class="mb-0 text-danger">Live</p>
              </th>
              @if($betrate->odd_team_status==0)
              <td class="align-middle"><span class="text text-danger">{{$match->home_team->name}}</span> - {{$match->away_team->name}}</td>
              @else
              <td class="align-middle">{{$match->home_team->name}} - <span class="text text-danger">{{$match->away_team->name}}</span></td>
              @endif
              <td class="align-middle">({{$betrate->team_goal_different}}{{$betrate->team_bet_odd}})</td>
              <td class="align-middle pointer">0.95</td>
              <td class="align-middle pointer">0.95</td>
              <td class="align-middle">({{$betrate->team_goal}}{{$betrate->team_goal_bet_odd }})</td>
              <td class="align-middle pointer">0.94</td>
              <td class="align-middle pointer">0.94</td>
            </tr>
            @endif
            @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /.col-lg-9 -->
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $(".mytbody").on('click','.pointer',function(res){
        $('.soccer').removeClass('d-none');
      })

      $(".league").click(function(){
        //alert("ok");
        var id=$(this).data('id');
        var url="{{route('matchbyleague')}}";
        var html=""
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $.post(url,{id:id},function(res){
          console.log(res);
          html+=``
          $.each(res,function(i,v){
            html+=`<tr class="table-primary">
                  <td colspan="8">${v.name}</td>
                </tr>
              `
            $.each(v.matches,function(j,k){
              var betrates=k.betrates;
              var rate=betrates.pop();
              var time=tConvert(k.event_time);
              if(rate.team_goal_different==null){
                rate.team_goal_different="";
              }
              if(rate.team_bet_odd==null){
                rate.team_bet_odd="";
              }
              if(rate.team_goal==null){
                rate.team_goal="";
              }
              if(rate.team_goal_bet_odd==null){
                rate.team_goal_bet_odd="";
              }     
              //console.log(k.betrate.odd_team_status);
              html+=`
              <tr class="text-center">
              <th scope="row">
                ${time}
                <p class="mb-0 text-danger">Live</p>
              </th>`
              if(rate.odd_team_status==0){
                //alert("ok");
              html+=`<td class="align-middle"><span class="text text-danger">${k.home_team.name}</span> - ${k.away_team.name}</td>`}
              else{
              html+=`<td class="align-middle">${k.home_team.name} - <span class="text text-danger">${k.away_team.name}</span></td>`
            }

            html+=` <td class="align-middle">(${rate.team_goal_different}${rate.team_bet_odd})</td>
            <td class="align-middle pointer">0.95</td>
              <td class="align-middle pointer">0.95</td>
              <td class="align-middle">(${rate.team_goal}${rate.team_goal_bet_odd }})</td>
              <td class="align-middle pointer">0.94</td>
              <td class="align-middle pointer">0.94</td>
            </tr>
              `
            })
          })
          $(".mytbody").html(html);
        })
      })


      function tConvert (time) {
  // Check correct time format and split into components
      time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) { // If time format correct
          time = time.slice (1);  // Remove full string match value
          time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
          time[0] = +time[0] % 12 || 12; // Adjust hours
          }
      return time.join (''); // return adjusted time or original string
    }
    });
  </script>
@endsection