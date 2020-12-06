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
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Event</th>
            <th scope="col">First Half Score</th>
            <th scope="col">Final Score</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="4" class="table-info">AFC Champions League</td>
          </tr>
          <tr>
            <th scope="row">19/11/2020 06:00 PM</th>
            <td class="align-middle">Sydney FC (N) -vs- Shanghai SIPG</td>
            <td class="align-middle">0-1</td>
            <td class="align-middle">0-2</td>
          </tr>
          <tr>
            <td colspan="4" class="table-info">AFC Champions League</td>
          </tr>
          <tr>
            <th scope="row">19/11/2020 06:00 PM</th>
            <td class="align-middle">Ecuador (V) -vs- Sweden (V)</td>
            <td class="align-middle">0-0</td>
            <td class="align-middle">0-1</td>
          </tr>
          <tr>
            <th scope="row">19/11/2020 06:00 PM</th>
            <td class="align-middle">Norway (V) -vs- France (V)</td>
            <td class="align-middle">0-2</td>
            <td class="align-middle">0-4</td>
          </tr><tr>
            <th scope="row">19/11/2020 06:00 PM</th>
            <td class="align-middle">Goias GO U20 -vs- Atletico Mineiro U20</td>
            <td class="align-middle">0-0</td>
            <td class="align-middle">0-0</td>
          </tr><tr>
            <th scope="row">19/11/2020 06:00 PM</th>
            <td class="align-middle">Sydney FC (N) -vs- Shanghai SIPG</td>
            <td class="align-middle">0-1</td>
            <td class="align-middle">0-2</td>
          </tr><tr>
            <th scope="row">19/11/2020 06:00 PM</th>
            <td class="align-middle">Vasco da Gama -vs- Fortaleza</td>
            <td class="align-middle">2-0</td>
            <td class="align-middle">2-2</td>
          </tr><tr>
            <th scope="row">19/11/2020 06:00 PM</th>
            <td class="align-middle">Sydney FC (N) -vs- Shanghai SIPG</td>
            <td class="align-middle">0-1</td>
            <td class="align-middle">0-2</td>
          </tr><tr>
            <th scope="row">19/11/2020 06:00 PM</th>
            <td class="align-middle">Sydney FC (N) -vs- Shanghai SIPG</td>
            <td class="align-middle">0-1</td>
            <td class="align-middle">0-2</td>
          </tr>
        </tbody>
      </table>
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