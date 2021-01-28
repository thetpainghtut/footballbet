<!DOCTYPE html>
<html>
<head>
    <title>Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Customs -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 d-none d-md-flex bg-image"></div>


            <!-- The content half -->
            <div class="col-md-6 bg-light">
                <div class="login d-flex align-items-center py-5">

                    <!-- Demo content-->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <h3 class="display-4 text-success">9 Bet!</h3>
                                <p class="text-muted mb-4">Please login for betting all football sports.</p>
                                <form method="POST" action="{{ route('login') }}" class="loginform">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                         @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="inputCode" type="password" placeholder="Code"  class="form-control border-0 shadow-sm px-4 text-primary">
                                    </div>
                                     <div class="form-group mb-3">
                                        <div style="background-color: #1c95b0;width: 100px;height: 30px;text-align: center;" class="random">
                                            <span style="font-style:italic;font-weight: bold;font-size: 20px;" class="randomnumber"></span>
                                            <input type="hidden" name="" id="hidrandom">
                                        </div>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                        <label for="customCheck1" class="custom-control-label">Remember password</label>
                                    </div>
                                    {{-- <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button> --}}
                                    <button class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm signin">Sign in</button>
                                    <div class="text-center d-flex justify-content-between mt-4"></div>
                                </form>
                            </div>
                        </div>
                    </div><!-- End -->

                </div>
            </div><!-- End -->

        </div>
    </div>
    <script src="{{ asset('backend_assets/vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript">
       $(document).ready(function(){
        randomcode();
        function randomcode(){
           var val = Math.floor(1000 + Math.random() * 9000);
            $(".randomnumber").html(val);  
            $("#hidrandom").val(val);
        }

        $(".random").click(function(){
            randomcode();
        })

        $(".signin").click(function(e){
            e.preventDefault();
            var codeno=$("#inputCode").val();
            var randomnumber=$("#hidrandom").val()
            if(codeno==randomnumber){
                //alert("ok")
                $(".loginform").submit();
            }else{
               alert("code number are not match");
            }
        })
       
       })
    </script>
</body>
</html>

