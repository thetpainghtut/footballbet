@extends('layouts.backendtemplate')
@section('title', 'Agents')
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
        <div class="col-12">
            <div class="alert alert-danger errorgenerate d-none" role="alert"></div>
        </div>
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Member List</h6>
              <a href="{{route('agents.create')}}" class="btn btn-primary float-right">Add </a>
            </div>
            <div class="card-body">
              @php
              $day=date('w');
              @endphp
              @if($day==1 || $day==4)
              <a href="#" class="btn btn-info btn-sm float-left generate my-4">Generate to starting point</a>
              @endif
              <div class="table-responsive">
              <table class="table table-bordered dataTable">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Points</th>
                    <th>Commission Rate</th>
                    <th>Min Points</th>
                    <th>Max Points</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach($agents as $row)
                  <tr>
                    <td class="align-middle">
                      <div class="animated-checkbox">
                        <label class="mb-0">
                          <input type="checkbox" name="checkout[]" value="{{$row->id}}"><span class="label-text"> </span>
                        </label>
                      </div>
                  </td>
                    <td class="align-middle">{{$row->user->name}}</td>
                    <td class="align-middle">{{$row->phone_no}}</td>
                    <td class="align-middle">{{number_format($row->points)}}</td>
                    <td class="align-middle">{{$row->commission_rate}}</td>
                    <td class="align-middle">{{number_format($row->min_point)}}</td>
                    <td class="align-middle">{{number_format($row->max_point)}}</td>
                    <td class="align-middle">
                      <a href="{{route('agents.edit',$row->id)}}" class="btn btn-warning">Edit</a>
                      <form action="{{ route('agents.destroy',$row->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">

                        @csrf
                        @method('DELETE')
                      <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                      <a href="#" class="btn btn-info btn-sm addpoint" data-id="{{$row->id}}">Add Point</a>
                      <a href="#" class="btn btn-success btn-sm sellpoint" data-id="{{$row->id}}">Sell Point</a>
                      <a href="{{route("printagentbet",$row->id)}}" class="btn btn-dark btn-sm print">Print</a>
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

{{-- sellpoint --}}
  <div class="modal fade" id="sellmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sell Points</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="hidden" name="" id="member_id">
            <div class="col-12">
              <div class="form-group">
                <label for="spoint">Sell Points</label>
                <span class="Espoint error d-block" ></span>
                <input type="number" class="form-control" id="spoint" name="spoint">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary sellbtn-save">Save</button>
        </div>
      </div>
      </form>
    </div>
  </div> 

{{-- addpoint --}}
  <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Points</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="hidden" name="" id="amember_id">
            <div class="col-12">
              <div class="form-group">
                <label for="apoint">Add Points</label>
                <span class="Eapoint error d-block" ></span>
                <input type="number" class="form-control" id="apoint" name="apoint">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary addbtn-save">Save</button>
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

    $('.generate').click(function () {
        var val = [];
        $("input[name='checkout[]']:checked").each(function(i){
          val[i] = $(this).val();
        });
        //console.log(val);
        var url="{{route('generatestartingpoint')}}";
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
          $.ajax({
          url:url,
          type:"post",
          data:{agents:val},
          dataType:'json',
          success:function(response){
            if(response.success){
              $('.success').removeClass('d-none');
              $('.success').show();
              $('.success').text('successfully generate');
              $('.success').fadeOut(3000);
              window.location.reload();      
            }
          },
          error:function(error){
            var errors=error.responseJSON.errors;
            //console.log(error.responseJSON.errors);
            if(errors){
              var erroragents=errors.agents;
              //console.log(erroragents)
              //var ateam=errors.a_goal;
              $("html, body").animate({ scrollTop: 0 }, "slow");
              $('.errorgenerate').removeClass('d-none');
              $('.errorgenerate').show();
              $('.errorgenerate').text(erroragents);
              $('.errorgenerate').fadeOut(3000);
              
            }

          }
        })
     })

    $(".sellpoint").click(function(){
      var id=$(this).data('id');
      //console.log(id);
      $("#sellmodal").modal('show');
      $("#sellmodal #member_id").val(id);
    })

    $(".addpoint").click(function(){
      var id=$(this).data('id');
      $("#addmodal").modal('show')
      $("#addmodal #amember_id").val(id);
    })

    $(".sellbtn-save").click(function(){
      //alert("ok");
      var agent_id= $("#sellmodal #member_id").val();
      var sellpoint=$("#spoint").val();
      //console.log(sellpoint,agent_id);
      var url="{{route('sellpoint')}}";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
         $.ajax({
          url:url,
          type:"post",
          data:{agent_id:agent_id,sellpoint:sellpoint},
          dataType:'json',
          success:function(response){
            if(response.success){
              $("#sellmodal").modal('hide');
               $('.Espoint').text('');
              $('span.error').removeClass('text-danger');
              $('.success').removeClass('d-none');
              $('.success').show();
              $('.success').text('successfully sell');
              $('.success').fadeOut(3000);
              window.location.reload();      
            }
          },
          error:function(error){
            var errors=error.responseJSON.errors;
            //console.log(error.responseJSON.errors);
            if(errors){
              var spoint=errors.sellpoint;
              //var ateam=errors.a_goal;
              $('.Espoint').text(spoint);
              $('span.error').addClass('text-danger');
            }

          }
          

        })
    })

    $(".addbtn-save").click(function(){
      //alert("ok");
      var agent_id= $("#addmodal #amember_id").val();
      var addpoint=$("#apoint").val();
      //console.log(sellpoint,agent_id);
      var url="{{route('addpoint')}}";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
         $.ajax({
          url:url,
          type:"post",
          data:{agent_id:agent_id,addpoint:addpoint},
          dataType:'json',
          success:function(response){
            if(response.success){
              $("#addmodal").modal('hide');
               $('.Eapoint').text('');
              $('span.error').removeClass('text-danger');
              $('.success').removeClass('d-none');
              $('.success').show();
              $('.success').text('successfully sell');
              $('.success').fadeOut(3000);
              window.location.reload();      
            }
          },
          error:function(error){
            var errors=error.responseJSON.errors;
            //console.log(error.responseJSON.errors);
            if(errors){
              var spoint=errors.addpoint;
              //var ateam=errors.a_goal;
              $('.Eapoint').text(spoint);
              $('span.error').addClass('text-danger');
            }

          }
          

        })
    })

    function thousands_separators(num){
      var num_parts = num.toString().split(".");
      num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return num_parts.join(".");
    }


  })
  
</script>
@endsection