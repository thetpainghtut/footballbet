@extends('layouts.master')
@section('title','Bet_List')
@section('content')
<div class="col-lg-9">
  <div class="row my-4">
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
              <h6 class="text-uppercase mb-0 d-inline-block">Member Profile</h6>
            </div>
            <div class="card-body">
              <form action="{{route('profileupdate',$agent->id)}}" method="POST">
               @csrf
              @method('PUT')
              <input type="hidden" name="oldpassword" value="{{$agent->user->password}}">
              <div class="form-group row">
                <div class="col">
                  <label for="InputCityName">Name:</label>
                  <input class="form-control" id="InputCityName" type="text" placeholder="Enter name" name="name" value="{{$agent->user->name}}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('name') }} </div>
                </div>

                <div class="col">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email" value="{{$agent->user->email}}">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  <div class="form-control-feedback text-danger"> {{$errors->first('email') }} </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                  <label for="phone">Phone No:</label>
                  <input class="form-control" id="phone" type="text" placeholder="Enter Phone No" name="phone" value="{{$agent->phone_no}}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('phone') }} </div>
                </div>

                <div class="col">
                  <label for="address">Address:</label>
                  <input class="form-control" id="address" type="text" placeholder="Enter Address" name="address" value="{{$agent->address}}">
                  <div class="form-control-feedback text-danger"> {{$errors->first('address') }} </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                  <label for="cpassw">{{ __("If you want to change password")}}</label>
                  <input type="checkbox" class="mychangepsw" id="cpassw">
                </div>
              </div>

              <div class="form-group row psw">         
                <div class="col">
                  <label for="exampleInputPassword1">New Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter Password" >
                  <div class="form-control-feedback text-danger"> {{$errors->first('password') }} </div>
                </div>

                <div class="col">
                  <label for="password-confirm">Confirm Password</label>
                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
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
  {{-- end row --}}

  {{-- <div class="row my-4">
    <div class="col-md-12">
      <h4>Point Rates:</h4>
    </div>
    
    
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
      </div>
    </div>

  </div> --}}
  <!-- /.row -->
</div>
<!-- /.col-lg-9 -->
@endsection
@section('script')
 <script type="text/javascript">
   $(document).ready(function(){
    setTimeout(function(){ $('.myalert').hide(); showDiv2() },3000);
    $(".psw").hide();
    $(".mychangepsw").click(function(){
      if(this.checked){
    $(".psw").show();
      }else{
      $(".psw").hide();
      }
    })
   })
 </script>
@endsection