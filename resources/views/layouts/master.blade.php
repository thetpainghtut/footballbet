<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Page - @yield('title')</title>

  <!-- Bootstrap core CSS -->
  <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

 

  <!-- Custom styles for this template -->
  <link href="{{ asset('frontend_assets/css/custom.css')}}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">9 Bet</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-md-2 {{ Request::is('main') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('main')}}">Main
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item mx-md-2 {{ Request::is('result') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('result')}}">Result</a>
          </li>
          <li class="nav-item mx-md-2 {{ Request::is('bet_list') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('bet_list')}}">Bet List</a>
          </li>
           <li class="nav-item mx-md-2 {{ Request::is('transactionhistory') ? 'active' : '' }}">
            <a class="nav-link" href="{{route('transactionhistory')}}">Transaction History</a>
          </li>
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">
        <div class="accordion" id="accordionExample">
          <ul class="list-group my-4">
            <li class="list-group-item d-flex justify-content-between align-items-center active" data-toggle="collapse" data-target="#collapseOne" type="button"> {{ Auth::user()->agent->points }} points
              <span><i class="fas fa-plus"></i></span>
            </li>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Account
                <span class="badge badge-primary badge-pill p-2">{{Auth::user()->email}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Cash Balance
                <span class="badge badge-primary badge-pill">50 USD</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Statements
                <span class="badge badge-primary badge-pill">2</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Outstanding
                <span class="badge badge-primary badge-pill">2</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Setting
                <span class="badge badge-primary badge-pill">2</span>
              </li>
            </div>
          </ul>
        </div>

        <x-league-component></x-league-component>

        <ul class="list-group soccer my-4 d-none">
          <li class="list-group-item active"> Soccer </li>
          <li class="list-group-item">
            <p class="text-center">League Name</p>
            <p class="mb-0">Team One vs Team Two</p>
            <p>AWAY <strong>(0.95)</strong></p>
            <p>
              <label>US: </label>
              <input type="number" name="">
            </p>
            <p class="text-center">
              <button type="submit" class="btn btn-dark btn-sm">Process</button>
              <button type="reset" class="btn btn-dark btn-sm">Cancel</button>
            </p>
          </li>
          <li class="list-group-item p-0">
            <table class="table table-sm table-bordered mb-0">
              <tbody>
                <tr>
                  <td>Max Payout</td>
                  <td>0.00</td>
                </tr>
                <tr>
                  <td>Min Bet</td>
                  <td>20.00</td>
                </tr>
                <tr>
                  <td>Max Bet</td>
                  <td>1,000.00</td>
                </tr>
              </tbody>
            </table>
          </li>
        </ul>

      </div>
      <!-- /.col-lg-3 -->
      @yield('content')
    </div>
  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-primary">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('frontend_assets/vendor/jquery/jquery.min.js') }}"></script>
  {{-- <script src="{{ asset('frontend_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
  <script src="https://kit.fontawesome.com/8586f1f1ae.js" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      // Add minus icon for collapse element which is open by default
      // $(".collapse.show").each(function(){
      //   $(this).prev(".card-header").find(".fas").addClass("fa-minus").removeClass("fa-plus");
      // });
      
      // Toggle plus minus icon on show hide of collapse element
      $(".collapse").on('show.bs.collapse', function(){
        $(this).prev(".list-group-item").find(".fas").removeClass("fa-plus").addClass("fa-minus");
      }).on('hide.bs.collapse', function(){
        $(this).prev(".list-group-item").find(".fas").removeClass("fa-minus").addClass("fa-plus");
      });
    });
  </script>
  @yield('script')
</body>
</html>