@extends('layouts.backendtemplate')
@section('title', 'Agents')
@section('content')
 <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Match Create Form</h6>
            </div>
            <div class="card-body">
              <form action="{{route('matches.store')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="hteam">Home Team:</label>
              <select class="form-control" id="hteam" name="hteam">
                <option value="">Choose Home Team</option>
                @foreach($teams as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
              </select>
              <div class="form-control-feedback text-danger"> {{$errors->first('hteam') }} </div>
            </div>

            <div class="form-group">
              <label for="ateam">Away Team:</label>
              <select class="form-control" id="ateam" name="ateam">
                <option value="">Choose Away Team</option>
                @foreach($teams as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
              </select>
              <div class="form-control-feedback text-danger"> {{$errors->first('ateam') }} </div>
            </div>

            <div class="form-group">
              <label for="example-time-input">Time</label>
              <div class="col-10">
                <input class="form-control" type="time" id="example-time-input" nam="time">
              </div>
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