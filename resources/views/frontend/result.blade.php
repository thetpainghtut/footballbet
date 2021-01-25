@extends('layouts.master')
@section('title','Result')
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
    <div class="col-12">
      <form method="" action="" class="mb-4">
                <div class="form-row">
                  <div class="col-3">
                    <input type="date" class="form-control sdate" placeholder="Start Date">
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
            <th scope="col">Date</th>
            <th scope="col">Event</th>
            <th scope="col">Goal Score</th>
          </tr>
        </thead>
        <tbody class="tbody">
         @foreach($results as $result)
          <tr>
            <td colspan="4" class="table-info">{{$result->name}}</td>
          </tr>
          @foreach($result->matches as $match)
           @php 
              $time=$match->event_time;
              $event_time=date("h:i A",strtotime($time));
            @endphp
            <tr>
            <th scope="row">{{Carbon\Carbon::parse($match->event_date)->format('d-m-Y')}} {{$event_time}}</th>
            <td class="align-middle">{{$match->home_team->name}} - {{$match->away_team->name}}</td>
            @if($match->result==null)
            <td>-</td>
            @else
            <td class="align-middle">{{$match->result->home_team_score}}-{{$match->result->away_team_score}}</td>
            @endif
          </tr>
          @endforeach
         @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>
  {{-- end row --}}
</div>
<!-- /.col-lg-9 -->
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){

      $(".btnsearch").click(function(){
      //alert("ok");
      var date=$(".sdate").val();
      var url="{{route('mainresult')}}";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.post(url,{date:date},function(res){
        var html="";
        $.each(res,function(i,v){
         html+=`<tr>
            <td colspan="4" class="table-info">${v.name}</td>
            </tr>`
            $.each(v.matches,function(j,k){
              html+=`<tr>
            <th scope="row">${(k.event_date)} ${tConvert(k.event_time)}</th>
            <td class="align-middle">${k.home_team.name} - ${k.away_team.name}</td>`
            if(k.result==null){
            html+=`<td>-</td>`
            }else{
            html+=`<td class="align-middle">${k.result.home_team_score}-${k.result.away_team_score}</td>`
            }
         html+=`</tr>`
            })
        })
        $(".tbody").html(html)
      })

    })

      function tConvert (time) {
          time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

          if (time.length > 1) { // If time format correct
          time = time.slice (1);  // Remove full string match value
          time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
          time[0] = +time[0] % 12 || 12; // Adjust hours
          }
        return time.join (''); // return adjusted time or original string
      }
      
    });
  </script>
@endsection