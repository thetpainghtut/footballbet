@extends('layouts.backendtemplate')
@section('title', 'Agents')
@section('content')
 <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Team Create Form</h6>
            </div>
            <div class="card-body">
              <form action="{{route('teams.store')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="team">Name:</label>
              <input class="form-control" id="team" type="text" placeholder="Enter name" name="name" value="{{ old('name') }}">
              <div class="form-control-feedback text-danger"> {{$errors->first('name') }} </div>
            </div>

            <div class="form-group">
              <label for="league">{{ __("Team Leagues")}}:</label>
              <select class="js-example-basic-multiple form-control" name="league[]" multiple="multiple" id="league">
                <option value="">{{{ __("Choose leagues")}}}</option>
                @foreach($leagues as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
                 
              </select>
              <div class="form-control-feedback text-danger"> {{$errors->first('league') }} </div>
            </div>


            <div class="form-group">
              <button class="btn btn-primary" type="submit">Save</button>
            </div>
          </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
</script>
@endsection