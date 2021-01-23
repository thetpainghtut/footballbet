@extends('layouts.backendtemplate')
@section('title', 'Leagues')
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
              <h6 class="text-uppercase mb-0 d-inline-block">Team List</h6>
              <a href="{{route('teams.create')}}" class="btn btn-primary float-right">Add </a>
            </div>
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Leagues</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach($teams as $row)
                  <tr>
                    <td scope="row" class="align-middle">{{$i++}}</td>
                    <td class="align-middle">{{$row->name}}</td>
                    <td class="align-middle">
                      @foreach($row->leagues as $league)
                        <span class="badge badge-info">{{$league->name}}</span>
                      @endforeach
                    </td>
                    <td class="align-middle">
                      <a href="{{route('teams.edit',$row->id)}}" class="btn btn-warning">Edit</a>
                      <form action="{{ route('teams.destroy',$row->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">

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