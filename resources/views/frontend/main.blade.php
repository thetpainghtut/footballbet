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
        <div class="alert alert-success d-none success" role="alert">

        </div>
      </div>
    </div>
    <!-- /.row -->
    <input type="hidden" name="" value="{{Auth::user()->agent->max_point}}" class="max">
    <input type="hidden" name="" value="{{Auth::user()->agent->min_point}}" class="min">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-sm table-bordered maintable">
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
          <tbody class="mytbody">

           
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
      getData();
      move();
      $(".mytbody").on('click','.pointer',function(res){
        var bet_id=$(this).data('id');
        var status=$(this).data("status");
        var goalstatus=$(this).data("goalstatus");
        var id=$(this).data("matchid");
        var league_name=$(this).data("league");
        var match=$(this).data("match");
        var min_point=$(".min").val();
        var max_point=$(".max").val();
       // console.log(goalstatus);
        var url="{{route('betbymatch')}}";
        $.ajaxSetup({
            headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
        $.post(url,{id:id},function(res){
         // console.log(res);
         if(res.team_goal_different==null){
          res.team_goal_different="";
         }
          if(bet_id==res.id){
             $('.soccer').removeClass('d-none');
            var html="";
            html+=`<li class="list-group-item active"> Soccer </li>
          <li class="list-group-item">
            <p class="text-center">${league_name}</p>
            <p class="mb-0">${match}</p>`
            if(goalstatus==null){
              html+= `<p class="mb-0">Betrate:(${res.team_goal_different}${res.team_bet_odd})</p>`
            }else{
              html+= `<p class="mb-0">Betrate:(${res.team_goal}${res.team_goal_bet_odd})</p>`
            }
            if(goalstatus==null){
              if(status==0){
                html+=`<p>Home <strong>(0.95)</strong></p>`
              }else{
                html+=`<p>AWAY <strong>(0.95)</strong></p>`
              }
            }else if(status==null){
              if(goalstatus==0){
                html+=`<p>goal over <strong>(0.95)</strong></p>`
              }else{
                html+=`<p>goal under <strong>(0.95)</strong></p>`
              }
            }
            
           html+=`<p>
              <label>US: </label>
              <input type="number" name="" class="userpoint">
            </p>
            <p class="text-center">
              <button type="button" class="btn btn-dark btn-sm process" data-id="${bet_id}" data-bstatus="${status}" data-bgoalstatus="${goalstatus}">Process</button>
              <button type="reset" class="btn btn-dark btn-sm">Cancel</button>
            </p>
          </li>
          <li class="list-group-item p-0">
            <table class="table table-sm table-bordered mb-0 betamounttable">
              <tbody>
                <tr>
                  <td>Max Payout</td>
                  <td class="payout"></td>
                </tr>
                <tr>
                  <td>Min Bet</td>
                  <td>${min_point}</td>
                </tr>
                <tr>
                  <td>Max Bet</td>
                  <td>${max_point}</td>
                </tr>
              </tbody>
            </table>
          </li>`
          $(".soccer").html(html);

          }else{
            $('.soccer').addClass('d-none');
            alert("not match with latest bet");
            window.location.reload();
          }

        })
        //console.log(id)
      })

      $(".soccer").on("change",".userpoint",function(){
        var point=Number($(this).val());
        var url="{{route('loginuser')}}";
        $.get(url,function(res){
          //console.log(res);
          var pay_out=Number(point*0.95);
          var min_point=res.min_point;
          var max_point=res.max_point;
         // if(point>max_point)
         if(point>max_point){
         alert("points are much than allow maximum points")
          $(".soccer .userpoint").val("");
          $(".soccer .userpoint").focus();
         
         }else if(point<min_point){
          alert("points are less than allow minimum points")
          $(".soccer .userpoint").val("");
          $(".soccer .userpoint").focus();

         }else{
          $(".soccer .betamounttable .payout").html(point+pay_out);
         }
          
        })
      })

      $(".soccer").on('click','.process',function(res){
        //alert("ok");
        var point=$(".soccer .userpoint").val();
        var bet_id=$(this).data("id");
        var bstatus=$(this).data("bstatus");
        var bgoalstatus=$(this).data("bgoalstatus");
        var min_point=$(".min").val();
        var max_point=$(".max").val();
        var url="{{route('matchuser')}}";

        //console.log(point);

        if(point>=min_point && point<=max_point){
        //console.log(point+" "+bstatus+" "+bgoalstatus);
        $.post(url,{bet_id:bet_id,point:point,bstatus:bstatus,bgoalstatus:bgoalstatus},function(res){
          //console.log(res);
          if(res=="success"){
            alert("successfully bet")
            window.location.reload();
          }
        })
      }else{
        alert("points are limited")
      }

      })


      $(".league").click(function(){
        //alert("ok");
        var id=$(this).data('id');
        var url="{{route('matchbyleague')}}";
        $.ajaxSetup({
            headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
        $.post(url,{id:id},function(res){
          //console.log(res);
          showData(res);
        })
      })

     /* var timeleft = 30;
      var downloadTimer = setInterval(function(){
        if(timeleft <= 0){
          clearInterval(downloadTimer);
          getData();
          // want to reload for only this part
          // var url="{{route('pagereload')}}";
          // $.get(url,function(res){
          // console.log(res);
          //   showData(res);
          // })
          
        } else {
          $(".mytbody .pagereload").html(`(${timeleft})`)
        }
        timeleft -= 1;
      }, 1000);*/

      function showData(res) {
        var html=""
        $.each(res,function(i,v){
          html+=`<tr class="table-primary">
                <td colspan="8">${v.name}
                  <span class="pagereload"></span>
                </td>
              </tr>
            `
          $.each(v.matches,function(j,k){
            var betrates=k.betrates;
            var rate=betrates.pop();
            var time=tConvert(k.event_time);
            if(rate.team_goal_different==null){
              rate.team_goal_different="";
            }
            if(rate.team_bet_odd==null){
              rate.team_bet_odd="";
            }
            if(rate.team_goal==null){
              rate.team_goal="";
            }
            if(rate.team_goal_bet_odd==null){
              rate.team_goal_bet_odd="";
            }     
            //console.log(k.betrate.odd_team_status);
            html+=`
            <tr class="text-center">
            <th scope="row">
              ${time}
              <p class="mb-0 text-danger">Live</p>
            </th>`
            if(rate.odd_team_status==0){
              //alert("ok");
            html+=`<td class="align-middle"><span class="text text-danger">${k.home_team.name}</span> - ${k.away_team.name}</td>`}
            else{
            html+=`<td class="align-middle">${k.home_team.name} - <span class="text text-danger">${k.away_team.name}</span></td>`
          }

          html+=` <td class="align-middle">(${rate.team_goal_different}${rate.team_bet_odd})</td>
          <td class="align-middle pointer">0.95</td>
            <td class="align-middle pointer">0.95</td>
            <td class="align-middle">(${rate.team_goal}${rate.team_goal_bet_odd }})</td>
            <td class="align-middle pointer">0.94</td>
            <td class="align-middle pointer">0.94</td>
          </tr>
            `
          })
        })
        $(".mytbody").html(html);
      }

      function tConvert (time) {
          time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

          if (time.length > 1) { // If time format correct
          time = time.slice (1);  // Remove full string match value
          time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
          time[0] = +time[0] % 12 || 12; // Adjust hours
          }
        return time.join (''); // return adjusted time or original string
      }


      function getData(){
        //alert("ok");
        var url="{{route('maindata')}}";
        $.get(url,function(res){
         console.log(res);
         var html="";
         $.each(res,function(i,v){
          html+=`<tr class="table-primary">
              <td colspan="8">${i}
                <span class="pagereload"></span>
              </td>
            </tr>`
            $.each(v,function(j,k){
              //console.log(k.betrates);
              var latestbetrate=k.betrates.pop();
              var time=k.event_time;
              if(latestbetrate.team_goal_different==null){
                latestbetrate.team_goal_different="";
              }
              if(latestbetrate.team_bet_odd==null){
                latestbetrate.team_bet_odd="";
              }
              if(latestbetrate.team_goal==null){
                latestbetrate.team_goal="";
              }
              if(latestbetrate.team_goal_bet_odd==null){
                latestbetrate.team_goal_bet_odd="";
              }   
             // console.log(latestbetrate);
             if(latestbetrate){
              html+=`<tr class="text-center">
                      <th scope="row">
                      ${tConvert(time)}
                      <p class="mb-0 text-danger">Live</p>
                    </th>`
              if(latestbetrate.odd_team_status==0){
                  html+=`<td class="align-middle"><span class="text text-danger">${k.home_team.name}</span> - ${k.away_team.name}</td>`
                }else{
                 html+=`<td class="align-middle">${k.home_team.name} - <span class="text text-danger">${k.away_team.name}</span></td>`
              }
              html+=`<td class="align-middle">(${latestbetrate.team_goal_different}${latestbetrate.team_bet_odd})</td>
              <td class="align-middle pointer" data-matchid="${k.id}" data-id="${latestbetrate.id}" data-status="0" data-league="${k.league.name}" data-match="${k.home_team.name} vs ${k.away_team.name}" data-goalstatus="null"><a href="#" style="text-decoration: none;color: inherit;">0.95</a></td>
              <td class="align-middle pointer" data-id="${latestbetrate.id}" data-status="1" data-matchid="${k.id}" data-league="${k.league.name}" data-match="${k.home_team.name} vs ${k.away_team.name}" data-goalstatus="null"><a href="#" style="text-decoration: none;color: inherit;">0.95</a></td>
              <td class="align-middle" >(${latestbetrate.team_goal}${latestbetrate.team_goal_bet_odd })</td>
              <td class="align-middle pointer" data-matchid="${k.id}" data-id="${latestbetrate.id}" data-goalstatus="0" data-league="${k.league.name}"data-match="${k.home_team.name} vs ${k.away_team.name}" data-status="null"><a href="#" style="text-decoration: none;color: inherit;">0.95</a></td>
              <td class="align-middle pointer"  data-matchid="${k.id}" data-id="${latestbetrate.id}" data-status="null" data-goalstatus="1" data-league="${k.league.name}" data-match="${k.home_team.name} vs ${k.away_team.name}"><a href="#" style="text-decoration: none;color: inherit;">0.95</a></td></tr>`
             }
            })
         })

         $(".mytbody").html(html);

        })
      }

      
      function move(){

        var pos=10;

        var id=setInterval(frame,1000);

        function frame(){
          if(pos<=0){
            clearInterval(id)
            getData();
            move();
          } 
          $(".mytbody .pagereload").html(`(${pos})`)
          pos--;
        }
      }

    });
  </script>
@endsection