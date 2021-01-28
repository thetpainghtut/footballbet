@extends('layouts.backendtemplate')
@section('title', 'Bets')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Transaction List</h6>
            </div>
             <div class="card-body">
              <form method="" action="" class="mb-4">
                <div class="form-row">
                  <div class="col-3">
                    <input type="date" class="form-control sdate" placeholder="Start Date">
                  </div>
                  <div class="col-3">
                    <input type="date" class="form-control edate" placeholder="End Date">
                  </div>
                  <div class="col-3">
                    <a href="#" class="btn btn-info btnsearch">search</a>
                  </div>
                </div>
              </form>
              <div class="table-responsive">
                <table class="table table-bordered dataTable" id="historytable">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Date</th>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Soccer</th>
                      <th scope="col">Type</th>
                      <th scope="col">point</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @foreach($transaction as $row)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{Carbon\Carbon::parse($row->created_at)->format('d-m-Y')}}</td>
                      <td>{{$row->fromuser->name}}</td>
                      <td>{{$row->touser->name}}</td>
                      @if($row->match_id!=null)
                      <td>{{$row->match->home_team->name}} vs {{$row->match->away_team->name}}</td>
                      @else
                      <td>-</td>
                      @endif
                      <td>{{$row->transation_type->name}}@if($row->description=="cancel point") <span class="badge badge-warning">cancel</span>@endif</td>
                      <td>{{number_format($row->points)}}</td>
                    </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
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
     $(".btnsearch").click(function(){
      //alert("ok");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var sdate=$(".sdate").val();
      var edate=$(".edate").val();
      var url="{{route('allhistorybydate')}}";
        var i=1;
         $('#historytable').DataTable({
        "processing": true,
        "serverSide": true,
        destroy:true,
        "sort":false,
        "stateSave": true,
          "ajax": {
            url: url,
            type: "POST",
            data:{sdate:sdate,edate:edate},
            dataType:'json',
          },
          "columns": [
          {"data":'DT_RowIndex'},
          {"data":'created_at',
          render:function(data){
            var date=formatDate(data);
            return date;
          }
          },
          {"data":'fromuser.name'},
          {"data":'touser.name'},
          {"data":null,
          render:function(data, type, full, meta){
            if(data.match_id!=null){
              return`${data.match.home_team.name} - ${data.match.away_team.name}`
            }else{
              return`-`
            }
          }
          },
          {
            "data":null,
            render:function(data, type, full, meta){
              if(data.description=="cancel point"){
                return `${data.transation_type.name} <span class="badge badge-warning">cancel</span>`
              }else{
                return `${data.transation_type.name}`
              }
            }
          },
          {"data":'points',
            render:function(data){
              return`${thousands_separators(data)}`
            }
          }
       ],
       "info":false
    });
    })

    function formatDate (input) {
        var datePart = input.match(/\d+/g),
        year = datePart[0].substring(0,4), // get only two digits
        month = datePart[1], day = datePart[2];
        return day+'-'+month+'-'+year;
    }
    function thousands_separators(num){
      var num_parts = num.toString().split(".");
      num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return num_parts.join(".");
    }

  })
</script>
@endsection