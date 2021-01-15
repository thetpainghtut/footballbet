@extends('layouts.backendtemplate')
@section('title', 'Agents')
@section('content')
 <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">League Create Form</h6>
            </div>
            <div class="card-body">
              <form action="{{route('leagues.store')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="league">Name:</label>
              <input class="form-control w-50" id="league" type="text" placeholder="Enter name" name="name" value="{{ old('name') }}">
              <div class="form-control-feedback text-danger"> {{$errors->first('name') }} </div>
            </div>

            <div class="form-group">
              <label for="country">Country:</label>
              <input class="form-control w-50" id="country" type="text" placeholder="Enter Country" name="country" value="{{ old('address') }}">
              <div class="form-control-feedback text-danger"> {{$errors->first('country') }} </div>
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