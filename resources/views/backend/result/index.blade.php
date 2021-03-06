@extends('layouts.backendtemplate')
@section('title', 'Matches')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        @if(session('successMsg') != NULL)
          <div class="alert alert-success alert-dismissible fade show myalert mx-3" role="alert">
              <strong> ✅ SUCCESS!</strong>
              {{ session('successMsg') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
        @endif
        <div class="col-12">
            <div class="alert alert-primary success d-none" role="alert"></div>
        </div>
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Result List Today</h6>
            </div>
            <div class="card-body">
              
                <div class="form-row">
                  <div class="col-6">
                   <div class="form-group">
                    <input type="date" class="form-control sdate" id="exampleFormControlInput1" placeholder="EventDate">
                  </div>
                  </div>
                  <div class="col-6">
                    <a href="#" class="btn btn-info btnsearch">search</a>
                  </div>
                </div>
              
              <div class="table-responsive">
                <table class="table table-bordered dataTable">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Soccer</th>
                    <th>HomeTeam Goal</th>
                    <th>Away Team Goal</th>
                    <th>League</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="tbody">
                  @php 
                  $i=1;
                  @endphp
                  @foreach($results as $row)
                  <tr>
                    <td class="align-middle">{{$i++}}</td>
                    <td class="align-middle">{{$row->match->home_team->name}}-{{$row->match->away_team->name}}</td>
                    <td class="align-middle">{{$row->home_team_score}}</td>
                    <td class="align-middle">{{$row->away_team_score}}</td>
                    <td class="align-middle">{{$row->match->league->name}}</td>
                    <td class="align-middle">{{$row->match->event_date}}</td>
                    <td class="align-middle">
                      @if($row->match_status==1)
                      <a href="#" class="btn btn-warning btnedit" data-id="{{$row->id}}" data-match="{{$row->match->home_team->name}}-{{$row->match->away_team->name}}">Edit</a>
                      <button class="btn btn-info btn-sm gentratepoint" data-id="{{$row->id}}">generate point</button>
                      @else
                      <button class="btn btn-success btn-sm" >generate complete</button>
                      @endif
                    </td>
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

  <!-- Modal -->
  <div class="modal fade" id="editresultmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="hidden" name="" id="resultmatch">
            <div class="col-12">
              <div class="form-group">
                <label for="h_goal">Home Team goal</label>
                <span class="Ehteam error d-block" ></span>
                <input type="number" class="form-control" id="h_goal" name="h_goal">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="a_goal">Away Team goal</label>
                <span class="Eateam error d-block" ></span>
                <input type="number" class="form-control" id="a_goal" name="a_goal">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-save">Save</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function(){


    $(".tbody").on('click','.btnedit',function(){
      $('#editresultmodal').modal('show');
      var match=$(this).data('match');
      var id=$(this).data('id');
      $("#exampleModalLabel").html(match);
      $("#resultmatch").val(id);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var url="{{route('results.edit',':id')}}";
      
      url=url.replace(':id',id);
      $.get(url,function(res){
        $('#h_goal').val(res.home_team_score);
        $("#a_goal").val(res.away_team_score);
      })
    })

     $('.btn-save').click(function(){
      var id=$('#resultmatch').val();
      var h_goal=$("#h_goal").val();
      var a_goal=$("#a_goal").val();
      var url="{{route('results.update',':id')}}";
      url=url.replace(':id',id);
      $.ajax({
        url:url,
        type:'PATCH',
        data:{h_goal:h_goal,a_goal:a_goal},
        dataType:'json',
        success:function(res){
          // console.log('heloo world');
          if(res.success){
              $("#editresultmodal").modal('hide');
              $('.Ehteam').text('');
              $('span.error').removeClass('text-danger');
              $('.Eateam').text('');
              $('.success').removeClass('d-none');
              $('.success').show();
              $('.success').text('successfully updated');
              $('.success').fadeOut(4000);
              window.location.reload();
          }
          
          
        },
        error:function(error){
           var errors=error.responseJSON.errors;
            //console.log(error.responseJSON.errors);
            if(errors){
              var hteam=errors.h_goal;
              var ateam=errors.a_goal;
              $('.Ehteam').text(hteam);
              $('span.error').addClass('text-danger');
              $('.Eateam').text(ateam);
        }
      }
      })
      
      
    })

     $(".tbody").on('click','.gentratepoint',function(){
        var id=$(this).data('id');
        var url="{{route('generatepoint')}}";
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.post(url,{id:id},function(res){
          console.log(res);
          if(res=="success"){
            alert("generate points success");
            window.location.reload();
          }
        })

     })

     $(".btnsearch").click(function(){
      //alert("ok");
      var date=$(".sdate").val();
      var url="{{route('resultbydate')}}";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.post(url,{date:date},function(res){
        var html="";
        var j=1;
        $.each(res,function(i,v){
          html+=`<tr>
                    <td class="align-middle">${j++}</td>
                    <td class="align-middle">${v.match.home_team.name}-${v.match.away_team.name}</td>
                    <td class="align-middle">${v.home_team_score}</td>
                    <td class="align-middle">${v.away_team_score}</td>
                    <td class="align-middle">${v.match.league.name}</td>
                    <td class="align-middle">${v.match.event_date}</td>
                    <td class="align-middle">`
                      if(v.match_status==1){
                      html+=`<a href="#" class="btn btn-warning btnedit" data-id="${v.id}" data-match="${v.match.home_team.name}-${v.match.away_team.name}">Edit</a>
                      <button class="btn btn-info btn-sm gentratepoint" data-id="${v.id}">generate point</button>`
                      }else{
                      html+=`<button class="btn btn-success btn-sm" >generate complete</button>`
                      }
                    html+=`</td>
                  </tr>`
        })
        $(".tbody").html(html)
      })

    })

  })
  
</script>
@endsection