@extends('layouts.backendtemplate')
@section('title', 'Agents')
@section('content')
 <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Agent Edit Form</h6>
            </div>
            <div class="card-body">
              <form action="{{route('agents.update',$agent->id)}}" method="POST">
             @csrf
            @method('PUT')
            <input type="hidden" name="oldpassword" value="{{$agent->user->password}}">
            <div class="form-group">
              <label for="InputCityName">Name:</label>
              <input class="form-control" id="InputCityName" type="text" placeholder="Enter name" name="name" value="{{$agent->user->name}}">
              <div class="form-control-feedback text-danger"> {{$errors->first('name') }} </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email" value="{{$agent->user->email}}">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              <div class="form-control-feedback text-danger"> {{$errors->first('email') }} </div>
            </div>

           <div class="form-group">
              <input type="checkbox" class="mychangepsw" id="cpassw">
              <label for="cpassw">Want to change password?</label>
            </div>

            <div class="form-group psw">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter Password">
              <div class="form-control-feedback text-danger"> {{$errors->first('password') }} </div>
            </div>

            <div class="form-group cpsw">
              <label for="password-confirm">Confirm Password</label>
               <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
              
            </div>

            <div class="form-group">
              <label for="phone">Phone No:</label>
              <input class="form-control" id="phone" type="text" placeholder="Enter Phone No" name="phone" value="{{$agent->phone_no}}">
              <div class="form-control-feedback text-danger"> {{$errors->first('phone') }} </div>
            </div>

            <div class="form-group">
              <label for="address">Address:</label>
              <input class="form-control" id="address" type="text" placeholder="Enter Address" name="address" value="{{$agent->address}}">
              <div class="form-control-feedback text-danger"> {{$errors->first('address') }} </div>
            </div>

            <div class="form-group">
              <label for="point">Points:</label>
              <input class="form-control" id="point" type="number" placeholder="Enter Point" name="point" value="{{$agent->points}}">
              <div class="form-control-feedback text-danger"> {{$errors->first('point') }} </div>
            </div>

            <div class="form-group">
              <label for="rate">Commission Rate:</label>
              <input class="form-control" id="rate" type="text" placeholder="Enter Rate" name="rate" value="{{$agent->commission_rate}}">
              <div class="form-control-feedback text-danger"> {{$errors->first('rate') }} </div>
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
  $(document).ready(function(){
    $(".psw").hide();
    $(".cpsw").hide();
    $(".mychangepsw").click(function(){
      if(this.checked){
    $(".psw").show();
    $(".cpsw").show();
      }else{
      $(".psw").hide();
    $(".cpsw").hide();
      }
    })
  })
</script>
@endsection