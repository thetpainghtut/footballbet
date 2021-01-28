@extends('layouts.backendtemplate')
@section('title', 'Bets')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Today Bet List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered dataTable" id="bettable">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Soccer</th>
                    <th scope="col">Home points</th>
                    <th scope="col">Away Points</th>
                    <th scope="col">Goal Over points</th>
                    <th scope="col">Goal Under points</th>
                  </tr>
                </thead>
                <tbody>
                  
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
    showdata();
    move();
    function showdata(){
      var url="{{route('livetodaybet')}}";
        $('#bettable').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true,
          "bStateSave": true,
          destroy:true,
          "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ -1,0] }
          ],
          "bserverSide": true,
          "bprocessing":true,
          "ajax": {
            url: url,
            type: "GET",
            dataType:'json',
          },
          "columns": [
          {"data":'DT_RowIndex'},
          {"data":null,
            render:function(data, type, full, meta){
              var hometeam="";
              var awayteam="";
              if(data[0].odd_team_status==0){
                hometeam=`<span class="text text-danger">${data[0].homename}</span>`
                awayteam=`${data[0].awayname}`
              }else{
                awayteam=`<span class="text text-danger">${data[0].awayname}</span>`
                hometeam=`${data[0].homename}`
              }
              return `${hometeam} - ${awayteam}`
            }
          },
          {
            "data":null,
            render:function(data, type, full, meta){
              var home_point=0;
              var match_id;
              for (var key in data) {
                if (data.hasOwnProperty(key)) {
                      if(data[key].betting_total_goal_status==null){
                        if(data[key].betting_team_status==0){
                          home_point+=Number(data[key].bet_amount)
                          match_id=data[key].match_id;
                        }
                      }
                }
              }
              var routeUrl="{{route('homepoints',":id")}}"
              routeUrl=routeUrl.replace(':id',match_id); 
              return `<a  href="${routeUrl}" class="badge badge-primary" style="cursor: pointer;">${thousands_separators(home_point)}</a>`;
            }
          },
          {
            "data":null,
            render:function(data, type, full, meta){
              var away_point=0;
              var match_id;
              for (var key in data) {
                if (data.hasOwnProperty(key)) {
                      if(data[key].betting_total_goal_status==null){
                        if(data[key].betting_team_status==1){
                          away_point+=Number(data[key].bet_amount)
                          match_id=data[key].match_id;
                        }
                      }
                }
              }
              var awayUrl="{{route('awaypoints',":id")}}"
              awayUrl=awayUrl.replace(':id',match_id); 
              return `<a  href="${awayUrl}" class="badge badge-primary" style="cursor: pointer;">${thousands_separators(away_point)}</a>`;
            }
          },
          {
            "data":null,
            render:function(data, type, full, meta){
              var over_point=0;
              var match_id;
              for (var key in data) {
                if (data.hasOwnProperty(key)) {
                      if(data[key].betting_total_goal_status!=null){
                        if(data[key].betting_total_goal_status==0){
                          over_point+=Number(data[key].bet_amount)
                          match_id=data[key].match_id;
                        }
                      }
                }
              }
              var overUrl="{{route('overpoints',":id")}}"
              overUrl=overUrl.replace(':id',match_id); 
              return `<a  href="${overUrl}" class="badge badge-primary" style="cursor: pointer;">${thousands_separators(over_point)}</a>`;
            }
          },
          {
            "data":null,
            render:function(data, type, full, meta){
              var under_point=0;
              var match_id;
              for (var key in data) {
                if (data.hasOwnProperty(key)) {
                      if(data[key].betting_total_goal_status!=null){
                        if(data[key].betting_total_goal_status==1){
                          under_point+=Number(data[key].bet_amount)
                          match_id=data[key].match_id;
                        }
                      }
                }
              }
              var underUrl="{{route('underpoints',":id")}}"
              underUrl=underUrl.replace(':id',match_id); 
              return `<a  href="${underUrl}" class="badge badge-primary" style="cursor: pointer;">${thousands_separators(under_point)}</a>`;
            }
          },
       ],
       "info":false
     });
    }

    function move(){

        var pos=50;

        var id=setInterval(frame,1000);

        function frame(){
          if(pos<=0){
            clearInterval(id)
            showdata();
            move();
          } 
          pos--;
        }
      }

    function thousands_separators(num){
      var num_parts = num.toString().split(".");
      num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return num_parts.join(".");
    }
  })
</script>
@endsection