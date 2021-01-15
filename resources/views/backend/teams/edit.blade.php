@extends('layouts.backendtemplate')
@section('title', 'Agents')
@section('content')
 <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Team Edit Form</h6>
            </div>
            <div class="card-body">
              <form action="{{route('teams.update',$team->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="team">Name:</label>
              <input class="form-control w-50" id="team" type="text" placeholder="Enter name" name="name" value="{{$team->name}}">
              <div class="form-control-feedback text-danger"> {{$errors->first('name') }} </div>
            </div>

             <div class="form-group">
              <label for="league">{{ __("Team Leagues")}}:</label>
              @php
              $v = $team->leagues;
              @endphp
              <div>
                <select class="js-example-basic-multiple form-control w-50" name="league[]" multiple="multiple" id="league">
                  <option>{{ __("Choose leagues")}}</option>
                  @foreach($leagues as $row)
                  <option value="{{$row->id}}"  @foreach($v as $key=> $value)

                    @if($row->id==$value->pivot->league_id) {{"selected"}} @endif 
                    @endforeach>{{$row->name}}</option>
                  @endforeach
                   
                </select>
              </div>
              <div class="form-control-feedback text-danger"> {{$errors->first('league') }} </div>
            </div>
           

            <div class="form-group">
              <button class="btn btn-primary" type="submit">Update</button>
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
  $(document).ready(function(){
    $('.js-example-basic-multiple').select2();
    
  })
</script>
@endsection