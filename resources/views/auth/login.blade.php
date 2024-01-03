@section('title', 'Login')
<!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Add icon library -->
<style>
     .error  {
 color: #ffffff;
}

.text-red-600{
    color: #ffffff !important;
}

</style>

<x-guest-layout>
    <!-- Scripts -->
	<script src="{{ asset('public/js/app.js') }}" defer></script>
	<script src="{{ asset('public/back/js/jquery.min.js') }}"></script>
    <div id="main" role="main">

        <!-- MAIN CONTENT -->
        <div id="content" class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm" style="padding-top: 6%;">
                    <!--<h1 class="txt-color-red login-header-big">WELCOME</h1>-->
                    <div class="hero" style="background-image: none; margin-top: 25%;">
                        
                        &nbsp;
                        
                    </div>


                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 login_form_div">

<!--                    <p class="lang_p" style="text-align: right; margin-top: 15px; position: relative; margin-bottom: 25px; padding-right: 15px;">
                        <a href="#"><span class="lan_text_e">{{ Config::get('languages')[App::getLocale()] }}</span></a>
                        @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                        <a href="{{ route('lang.switch', $lang) }}"><span class="lan_text_s">{{$language}}</span></a>
                        @endif
                        @endforeach
                    </p>-->

                    <div class="well no-padding" style="box-shadow: none; background-color: transparent;">


                        <img src="{{ asset('public/css/userpanel/img/dsi_logo_white.png') }}" alt="" class="img-responsive labor_logo center-block" style="padding-left: 15px; padding-right: 15px; margin-bottom: 15px; width:200px; ">
                        
                        <h1 style="font-weight: 900; color: #ffffff; font-size: 27px; text-align: center;">Inventory Management System</h1>

                        <!-- <div class="mx-auto logo_col no_padding">
                            <div class="logo_col">
                                <img src="https://cms.tekgeeks.net/public/back/img/logo1.png" alt="" class="logo">
                                <p class="logo_text_e">Department Labour</p>
                                <p class="logo_text_s">කම්කරු දෙපාර්තමේන්තුව</p>
                                <p class="logo_text_t">தொழில் திணைக்களம்</p>
                            </div>
                            <img src="https://cms.tekgeeks.net/public/back/img/l_logo1.png" alt="" class="l_logo">
                        </div> -->

                        <form method="POST" action="{{ route('login') }}" id="login_form" name="login_form" class="smart-form client-form">
                            @csrf
                            <header style="background-color: trnsparent; border:none; padding-bottom: 0px;">
                                <b style="color: #ffffff;"> {{ __('login.signIn') }}</b>
                            </header>
                            <!-- Email Address -->
                            <fieldset style="padding-top: 5px;">
                                <section><x-auth-validation-errors class="mb-4" :errors="$errors" /></section>
                                <section class="form-group">
                                    <x-label class="label" for="email" :value="__('login.email')" />
                                    <label class="input "> 
                                        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                                    </label>
                                </section>

                                <section class="form-group">
                                    <x-label class="label" for="password" :value="__('login.password')" />
                                    <label class="input"> 
                                    <x-input id="password"  type="password" name="password" required autocomplete="current-password" />
                                    <i class="glyphicon glyphicon-eye-open pull-right" id="togglePassword" style=" margin-top: -29px; margin-right: 15px; cursor: pointer; " onclick="show_text();"></i>  
                                    </label>
                                </section>

                            </fieldset>
                            <footer style="background-color: transparent; border:none;">
                                
                                <x-button class="btn btn-primary save_btn" style="width: 100%;display: block;">
                                    {{ __('login.login') }}
                                </x-button>
                            </footer>

                       

                            <!-- Remember Me -->
                            <!-- <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('login.rememberMe') }}</span>
                                </label>
                            </div> -->

                            <!-- <div class="flex items-center justify-end mt-4">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('login.frogotpassword') }}
                                </a>
                                @endif

                                <x-button class="ml-3">
                                    {{ __('login.login') }}
                                </x-button>
                            </div> -->
                        </form>

                    </div>



                </div>


            </div>
        </div>

    </div>
        <!-- JQUERY VALIDATE -->
	<script src="{{ asset('public/back/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>
   <script type="text/javascript">     
        
        function show_text() { 
            var input = $("#password").attr("type");
           //alert(input); 
           if (input === "password") {
               document.getElementById('password').type = 'text';

            } else {
                document.getElementById('password').type = 'password';
            }
        }
        
        $(document).ready(function(){
                    $('#login_form').validate({ 
                rules: {
            
                email: {
                 required: true,
                //ExistingEmail: true,
                 email: true,
              
                },
                password: {
                    required: true,
                    //charactercount:true,
                },
               
        },
        messages: {
            email: {
                required: "Please enter the user email address",
                email: "Please enter a valid email address",
               
            },
            password: {
                required: "Please enter the password",
            },
           
        },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
    }); 
            
            
        });

</script>
</x-guest-layout>