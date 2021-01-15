@extends('layouts.backendtemplate')
@section('title', 'Agents')
@section('content')
 <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Agent Create Form</h6>
            </div>
            <div class="card-body">
              <form action="{{route('agents.store')}}" method="POST">
              @csrf
              <div class="form-group row">
                <div class="col">
                  <label for="InputCityName">Name:</label>
                  <input class="form-control" id="InputCityName" type="text" placeholder="Enter name" name="name" value="{{ old('name') }}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('name') }} </div>
                </div>

                <div class="col">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email" value="{{ old('email') }}">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  <div class="form-control-feedback text-danger"> {{$errors->first('email') }} </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter Password" >
                  <div class="form-control-feedback text-danger"> {{$errors->first('password') }} </div>
                </div>

                <div class="col">
                  <label for="password-confirm">Confirm Password</label>
                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                  <label for="phone">Phone No:</label>
                  <input class="form-control" id="phone" type="text" placeholder="Enter Phone No" name="phone" value="{{ old('phone') }}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('phone') }} </div>
                </div>

                <div class="col">
                  <label for="address">Address:</label>
                  <input class="form-control" id="address" type="text" placeholder="Enter Address" name="address" value="{{ old('address') }}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('address') }} </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                  <label for="point">Points:</label>
                  <input class="form-control" id="point" type="number" placeholder="Enter Point" name="point" value="{{ old('point') }}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('point') }} </div>
                </div>

                <div class="col">
                  <label for="rate">Commission Rate:</label>
                  <input class="form-control" id="rate" type="text" placeholder="Enter Rate" name="rate" value="{{ old('rate') }}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('rate') }} </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                  <label for="min_point">Min Points:</label>
                  <input class="form-control" id="min_point" type="number" placeholder="Enter Minimum Point" name="min_point" value="{{ old('min_point') }}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('min_point') }} </div>
                </div>

                <div class="col">
                  <label for="max_point">Max Points:</label>
                  <input class="form-control" id="max_point" type="number" placeholder="Enter Maximum Point" name="max_point" value="{{ old('max_point') }}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('max_point') }} </div>
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