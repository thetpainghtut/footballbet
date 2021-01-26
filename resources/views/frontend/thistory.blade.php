@extends('layouts.master')
@section('title','Report')
@section('content')
<div class="col-lg-9">
  <div class="row my-4">
    {{-- <div class="col-md-12">
      <h4 class="d-inline-block"><u>ပေးရန်၊ ရရန် စာရင်းချုပ်။</u></h4>
    </div> --}}
    <div class="col-md-12 my-4">
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Date</th>
            <th scope="col">point</th>
            <th scope="col">Soccer</th>
            <th scope="col">Description</th>
            <th scope="col">Type</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">19/11/2020</th>
            <td class="align-middle">50,000 Ks</td>
            <td class="align-middle">
              <a href="{{route('report_detail')}}" class="btn btn-info">Show Results</a>
            </td>
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