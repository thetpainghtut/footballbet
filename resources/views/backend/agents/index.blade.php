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
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Member List</h6>
              <a href="{{route('agents.create')}}" class="btn btn-primary float-right">Add </a>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="dataTable">
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
                    <td class="align-middle">{{$i++}}</td>
                    <td class="align-middle">{{$row->user->name}}</td>
                    <td class="align-middle">{{$row->phone_no}}</td>
                    <td class="align-middle">{{$row->points}}</td>
                    <td class="align-middle">{{$row->commission_rate}}</td>
                    <td class="align-middle">{{$row->min_point}}</td>
                    <td class="align-middle">{{$row->max_point}}</td>
                    <td class="align-middle">
                      <a href="{{route('agents.edit',$row->id)}}" class="btn btn-warning">Edit</a>
                      <form action="{{ route('agents.destroy',$row->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">

                        @csrf
                        @method('DELETE')
                      <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
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
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    //alert("ok");
    setTimeout(function(){ $('.myalert').hide(); showDiv2() },3000);

  })
  
</script>
@endsection