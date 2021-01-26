@extends('layouts.backendtemplate')
@section('title', 'Bets')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Bet List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="bettable">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Agent</th>
                    <th scope="col">Soccer</th>
                    <th scope="col">Type</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Bet</th>
                    <th scope="col">Points</th>
                  </tr>
                </thead>
                <tbody class="mytbody">
                  
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
    getdata();
    move();
    $(".mytbody").on('click','.btncancel',function(){
      var id=$(this).data('id');
      var agent_id=$(this).data('agentid');

     // console.log(id);
     var url="{{route('cancelbet')}}";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
     $.post(url,{id:id,agent_id:agent_id},function(res){
      //console.log(res);
      if(res=="success"){
        alert("cancel successfully");
        window.location.reload();
      }
     })

    })

    function getdata(){  
    console.log("minpike"); 
        var url="{{route('todaybetlistbyagent')}}";
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
          {"data":'agentname'},
          {"data":null,
          render:function(data, type, full, meta){
            if(data.odd_team_status==0){
              return`<span class="text text-danger">${data.homename}</span> - ${data.awayname}`
            }else{
              return `${data.homename} - <span class="text text-danger">${data.awayname}</span>`
            }
          }},
          {"data":null,
          render:function(data, type, full, meta){
            if(data.betting_total_goal_status==null){
                      if(data.betting_team_status==0){
                      return `Home`
                      }else{
                       return `Away`
                      }
                    }else if(data.betting_team_status==null){
                      if(data.betting_total_goal_status!=0){
                       return `Goal Under`
                      }else{
                       return `Goal Over`
                      }
                    }
          }
          },
          {
            "data":"rate"
          },
          {
          "data":null,
          render:function(data, type, full, meta){
            if(data.team_goal_different==null){
              data.team_goal_different="";
            }
            if(data.team_bet_odd==null){
              data.team_bet_odd="";
            }
            if(data.team_goal==null){
              data.team_goal="";
            }
            if(data.team_goal_bet_odd==null){
              data.team_goal_bet_odd="";
            }  
            if(data.betting_total_goal_status==null){
                return `(${data.team_goal_different}${data.team_bet_odd})`
            }else{
                return `(${data.team_goal}${data.team_goal_bet_odd})`
            }

          }
          },
          {
            "data":"bet_amount",
          }
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
            getdata();
            move();
          } 
          pos--;
        }
      }
   
  })
</script>
@endsection