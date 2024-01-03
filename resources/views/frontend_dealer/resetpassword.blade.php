<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- Bootstrap CSS -->
 <link href="{{ asset('public/dealer/css/bootstrap.min.css') }}" rel="stylesheet">

<!--main css-->
<link href="{{ asset('public/dealer/css/dsi.css') }}" rel="stylesheet" type="text/css" media="screen">
<!--main css-->

<!--media query css-->
<link href="{{ asset('public/dealer/css/mediaquery.css') }}" rel="stylesheet" type="text/css" media="screen">
<!--media query css-->

<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Add icon library -->

    <title>DSI Tyres Dealer Inventory Management System | Reset Password</title>
  </head>
  
  <body>  
    <section id="reset_pwd">
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-5 col-12">
          <div class="login_left">
            <div class="mob_login_title d-md-none d-block">
              <div class="mobile_logo pb-2"><img src="images/logo_colored.png"></div> 
              <h1 class="pb-3">DEALER INVENTORY MANAGEMENT SYSTEM</h1>
            </div>
            <div class="heading_left">
            <h1>Reset Password</h1>
            </div>
            <div>
            <form method="POST" action="{{ route('dealer-password-reset') }}" id="reset_password_form" name="reset_password_form" class="smart-form client-form mt-4">
                            @csrf
                            <input type="hidden" name="token" value="{{\Request::get('token')}}">
                <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{\Request::get('email')}}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                <div class="mb-2">
                  <label for="InputPassword" class="form-label">New Password <span style="color: red;">*</span></label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-2">
                  <label for="ConfirmPassword" class="form-label">Confirm Password <span style="color: red;">*</span></label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <button type="submit" class="btn btn-primary w-100 login_btn">RESET</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-7 login_right d-sm-block d-none">
          <div class="login_right_content">
            <img src="{{ asset('public/back/img/logo-white.png') }}">
            <h1>DEALER INVENTORY MANAGEMENT SYSTEM</h1>
            <p style="color:white;">Your inventory, simplified. Log in to your dedicated portal to streamline your<br>inventory processes, optimize orders, and enhance your business efficiency.</p>
          </div>
        </div>
      </div>
      </div>
    </section>    

    <script src="{{ asset('public/dealer/js/bootstrap.bundle.min.js') }}"></script>
  </body>
  <script src="{{ asset('public/back/js/jquery.min.js') }}"></script>  
    <script src="{{ asset('public/back/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>
    <x-slot name="script">
    <script> 
        $(document).ready(function () {
            $('#reset-form').validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    password: {
                        required: "Please enter a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    }
                }
            });
        });
    </script>
    </x-slot>
</html>