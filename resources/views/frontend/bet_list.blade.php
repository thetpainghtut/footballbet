@extends('layouts.master')
@section('title','Bet_List')
@section('content')
<div class="col-lg-9">
  <div class="row my-4">
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Soccer</th>
            <th scope="col">Type</th>
            <th scope="col">Rate</th>
            <th scope="col">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  {{-- end row --}}

  <div class="row my-4">
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

  </div>
  <!-- /.row -->
</div>
<!-- /.col-lg-9 -->
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      
    });
  </script>
@endsection