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
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Match List Today</h6>
              <a href="{{route('matches.create')}}" class="btn btn-primary float-right">Add </a>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Home Team</th>
                    <th>Away Team</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>League</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php 
                  $i=1;
                  @endphp
                  @foreach($matches as $row)
                  @php 
                  $time=$row->event_time;
                  $event_time=date("h:i A",strtotime($time));
                  @endphp
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$row->home_team->name}}</td>
                    <td>{{$row->away_team->name}}</td>
                    <td>{{$row->event_date}}</td>
                    <td>{{ $event_time}}</td>
                    <td>{{$row->league->name}}</td>
                    @if(count($row->betrate)>0)
                    <td><a href="#" class="btn btn-primary btn-sm changebet" data-id="{{$row->id}}">Channge bet</a><a href="{{route('viewbet',$row->id)}}" class="btn btn-success btn-sm view mx-1">View bet</a></td>
                    
                    @else
                    <td><a href="#" class="btn btn-info btn-sm addbet" data-id="{{$row->id}}">Add bet</a></td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addbetmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Bet Rate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{route('storebet')}}">
            @csrf
          <input type="hidden" id="match_id" name="match_id">
          <div class="form-row">
            <div class="col-12">
              <h6 class="text text-dark">Noraml Bet</h6>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="normalbet">Goal different</label>
                <input type="number" class="form-control" name="normalbet" id="normalbet">
              </div>
              <div class="form-group col-md-4">
                <label for="sign">Sign</label>
                <select class="form-control" id="sign" name="sign">
                  <option value="">Choose Sign</option>
                  <option value="+">+</option>
                  <option value="-">-</option>
                  <option value="=">=</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="bet">Team bet odd</label>
                <input type="number" class="form-control" id="bet" name="bet">
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="home" value="0">
                <label class="form-check-label" for="home">Home</label>
              </div>
              </div>
              <div class="col-6">
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="away" value="1">
                <label class="form-check-label" for="away">Away</label>
              </div>
              </div> 
            </div>
          </div>
          <hr>
          <div class="form-row">

            <div class="col-12">
              <h6 class="text text-dark">Goal Over and under Bet</h6>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="overunderbet">Goal different</label>
                <input type="number" class="form-control" name="overunderbet" id="overunderbet">
              </div>
              <div class="form-group col-md-4">
                <label for="overundersign">Sign</label>
                <select class="form-control" id="overundersign" name="overundersign">
                  <option value="">Choose Sign</option>
                  <option value="+">+</option>
                  <option value="-">-</option>
                  <option value="=">=</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="obet">Team bet odd</label>
                <input type="number" class="form-control" id="obet" name="obet">
              </div>
            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="changebetmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Bet Rate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{route('storebet')}}">
            @csrf
          <input type="hidden" id="cmatch_id" name="match_id">
          <div class="form-row">
            <div class="col-12">
              <h6 class="text text-dark">Noraml Bet</h6>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="normalbet">Goal different</label>
                <input type="number" class="form-control" name="normalbet" id="cnormalbet">
              </div>
              <div class="form-group col-md-4">
                <label for="sign">Sign</label>
                <select class="form-control" id="csign" name="sign">
                  <option value="">Choose Sign</option>
                  <option value="+">+</option>
                  <option value="-">-</option>
                  <option value="=">=</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="bet">Team bet odd</label>
                <input type="number" class="form-control" id="cbet" name="bet">
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="chome" value="0">
                <label class="form-check-label" for="home">Home</label>
              </div>
              </div>
              <div class="col-6">
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="caway" value="1">
                <label class="form-check-label" for="away">Away</label>
              </div>
              </div> 
            </div>
          </div>
          <hr>
          <div class="form-row">

            <div class="col-12">
              <h6 class="text text-dark">Goal Over and under Bet</h6>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="overunderbet">Goal different</label>
                <input type="number" class="form-control" name="overunderbet" id="coverunderbet">
              </div>
              <div class="form-group col-md-4">
                <label for="overundersign">Sign</label>
                <select class="form-control" id="coverundersign" name="overundersign">
                  <option value="">Choose Sign</option>
                  <option value="+">+</option>
                  <option value="-">-</option>
                  <option value="=">=</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="obet">Team bet odd</label>
                <input type="number" class="form-control" id="cobet" name="obet">
              </div>
            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
      </form>
    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    //alert("ok");
    setTimeout(function(){ $('.myalert').hide(); showDiv2() },3000);

    $(".addbet").click(function(){
      var id=$(this).data('id');
      $("#addbetmodal").modal('show');
      $("#match_id").val(id);
    })

    $(".changebet").click(function(){
      var id=$(this).data('id');
      $("#changebetmodal").modal('show')
      var url="{{route('betbymatch')}}";

       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.post(url,{id:id},function(res){
        //console.log(res)
        var rate=res.team_bet_odd;
        var orate=res.team_goal_bet_odd;
        var arr = rate.split('');
        var arr_one=orate.split('');
        $("#csign").val(arr[0]); 
        $("#coverundersign").val(arr_one[0]); 
        arr.shift();
        arr_one.shift();

        var bet="";
        var obet="";

        arr.forEach(function(v, i) {
         bet+=v;
        });
         arr_one.forEach(function(element, index) {
         obet+=element;
        });
        $("#cmatch_id").val(res.match_id);
        $("#cnormalbet").val(res.team_goal_different);
        
        $("#cbet").val(bet);
        $("#cobet").val(obet);
        if(res.odd_team_status==0){
          $("#chome").prop("checked","checked");
        }else{
          $("#caway").prop("checked","checked");
        }
        $("#coverunderbet").val(res.team_goal);


      })
    })

  })
  
</script>
@endsection