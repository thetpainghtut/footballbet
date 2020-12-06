@extends('layouts.master')
@section('title','Report')
@section('content')
<div class="col-lg-9">
  <div class="row my-4">
    <div class="col-md-12">
      <h4 class="d-inline-block"><u>Dec 1, 2020 (50,000 Ks)</u></h4>
    </div>
    <div class="col-md-12 my-4">
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Soccer</th>
            <th scope="col">Type</th>
            <th scope="col">Rate</th>
            <th scope="col">Amount</th>
            <th scope="col">Own Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <th scope="row">#</th>
            <td class="align-middle">Team One vs Team Two</td>
            <td class="align-middle">AWAY</td>
            <td class="align-middle">0.95</td>
            <td class="align-middle">{{number_format(2000)}}</td>
            <td class="align-middle">{{number_format(2000)}}</td>
          </tr>
          <tr>
            <td colspan="5">Total</td>
            <td>50,000 Ks</td>
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