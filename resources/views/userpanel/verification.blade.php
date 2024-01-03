<!DOCTYPE html>
<html lang="en">
   <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        @if(Session()->get('applocale')=='ta')

        <meta name="description" content="நீங்கள் தற்போது தொழில் திணைக்களத்தின் முறைப்பாட்டு முகாமைத்துவக் கட்டகத்தை அணுகியுள்ளீர்கள். நீங்கள் தனியார்துறை அல்லது பகுதியளவான அரசதுறை ஊழியராகவிருந்து / தொழிற்சங்கத்தின் பிரதிநிதிநிதியாகவிருந்து தங்களுக்கு தொழில் அல்லது சேவை தொடர்பான பிரச்சினைகள் காணப்படின், அவ்விடயங்களை இங்கே பதிவிடவும்." />
        <meta name="keywords" content="நீங்கள் தற்போது தொழில் திணைக்களத்தின் முறைப்பாட்டு முகாமைத்துவக் கட்டகத்தை அணுகியுள்ளீர்கள். நீங்கள் தனியார்துறை அல்லது பகுதியளவான அரசதுறை ஊழியராகவிருந்து / தொழிற்சங்கத்தின் பிரதிநிதிநிதியாகவிருந்து தங்களுக்கு தொழில் அல்லது சேவை தொடர்பான பிரச்சினைகள் காணப்படின், அவ்விடயங்களை இங்கே பதிவிடவும்.">

        @elseif (Session()->get('applocale')=='si')

        <meta name="description" content="ඔබ මේ පිවිස සිටින්නේ කම්කරු දෙපාර්තමේන්තුවේ පැමිණිලි කළමනාකරණ පද්ධතිය වෙතටයි. පෞද්ගලික / අර්ධ රාජ්‍ය අංශයේ සේවකයෙකු / සේවකයින් / ඔවුන් වෙනුවෙන් පෙනී සිටින වෘත්තීය සමිතියක්, ඔබගේ රැකියාව හෝ සේවය සම්බන්ධ යම් පැමිණිල්ලක් / ගැටලුවක් ඉදිරිපත් කිරීමට ඇත්නම් එම තොරතුරු මෙම පද්ධතිය වෙත ඇතුලත් කරන්න." />
        <meta name="keywords" content="ඔබ මේ පිවිස සිටින්නේ කම්කරු දෙපාර්තමේන්තුවේ පැමිණිලි කළමනාකරණ පද්ධතිය වෙතටයි. පෞද්ගලික / අර්ධ රාජ්‍ය අංශයේ සේවකයෙකු / සේවකයින් / ඔවුන් වෙනුවෙන් පෙනී සිටින වෘත්තීය සමිතියක්, ඔබගේ රැකියාව හෝ සේවය සම්බන්ධ යම් පැමිණිල්ලක් / ගැටලුවක් ඉදිරිපත් කිරීමට ඇත්නම් එම තොරතුරු මෙම පද්ධතිය වෙත ඇතුලත් කරන්න.">

        @else

        <meta name="description" content="You are now accessing the Department of Labour Complaints Management System. If a private / Semi-Government sector employee / Employees / union representing them has a complaint / problem regarding your job or service, enter that information into this system." />
        <meta name="keywords" content="You are now accessing the Department of Labour Complaints Management System. If a private / Semi-Government sector employee / Employees / union representing them has a complaint / problem regarding your job or service, enter that information into this system.">

        @endif

        <meta property="og:url" content="https://cms.labourdept.gov.lk/" />
        <meta property="og:type" content="website" />
        <meta name="og:tag" content="cms.labourdept.gov.lk"/>

        @if(Session()->get('applocale')=='ta')

        <meta property="og:title" content="தொழில் திணைக்களம்" />
        <meta name="og:description" content="நீங்கள் தற்போது தொழில் திணைக்களத்தின் முறைப்பாட்டு முகாமைத்துவக் கட்டகத்தை அணுகியுள்ளீர்கள். நீங்கள் தனியார்துறை அல்லது பகுதியளவான அரசதுறை ஊழியராகவிருந்து / தொழிற்சங்கத்தின் பிரதிநிதிநிதியாகவிருந்து தங்களுக்கு தொழில் அல்லது சேவை தொடர்பான பிரச்சினைகள் காணப்படின், அவ்விடயங்களை இங்கே பதிவிடவும்.">

        @elseif (Session()->get('applocale')=='si')

        <meta property="og:title" content="කම්කරු දෙපාර්තමේන්තුව" />
        <meta name="og:description" content="ඔබ මේ පිවිස සිටින්නේ කම්කරු දෙපාර්තමේන්තුවේ පැමිණිලි කළමනාකරණ පද්ධතිය වෙතටයි. පෞද්ගලික / අර්ධ රාජ්‍ය අංශයේ සේවකයෙකු / සේවකයින් / ඔවුන් වෙනුවෙන් පෙනී සිටින වෘත්තීය සමිතියක්, ඔබගේ රැකියාව හෝ සේවය සම්බන්ධ යම් පැමිණිල්ලක් / ගැටලුවක් ඉදිරිපත් කිරීමට ඇත්නම් එම තොරතුරු මෙම පද්ධතිය වෙත ඇතුලත් කරන්න.">

        @else

        <meta property="og:title" content="Department of Labour" />
        <meta property="og:description" content="You are now accessing the Department of Labour Complaints Management System. If a private / Semi-Government sector employee / Employees / union representing them has a complaint / problem regarding your job or service, enter that information into this system." />

        @endif

        <meta property="og:image" content="{{ asset('public/css/userpanel/img/labor_og.jpg') }}" />
        <meta name="og:site_name" content="Department of Labour"/>
        <meta name="og:email" content="contacts@labourdept.gov.lk"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Department of Labour</title>
        <!--favicon-->
        <link rel="icon" href="{{ asset('public/back/img/favicon/favicon1.png') }}" type="image/x-icon" />
        <!--favicon-->
        <!-- Bootstrap -->
        <link href="{{ asset('public/css/userpanel/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Bootstrap -->
        <!-- Custom CSS -->
        <link href="{{ asset('public/css/userpanel/full-slider.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        @if(Session()->get('applocale')=='ta')
            <!--main css-->
            <link href="{{ asset('public/css/userpanel/labour_dep_tamil.css') }}" rel="stylesheet" type="text/css" media="screen">
            <!--main css-->
            <!--media query css-->
            <link href="{{ asset('public/css/userpanel/mediaquery_tamil.css') }}" rel="stylesheet" type="text/css" media="screen">
            <!--media query css-->
        @elseif (Session()->get('applocale')=='si')
            <!--main css-->
            <link href="{{ asset('public/css/userpanel/laybour_dep.css') }}" rel="stylesheet" type="text/css" media="screen">
            <!--main css-->
            <!--media query css-->
            <link href="{{ asset('public/css/userpanel/mediaquery_sinhala.css') }}" rel="stylesheet" type="text/css" media="screen">
            <!--media query css-->
        @else
            <!--main css-->
            <link href="{{ asset('public/css/userpanel/laybour_dep.css') }}" rel="stylesheet" type="text/css" media="screen">
            <!--main css-->
            <!--media query css-->
            <link href="{{ asset('public/css/userpanel/mediaquery.css') }}" rel="stylesheet" type="text/css" media="screen">
            <!--media query css-->
        @endif
        <!--Date Picker-->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/userpanel/datepicker/bootstrap-datepicker3.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/userpanel/datepicker/bootstrap-datepicker3.standalone.min.css') }}" />
        <!--Date Picker end-->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <!--scroll bar style-->
        <style>
            ::-webkit-scrollbar {
            width: 1px;
            }
            ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 0px #000000;
            border-radius: 0px;
            }
            ::-webkit-scrollbar-thumb {
            border-radius: 0px;
            background-color: #000000;
            -webkit-box-shadow: inset 0 0 1px #000000;
            }
            .panel-heading a:before {
                display:none;

            }
            h2{
                margin-top: 0px;
                font-size: 20px;
                font-weight: 900;
            }
        </style>
        <!--scroll bar style-->
    </head>
    <body id="home">
      <!--=============================================-->
      <!--===================header====================-->
        <div class="row margin_auto header_row">
            <div class="container main_con no_padding">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 logo_col no_padding">
                <!--<div class="logo_col">-->
                <!--   <img src="{{ asset('public/back/img/logo1.png') }}" alt="" class="logo">-->
                <!--   <p class="logo_text_e">Department Labour</p>-->
                <!--   <p class="logo_text_s">කම්කරු දෙපාර්තමේන්තුව</p>-->
                <!--   <p class="logo_text_t">தொழில் திணைக்களம்</p>-->
                <!--</div>-->
                <!--<img src="{{ asset('public/back/img/l_logo1.png') }}" alt="" class="l_logo">-->
                <img src="{{ asset('public/css/userpanel/img/labor_logo.svg') }}" alt="" class="img-responsive labor_logo">
                </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no_padding hidden-xs">
                <p class="lang_p" style="text-align: right; margin-top: 15px;">
                    <a href=""><span class="lan_text_e">{{ Config::get('languages')[App::getLocale()] }}</span></a>
                        @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                        <a href="{{ route('lang.switch', $lang) }}"><span class="lan_text_s">{{$language}}</span></a>
                        @endif
                        @endforeach

                    {{-- <a href=""><span class="lan_text_s">සිංහල</span></a>
                    <a href=""><span class="lan_text_t">தமிழ்</span></a> --}}
               </p>
               <div class="clearfix"></div>
                <div class="row margin_auto" style="text-align: right;">
                 <button type="button" class="btn btn-default save_btn sub_btn font_size_up" style="margin-top: 5px; margin-bottom: 10px; padding: 5px 10px;">A+</button>
                 <button type="button" class="btn btn-default save_btn sub_btn font_size_down" style="margin-top: 5px; margin-bottom: 10px; padding: 5px 10px;">A-</button>
               </div>
            </div>
         </div>
      </div>
      <!--=============================================-->
      <!--===================header====================-->
      <div class="row margin_auto bg_row">
        <div class="container no_padding">
            <h4>{{ __('complainttracking.page') }}</h4>
            <h1>{{ __('complainttracking.title') }}</h1>
        </div>
     </div>
      <!--=============================================-->
      <!--===================body====================-->
      <br>
      <div class="row margin_auto">
        <!-- mobile view -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 visible-xs">
             <p class="lang_p" style="text-align: right; margin-top: 15px;">
             <a href=""><span class="lan_text_e">{{ Config::get('languages')[App::getLocale()] }}</span></a>
                    @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                    <a href="{{ route('lang.switch', $lang) }}"><span class="lan_text_s">{{$language}}</span></a>
                    @endif
                    @endforeach

                    {{-- <a href=""><span class="lan_text_s">සිංහල</span></a>
                    <a href=""><span class="lan_text_t">தமிழ்</span></a> --}}
             </p>
             <div class="clearfix"></div>
                <div class="row margin_auto" style="text-align: right;">
                 <button type="button" class="btn btn-default save_btn sub_btn font_size_up" style="margin-top: 5px; margin-bottom: 10px; padding: 5px 10px;">A+</button>
                 <button type="button" class="btn btn-default save_btn sub_btn font_size_down" style="margin-top: 5px; margin-bottom: 10px; padding: 5px 10px;">A-</button>
               </div>
          </div>
                <!-- mobile view -->
            <div class="container white_box">
                <h2>{{ __('complainttracking.otp_verification') }}</h2>
                <p>{{ __('complainttracking.verification_code_send') }} <br class="visible-xs">{{ $mobile }}</p>

            </div>
        </div>
        <section>
            <form action="{{ route('verification') }}" enctype="multipart/form-data" method="get" id="verification-form" class="smart-form">
                @csrf

                <div class="container">
                    <div class="row">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @elseif ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                {{-- @if($status != '')
                    <div class="alert alert-danger">
                        <p>{{ $status }}</p>
                    </div>
                @endif --}}

                    <div class="wrapper center-block">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading active" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button">
                                            {{ __('complainttracking.otp_code') }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no_padding">
                                            <!-- main div -->
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="row">

                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                                                    <label for="usr" style="cursor:none;">{{ __('complainttracking.complaint_number') }}</label>
                                                    <p>{{ $data[0]->external_ref_no }}</p>
                                                    </div>

                                                    <input type="hidden" name="complaint_id" id="complaint_id" value="{{ $data[0]->id }}">

                                                    <div class="clearfix"></div>
                                                    <!-- ======================== -->

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label for="usr">{{ __('complainttracking.enter_verification') }}</label>
                                                    </div>

                                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                        <div class="form-group">

                                                            <div class="row">

                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                <input style="text-align:center;" id="pin1" name="pin1" type="text" maxlength="1" size="1" class="form-control otpinput" value="">
                                                            </div>

                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                <input style="text-align:center;" id="pin2" name="pin2" type="text" maxlength="1" size="1" class="form-control otpinput" value="">
                                                            </div>

                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                <input style="text-align:center;" id="pin3" name="pin3" type="text" maxlength="1" size="1" class="form-control otpinput" value="">
                                                            </div>

                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                <input style="text-align:center;" id="pin4" name="pin4" type="text" maxlength="1" size="1" class="form-control otpinput" value="">
                                                            </div>

                                                            </div>

                                                        </div>
                                                    </div>

                                                    {{-- <input id="complaint_id" name="complaint_id" type="text" class="form-control" value="{{ $data[0]->id }}"> --}}

                                                    <div class="clearfix"></div>
                                                    <!-- ======================== -->


                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        {{-- <button type="submit" id="button1id" name="button1id" class="btn btn-default save_btn sub_btn">{{ __('complainttracking.submit') }}</button> --}}
                                                            <p style="font-weight: 600; font-size: 12px;">{{ __('complainttracking.receive_otp') }}<b style="font-family: inherit;">?</b><button type="button" id="resendotp" name="resendotp" style="color: #337ab7; border: none; background-color: transparent;">{{ __('complainttracking.resend_otp') }}</button> </p>
                                                            <p style="font-size: 12px;"></p>
                                                    </div>
                                                    {{-- &nbsp; <b><a href="">Resend OTP</a></b> --}}
                                                    </div>
                                            </div>
                                            </div>
                                            <!-- main div -->
                                            <div class="clearfix"></div>
                                            <!-- ======================== -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- =================== -->

                        </div>

                  </div>

                  @if(Session()->get('applocale')=='ta')
                  <input type="hidden" id="pref_lang" name="pref_lang" value="{{ $sellang = "TA"}}">
                  @elseif (Session()->get('applocale')=='si')
                  <input type="hidden" id="pref_lang" name="pref_lang" value="{{ $sellang = "SI"}}">
                  @else
                  <input type="hidden" id="pref_lang" name="pref_lang" value="{{ $sellang = "EN"}}">
                  @endif

                   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 no_padding otp_btns_col">
                           {{-- <a href="{{ url('complaint-tracking') }}"><button type="button" class="btn btn-default save_btn sub_btn">{{ __('complainttracking.back') }}</button></a> --}}
                            {{-- <a href="{{ url('complaint-status') }}"><button type="button" id="verify" class="btn btn-default save_btn sub_btn">VERIFY OTP</button></a> --}}
                            <button type="submit" id="button1id" name="button1id" id="verify" class="btn btn-default save_btn sub_btn">{{ __('complainttracking.verify_otp') }}</button>
                     </div>

               </div>
            </form>

         </section>



         </div>
      </div>
      <br>
      <!--=============================================-->
      <!--===================body====================-->
      <!--=============================================-->
      <!--===================footer====================-->
      <!--footer section-->
      <div class="row margin_auto footer_row">
         <div class="container no_padding">
            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <p>
                     Labour Secretariat, No 41, Kirula Road,  <br class="visible-sm visible-xs">Colombo 05, Sri Lanka.
                  </p>
                  {{-- <p>Tel.
                    <a href="tel:+94112581142" style="color: #fff">011 2581142</a> |
                    <a href="tel:+94112581143" style="color: #fff">011 112581143</a> |
                    <a href="tel:+94112581146" style="color: #fff">011 2581146</a> |
                    <a href="tel:+94112581148" style="color: #fff">011 2581148</a> |
                    <a href="tel:+94112581149" style="color: #fff">011 2581149</a>
                  </p> --}}
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <p class="f_copy_text">
                     <small>Copyright © Department of Labour. All Rights Reserved.</small><br>
                     <small style="color: #999999;">Solution by - <a href="https://www.tekgeeks.net/" target="_blank" style="color: #999999;">TekGeeks</a></small>
                  </p>
               </div>
            </div>
         </div>
      </div>
      <!--footer section-->
      <!--=============================================-->
      <!--===================footer====================-->
      <!--=============================================-->
      <!--===================scroll top====================-->
      <!--   <div class="scroll-top-wrapper">
         <span class="scroll-top-inner">

         <i class="glyphicon glyphicon-arrow-up"></i>

         </span>

           </div> -->
      <!--=============================================-->
      <!--===================scroll top====================-->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="{{ asset('public/js/userpanel/jquery.min.js') }}"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="{{ asset('public/js/userpanel/bootstrap.min.js') }}"></script>

            <!-- <script>
        $(function(){
            //window.ParsleyValidator.setLocale('ta');
            $('#search-complaint-form').parsley();
        });
    </script> -->
      <!-- Script to Activate the Carousel -->
      <script>
         $('.carousel').carousel({

             interval: 5000 //changes the speed

         })
    </script>
    <script>
      $(document).ready(function(){
         $('[data-toggle="tooltip"]').tooltip();
      });
   </script>

<script>
    setTimeout(function() {
        $('.alert-success').fadeOut('fast');
        $('.alert-danger').fadeOut('fast');
    }, 5000);

    $('#resendotp').click(function(){
        var complaintID = $('#complaint_id').val();

        console.log(complaintID);

        window.location.replace("resent-otp/" + complaintID);
    });
</script>
<script>
//     $(".otpinput").keyup(function () {
//         console.log('aaaaaaaaa');
//     if (this.value.length == this.maxLength) {
//         console.log('bbbbb');
//       var $next = $(this).next('.otpinput');
//       if ($next.length)
//           $(this).next('.otpinput').focus();
//       else
//           $(this).blur();
//     }
// });


$(".otpinput").keyup(function () {
if (this.value.length == this.maxLength) {
if(event.target.id=='pin1'){$("#pin2").focus();}
if(event.target.id=='pin2'){$("#pin3").focus();}
if(event.target.id=='pin3'){$("#pin4").focus();}
// if(event.target.id=='pin4'){$("#pin5").focus();}
// if(event.target.id=='pin5'){$("#pin6").focus();}
}
});

</script>
<!-- font sizes increase -->
<script type="text/javascript">
        $(document).ready(function(){
            function getSize() {
                size1 = $( "h1" ).css( "font-size" );
                size1 = parseInt(size1, 10);

                size2 = $( "p" ).css( "font-size" );
                size2 = parseInt(size2, 10);

                size3 = $( "button" ).css( "font-size" );
                size3 = parseInt(size3, 10);

                size4 = $( "h4" ).css( "font-size" );
                size4 = parseInt(size4, 10);

                size5 = $( ".lan_text_e" ).css( "font-size" );
                size5 = parseInt(size5, 10);

                size6 = $( ".panel-title a" ).css( "font-size" );
                size6 = parseInt(size6, 10);

                size7 = $( "label" ).css( "font-size" );
                size7 = parseInt(size7, 10);

                size8 = $( ".lan_text_s" ).css( "font-size" );
                size8 = parseInt(size8, 10);

                size9 = $( "h2" ).css( "font-size" );
                size9 = parseInt(size9, 10);
            }

            $( ".font_size_up" ).on( "click", function() {
                //get inital font size
                getSize();

                // parse font size, if less than 50 increase font size
                if ((size1 + 2) <= 48) {
                    $( "h1" ).css( "font-size", "+=2" );
                }

                if ((size2 + 2) <= 22) {
                    $( "p" ).css( "font-size", "+=2");
                }

                if ((size3 + 2) <= 14) {
                    $( "button" ).css( "font-size", "+=2");
                }

                if ((size4 + 2) <= 22) {
                    $( "h4" ).css( "font-size", "+=2");
                }

                if ((size5 + 2) <= 22) {
                    $( ".lan_text_e" ).css( "font-size", "+=2");
                }

                if ((size6 + 2) <= 24) {
                    $( ".panel-title a" ).css( "font-size", "+=2");
                }

                if ((size7 + 2) <= 16) {
                    $( "label" ).css( "font-size", "+=2");
                }

                if ((size8 + 2) <= 22) {
                    $( ".lan_text_s" ).css( "font-size", "+=2");
                }

                if ((size9 + 2) <= 22) {
                    $( "h2" ).css( "font-size", "+=2");
                }
            });

            $( ".font_size_down" ).on( "click", function() {
                //get inital font size
                getSize();

                if ((size1 - 2) >= 12) {
                    $( "h1" ).css( "font-size", "-=2" );
                }

                if ((size2 - 2) >= 12) {
                    $( "p" ).css( "font-size", "-=2" );
                }

                if ((size3 - 2) >= 12) {
                    $( "button" ).css( "font-size", "-=2" );
                }

                if ((size4 - 2) >= 12) {
                    $( "h4" ).css( "font-size", "-=2" );
                }

                if ((size5 - 2) >= 12) {
                    $( ".lan_text_e" ).css( "font-size", "-=2" );
                }

                if ((size6 - 2) >= 12) {
                    $( ".panel-title a" ).css( "font-size", "-=2" );
                }

                if ((size7 - 2) >= 12) {

                    $( "label" ).css( "font-size", "-=2" );
                }

                if ((size8 - 2) >= 12) {
                    $( ".lan_text_s" ).css( "font-size", "-=2" );
                }

                if ((size9 - 2) >= 12) {
                    $( "h2" ).css( "font-size", "-=2" );
                }
            });
        });
    </script>
   <!-- font sizes increase -->

   </body>
</html>
