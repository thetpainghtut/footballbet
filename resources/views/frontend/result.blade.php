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
        <tbody>
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
      
    });
  </script>
@endsection