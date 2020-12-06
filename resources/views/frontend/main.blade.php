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
          <tbody>
            <tr class="table-primary">
              <td colspan="8">League Name</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle bg-danger">0</td>
              <td class="align-middle bg-danger">0.95</td>
              <td class="align-middle bg-danger">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle bg-warning pointer" style="cursor: pointer;">0.95</td>
              <td class="align-middle bg-warning">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle bg-warning">0.95</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="table-primary">
              <td colspan="8">League Name</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
            <tr class="text-center">
              <th scope="row">
                17:00
                <p class="mb-0 text-danger">Live</p>
              </th>
              <td class="align-middle">TEAM ONE vs TEAM TWO</td>
              <td class="align-middle">0</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">0.95</td>
              <td class="align-middle">3(-5)</td>
              <td class="align-middle">0.94</td>
              <td class="align-middle">0.94</td>
            </tr>
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
      // soccer play
      $(".pointer").click(function () {
        $('.soccer').removeClass('d-none');
      })
    });
  </script>
@endsection