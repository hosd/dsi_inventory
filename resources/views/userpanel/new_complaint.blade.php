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

        .parsley-errors-list {
            padding-left: 0px;
        }

        .parsley-errors-list li {
            list-style: none;
            color: red;
            font-size: 12px;
        }

        h2{
            margin-top: 0px;
            font-size: 20px;
            font-weight: 900;
        }

    </style>
    <!--scroll bar style-->
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
</head>

<body id="home">
    <!--=============================================-->
    <!--===================header====================-->
    <div class="row margin_auto header_row">
        <div class="container main_con no_padding">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 logo_col no_padding">
                <!--<div class="logo_col">-->
                <!--    <img src="{{ asset('public/back/img/logo1.png') }}" alt="" class="logo">-->
                <!--    <p class="logo_text_e">Department Labour</p>-->
                <!--    <p class="logo_text_s">කම්කරු දෙපාර්තමේන්තුව</p>-->
                <!--    <p class="logo_text_t">தொழில் திணைக்களம்</p>-->
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
            <h4>{{ __('registercomplaint.page') }}</h4>
            <h1>{{ __('registercomplaint.heading_title') }}</h1>
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
            </p>
            <div class="clearfix"></div>
                <div class="row margin_auto" style="text-align: right;">
                 <button type="button" class="btn btn-default save_btn sub_btn font_size_up" style="margin-top: 5px; margin-bottom: 10px; padding: 5px 10px;">A+</button>
                 <button type="button" class="btn btn-default save_btn sub_btn font_size_down" style="margin-top: 5px; margin-bottom: 10px; padding: 5px 10px;">A-</button>
               </div>
        </div>
        <!-- mobile view -->
        <div class="container white_box">
            <h2 >{{ __('registercomplaint.how_to_complain') }}</h2>
            <p>
            {{ __('registercomplaint.how_to_complain_des1') }}
            </p>
            <p>
            {{ __('registercomplaint.how_to_complain_des2') }}
            </p>
        </div>
    </div>

    <br>
    <!--about section-->
    <form action="{{ route('new-complaint') }}" enctype="multipart/form-data" method="post" id="new-complaint-form" class="smart-form" autocomplete="off">
        @csrf
        <section id="about" class="margin_auto">
            <div class="container">
                <div class="row">
                    <div class="wrapper center-block">
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
                        @endif
                        @if ($message = Session::get('info'))
                        <div class="alert alert-info">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading active" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            {{ __('registercomplaint.part_a') }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="row margin_auto">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <label for="sel1">{{ __('registercomplaint.comp_type_select') }}</label>
                                                <select class="form-control" id="comp_type" name="comp_type" onchange="get_form();" required>
                                                    <option value=""></option>
                                                    <option value="N">{{ __('registercomplaint.normal') }}</option>
                                                    <option value="U">{{ __('registercomplaint.union') }}</option>
                                                    <option value="A">{{ __('registercomplaint.anonymous') }}</option>
                                                </select>
                                                <div class="clearfix"></div>
                                                <br>
                                                <!-- <input type="hidden" id="ref_no" name="ref_no" value="">
                                                <input type="hidden" id="external_ref_no" name="external_ref_no" value="{{-- $new_complaint_no --}}"> -->
                                                @if(Session()->get('applocale')=='ta')
                                                <input type="hidden" id="pref_lang" name="pref_lang" value="{{ $sellang = "TA"}}">
                                                @elseif (Session()->get('applocale')=='si')
                                                <input type="hidden" id="pref_lang" name="pref_lang" value="{{ $sellang = "SI"}}">
                                                @else
                                                <input type="hidden" id="pref_lang" name="pref_lang" value="{{ $sellang = "EN"}}">
                                                @endif

                                                {{-- @if(Session()->get('applocale')=='ta')
                                                @php
                                                $tt = "TA";
                                                @endphp
                                                @elseif(Session()->get('applocale')=='si')
                                                @php
                                                $tt = "SI";
                                                @endphp
                                                @else
                                                @php
                                                $tt = "TA";
                                                @endphp
                                                @endif --}}

                                            </div>
                                            {{-- <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                            </div> --}}
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="groupcomp" style="display: none;">
                                            <br/>
                                            @if(Session()->get('applocale')=='ta')
                                            <p>முறைப்பாடானது இரண்டு அல்லது இரண்டுக்கு மேற்பட்டவர்களால் செய்யப்படவேண்டும் எனின், அவர்களுள் தலைவரின் விபரங்களை இங்கே குறிப்பிட்டு ஏனையவர்களின் விபரங்களை துணை ஆவணங்களின்கீழ் இணைப்பாகச் சேர்க்கவும்.</p>
                                            @elseif (Session()->get('applocale')=='si')
                                            <p>පැමිණිලිකරුවන් දෙදෙනෙකු හෝ ඊට වැඩි පිරිසක් විසින් පැමිණිල්ල සිදු කරන්නේනම් අදාල ප්‍රධානියාගේ තොරතුරු මෙහි සඳහන් කර අනෙකුත් පුද්ගලයින්ගේ තොරතුරු ඇමුණුමක් සේ ආධාරක ලේඛන යටතේ යොමු කරන්න.</p>
                                            @else
                                            <p>If the complaint is made by two or more complainants, mention the relevant head's information here and refer to the other persons' information as an attachment under the supporting documents.</p>
                                            @endif
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no_padding" id="union" style="display: none;">

                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="row margin_auto">
                                                        <div class="form-group">
                                                            <label for="usr">{{ __('registercomplaint.union_name') }}<span style="color: #FF0000;">*</span></label>
                                                            <input id="union_name" name="union_name" type="text" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('registercomplaint.union_address') }}<span style="color: #FF0000;">*</span></label>
                                                        <textarea class="form-control" rows="1" id="union_address" name="union_address" style="min-height: 40px;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label style="margin-bottom: 15px; font-weight: 900;">{{ __('registercomplaint.details_union_chairmen') }}</label>
                                                </div>

                                                <div class="clearfix"></div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <p>{{ __('registercomplaint.union_description') }}</p>
                                                </div>


                                                <div class="row after-add-more2  margin_auto">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="sel1">{{ __('registercomplaint.union_officer_name') }}</label>
                                                            <input type="text" class="form-control" id="union_officer_name" name="union_officer_name[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7 col-sm-10 col-xs-10">
                                                        <div class="form-group">
                                                            <label for="sel1">{{ __('registercomplaint.union_officer_address') }}</label>
                                                            <textarea class="form-control" rows="1" id="union_officer_address" name="union_officer_address[]" style="min-height: 40px;"></textarea>
                                                        </div>

                                                    </div>

                                                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                                        <button class="btn btn-info btn-sm add-more2" id="add" type="button" style="margin-top: 25px; background-color: #0055ab;"><i class="glyphicon glyphicon-plus"></i></button>
                                                    </div>
                                                </div>

                                                <div class="copy2 hide margin_auto row ">
                                                    <div class="row clearfix control-group2 margin_auto">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="sel1">{{ __('registercomplaint.union_officer_name') }}</label>
                                                                <input type="text" class="form-control" id="union_officer_name" name="union_officer_name[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-sm-10 col-xs-10">
                                                            <div class="form-group">
                                                                <label for="sel1">{{ __('registercomplaint.union_officer_address') }}</label>
                                                                <textarea class="form-control" rows="1" id="union_officer_address" name="union_officer_address[]" style="min-height: 40px;"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                                            <button class="btn btn-danger btn-sm remove" id="remove" type="button" style="margin-top: 25px;"><i class="glyphicon glyphicon-remove"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row margin_auto">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label for="sel1">{{ __('registercomplaint.attachment') }}</label>
                                                        <div class="input-group hdtutoattachment control-group lst incrementattachment" style="width: 100%;">
                                                            <input type="file" name="files[]" class="myfrm form-control">
                                                            <div class="input-group-btn">
                                                                <button class="btn btn-info btn-sm" id="addrowattachment" type="button" style="background-color: #5D98CC; height:40px; width: 102px;"><i class="glyphicon glyphicon-plus"></i> {{ __('registercomplaint.add') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--<div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">-->
                                                    <!--    <button class="btn btn-info btn-sm add-more2" id="addrow" type="button" style="margin-top: 25px; background-color: #0055ab;"><i class="glyphicon glyphicon-plus"></i></button>-->
                                                    <!--</div>-->
                                                </div>

                                                <div class="cloneattachment hide">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="hdtutoattachment control-group lst input-group" style="margin-top:10px; width: 100%;">
                                                                <input type="file" name="files[]" class="myfrm form-control">
                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-danger btn-sm" id="removerowattachment" type="button" style="margin-top: 0px; height: 40px; width: 102px;"><i class="glyphicon glyphicon-remove"></i> {{ __('registercomplaint.remove') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">-->
                                                        <!--    <button class="btn btn-danger btn-sm" id="removerow" type="button" style="margin-top: 15px;"><i class="glyphicon glyphicon-remove"></i></button>-->
                                                        <!--</div>-->
                                                    </div>
                                                </div>

                                                <!-- ====================== -->
                                            </div>
                                            <div class="clearfix"></div>
                                            <br>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no_padding">
                                                <!-- main div -->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="sel1">{{ __('registercomplaint.title') }}<span style="color: #FF0000;">*</span></label>
                                                                <select class="form-control" id="title" name="title" required>
                                                                    <option value=""> </option>
                                                                    <option value="0" hidden> </option>
                                                                    <option value="1">{{ __('registercomplaint.mr') }}</option>
                                                                    <option value="2">{{ __('registercomplaint.miss') }}</option>
                                                                    <option value="3">{{ __('registercomplaint.mrs') }}</option>
                                                                    <option value="4">{{ __('registercomplaint.rev') }}</option>
                                                                    <option value="5">{{ __('registercomplaint.dr') }}</option>
                                                                </select>
                                                                {{-- <label class="label" style="padding: 0em 0em 0em !important"><span style="color: #FF0000;">{{ __('registercomplaint.title_description') }}</span></label> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usr" id="comp_fname">{{ __('registercomplaint.complainant_f_name') }}<span style="color: #FF0000;">*</span></label>
                                                                <label for="usr" id="contact_fname">{{ __('registercomplaint.contact_fname') }}<span style="color: #FF0000;">*</span></label>
                                                                <input id="complainant_f_name" name="complainant_f_name" type="text" class="form-control" value="" required>
                                                                {{-- <label class="label" style="padding: 0em 0em 0em !important"><span style="color: #FF0000;">{{ __('registercomplaint.comfname_description') }}</span></label> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--===========================-->
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="row margin_auto">
                                                        <div class="form-group">
                                                            <label for="usr" id="comp_lname">{{ __('registercomplaint.complainant_l_name') }}<span style="color: #FF0000;">*</span></label>
                                                            <label for="usr" id="contact_lname">{{ __('registercomplaint.contact_lname') }}<span style="color: #FF0000;">*</span></label>
                                                            <input id="complainant_l_name" name="complainant_l_name" type="text" class="form-control" value="" required>
                                                            {{-- <label class="label" style="padding: 0em 0em 0em !important"><span style="color: #FF0000;">{{ __('registercomplaint.comlname_description') }}</span></label> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- main div -->
                                            <div class="clearfix"></div>
                                            <!-- ======================== -->
                                            <div class="row margin_auto">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="fullname">
                                                    <div class="row margin_auto">
                                                        <div class="form-group">
                                                            <label for="usr">{{ __('registercomplaint.complainant_full_name') }}<span style="color: #FF0000;">*</span></label>
                                                            <input id="complainant_full_name" name="complainant_full_name" type="text" class="form-control" value="" >
                                                            {{-- <label class="label" style="padding: 0em 0em 0em !important"><span style="color: #FF0000;">{{ __('registercomplaint.comfullname_description') }}</span></label> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="usr" id="comp_address">{{ __('registercomplaint.complainant_address') }}<span style="color: #FF0000;">*</span></label>
                                                        <label for="usr" id="contact_address">{{ __('registercomplaint.contact_address') }}<span style="color: #FF0000;">*</span></label>
                                                        <textarea class="form-control" rows="1" id="complainant_address" name="complainant_address" style="min-height: 40px;" required></textarea>
                                                        {{-- <label class="label" style="padding: 0em 0em 0em !important"><span style="color: #FF0000;">{{ __('registercomplaint.comaddress_description') }}</span></label> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <!-- ======================== -->
                                            <div class="row margin_auto">
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="sel1">{{ __('registercomplaint.nic_passport') }}<span style="color: #FF0000;">*</span></label>
                                                        <input type="text" class="form-control" id="complainant_identify_no" name="complainant_identify_no" maxlength="12" pattern=".{8,12}" value="" required>
                                                        {{-- <label class="label" style="padding: 0em 0em 0em !important"><span style="color: #FF0000;">{{ __('registercomplaint.comnic_description') }}</span></label> --}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group has-feedback">
                                                        <label for="sel1" class="lable_margin_top">{{ __('registercomplaint.complainant_dob') }}</label>
                                                        <input type="text" class="form-control form-control_my date" name="complainant_dob" id="complainant_dob" placeholder="YYYY-MM-DD" value="" data-dateformat='yy-mm-dd' data-parsley-type="date">
                                                        <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="usr" class="lable_margin_top mobile_no_lable_margin_top">{{ __('registercomplaint.complainant_mobile') }} <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="@if($sellang == "EN"){{ "You will get SMSs of the complaint status to this mobile number." }}@elseif($sellang == "SI"){{ "ඔබට මෙම ජංගම දුරකථන අංකයට පැමිණිලි තත්ත්වය පිළිබඳ කෙටි පණිවුඩ ලැබෙනු ඇත." }}@endif"></span></label>
                                                        <input type="text" class="form-control" id="complainant_mobile" name="complainant_mobile" value="" pattern="[0-9]{10,15}" data-parsley-type="number">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="usr" class="lable_margin_top">{{ __('registercomplaint.complainant_tel') }}</label>
                                                        <input type="text" class="form-control" id="complainant_tel" name="complainant_tel" value="" pattern="[0-9]{10,15}" data-parsley-type="number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <!-- ======================== -->
                                            <div class="row margin_auto">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="sel1">{{ __('registercomplaint.complainant_gender') }}</label>
                                                                <select class="form-control" id="complainant_gender" name="complainant_gender">
                                                                    <option value=""> </option>
                                                                    <option value="M">{{ __('registercomplaint.male') }}</option>
                                                                    <option value="F">{{ __('registercomplaint.female') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usr">{{ __('registercomplaint.nationality') }}</label>
                                                                <input type="text" class="form-control" id="nationality" name="nationality" value="@if($sellang == "SI"){{ "ශ්‍රී ලාංකික" }}@elseif($sellang == "TA"){{ "இலங்கை" }}@else{{ "Srilankan" }}@endif" @if($sellang == "EN")pattern="^[A-Za-z -]+$"@endif value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                            <label for="usr">{{ __('registercomplaint.complainant_email') }} <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="@if($sellang == "EN"){{ "You will get the status/letters of the complaint to this Email." }}@elseif($sellang == "SI"){{ "ඔබට පැමිණිල්ලේ තත්ත්වය/ලිපි මෙම විද්‍යුත් තැපෑලට ලැබෙනු ඇත." }}@endif"></span></label>
                                                                <input id="complainant_email" name="complainant_email" type="text" class="form-control" aria-describedby="emailHelp" value="" data-parsley-type="email" pattern="/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/">
                                                            </div>
                                                            {{-- <span id="email_div" class="text-danger" style="display:none;">You must enter valid email address</span> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- =================== -->
                            <!-- =================== -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            {{ __('registercomplaint.part_b') }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="row margin_auto">
                                                    <div class="form-group">
                                                           <label style="font-weight: bold;">{{ __('registercomplaint.current_employer_details') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="row margin_auto">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('registercomplaint.current_working_name') }}<span style="color: #FF0000;">*</span></label>
                                                        <input id="current_employer_name" name="current_employer_name" type="text" class="form-control" value="" required>
                                                        {{-- <label class="label" style="padding: 0em 0em 0em !important;"><span style="color: #FF0000;">{{ __('registercomplaint.empname_description') }}</span></label> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="usr">{{ __('registercomplaint.current_working_add') }}<span style="color: #FF0000;">*</span></label>
                                                    <textarea class="form-control" rows="1" id="current_employer_address" name="current_employer_address" style="min-height: 40px;" required></textarea>
                                                    {{-- <label class="label" style="padding: 0em 0em 0em !important;"><span style="color: #FF0000;">{{ __('registercomplaint.empaddress_description') }}</span></label> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('registercomplaint.current_working_tel') }}</label>
                                                        <input id="current_employer_tel" name="current_employer_tel" type="text" class="form-control" value="" data-parsley-type="integer">
                                                    </div>
                                                </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="row margin_auto">
                                                        <div class="form-group">
                                                            <label for="sel1" class="lable_margin_top">{{ __('registercomplaint.district_id') }}<span style="color: #FF0000;">*</span></label>
                                                            <select class="form-control" id="district_id" name="district_id" required>
                                                                <option value=""> </option>
                                                                @foreach ($districts as $district)
                                                                <option value="{{ $district->id }}">@if($sellang == "EN"){{ $district->district_name_en }} @elseif($sellang == "TA"){{ $district->district_name_tamil }}@elseif($sellang == "SI"){{ $district->district_name_sin }}@endif </option>
                                                                @endforeach
                                                            </select>
                                                            {{-- <label class="label" style="padding: 0em 0em 0em !important;"><span style="color: #FF0000;">{{ __('registercomplaint.district_description') }}</span></label> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <div class="row margin_auto">
                                                        <div class="form-group">
                                                            <label for="sel1" class="lable_margin_top">{{ __('registercomplaint.city_id') }}<span style="color: #FF0000;">*</span></label>
                                                            <select class="form-control" id="city_id" name="city_id" required>
                                                                <option value=""> </option>
                                                                @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">@if($sellang == "EN"){{ $city->city_name_en }} @elseif($sellang == "TA"){{ $city->city_name_tam }}@elseif($sellang == "SI"){{ $city->city_name_sin }}@endif </option>
                                                                @endforeach
                                                            </select>
                                                            {{-- <label class="label" style="padding: 0em 0em 0em !important;"><span style="color: #FF0000;">{{ __('registercomplaint.city_description') }}</span></label> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                <div class="row margin_auto">
                                                        <div class="form-group">
                                                            <label for="sel1" class="lable_margin_top">{{ __('registercomplaint.no_of_employees') }}</label>
                                                            <select class="form-control" id="worked_employees" name="worked_employees">
                                                                <option value=""> </option>
                                                                <option value="1">1-14 employees</option>
                                                                <option value="2">15-50 employees</option>
                                                                <option value="3">51-200 employees</option>
                                                                <option value="4">201-500 employees</option>
                                                                <option value="5">501-1000 employees</option>
                                                                <option value="6">1001-5000 employees</option>
                                                                <option value="7">5001-10,000 employees</option>
                                                                <option value="8">10,001+ employees</option>
                                                            </select>
                                                            {{-- <label for="usr">{{ __('registercomplaint.no_of_employees') }}</label>
                                                            <input id="worked_employees" name="worked_employees" type="text" class="form-control" value="" data-parsley-type="integer">                                                             --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="row margin_auto">
                                                    <div class="form-group">
                                                           <label style="font-weight: bold;">{{ __('registercomplaint.employer_details') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 check_box_col">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="duplicate_data" name="duplicate_data" value="1">{{ __('registercomplaint.same_as_above') }}
                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="row margin_auto">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('registercomplaint.employer_name') }}<span style="color: #FF0000;">*</span></label>
                                                        <input id="employer_name" name="employer_name" type="text" class="form-control" value="" required>
                                                        {{-- <label class="label" style="padding: 0em 0em 0em !important;"><span style="color: #FF0000;">{{ __('registercomplaint.empname_description') }}</span></label> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="usr">{{ __('registercomplaint.employer_address') }}<span style="color: #FF0000;">*</span></label>
                                                    <textarea class="form-control" rows="1" id="employer_address" name="employer_address" style="min-height: 40px;" required></textarea>
                                                    {{-- <label class="label" style="padding: 0em 0em 0em !important;"><span style="color: #FF0000;">{{ __('registercomplaint.empaddress_description') }}</span></label> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="usr">{{ __('registercomplaint.employer_tel') }}</label>
                                                    <input id="employer_tel" name="employer_tel" type="text" class="form-control" value="" data-parsley-type="integer">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="sel1" class="lable_margin_top">{{ __('registercomplaint.business_nature') }}</label>
                                                    <select class="form-control" id="business_nature" name="business_nature">
                                                        <option value=""> </option>
                                                        @foreach ($businessnatures as $businessnature)
                                                            <option value="{{ $businessnature->id }}">@if($sellang == "TA"){{ $businessnature->business_nature_ta }}@elseif($sellang == "SI"){{ $businessnature->business_nature_si }}@else{{ $businessnature->business_nature_en }}@endif</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="sel1" class="lable_margin_top" >{{ __('registercomplaint.establishment_type_id') }}</label>
                                                    <select class="form-control" id="establishment_type_id" name="establishment_type_id">
                                                        <option value=""> </option>
                                                        @foreach ($establishmenttypes as $establishmenttype)
                                                        <option value="{{ $establishmenttype->id }}">@if($sellang == "EN"){{ $establishmenttype->establishment_name_en }} @elseif($sellang == "TA"){{ $establishmenttype->establishment_name_tam }}@else{{ $establishmenttype->establishment_name_sin }}@endif </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--=======================================-->
                                        <!-- <div class="row"> -->
                                            <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.establishment_reg_no') }}</label>
                                            <input id="establishment_reg_no" name="establishment_reg_no" type="text" class="form-control"
                                                value="">
                                            </div>
                                        </div> -->
                                        <!-- </div> -->
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="row">
                                            {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="row margin_auto">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('registercomplaint.employer_no') }}</label>
                                                        <input id="employer_no" name="employer_no" type="text" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <label for="usr">{{ __('registercomplaint.ppe_no') }}</label>
                                            <input id="ppe_no" name="ppe_no" type="text" class="form-control" value="">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.employee_no') }}</label>
                                            <input id="employee_no" name="employee_no" type="text" class="form-control" value="">
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                            <div class="form-group">
                                                <label for="usr">{{ __('registercomplaint.epf_no') }}</label>
                                                <input id="epf_no" name="epf_no" type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="usr" class="lable_margin_top">{{ __('registercomplaint.employee_mem_no') }}</label>
                                            <input id="employee_mem_no" name="employee_mem_no" type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="usr" class="lable_margin_top">{{ __('registercomplaint.designation') }}</label>
                                            <input id="designation" name="designation" type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                            <div class="form-group has-feedback">
                                                <label for="sel1">{{ __('registercomplaint.join_date') }}</label>
                                                <input type="text" class="form-control form-control_my date" name="join_date" id="jointComplaintDate" placeholder="YYYY-MM-DD" value="" data-dateformat='yy-mm-dd' data-parsley-type="date">
                                                <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group has-feedback">
                                            <label for="sel1">{{ __('registercomplaint.terminate_date') }}</label>
                                            <input type="text" class="form-control form-control_my date" name="terminate_date" id="terminateComplaintDate" placeholder="YYYY-MM-DD" value="" data-dateformat='yy-mm-dd' data-parsley-type="date">
                                            <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group has-feedback">
                                            <label for="sel1">{{ __('registercomplaint.last_sal_date') }}</label>
                                            <input type="text" class="form-control form-control_my date" name="last_sal_date" id="lastsalaryDate" placeholder="YYYY-MM" value="" data-dateformat='yy-mm' >
                                            <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                            <div class="form-group">
                                                <label for="usr">{{ __('registercomplaint.basic_sal') }}</label>
                                                <input id="basic_sal" name="basic_sal" type="text" step=".01" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                            <div class="form-group">
                                                <label for="usr">{{ __('registercomplaint.allowance') }}</label>
                                                <input id="allowance" name="allowance" type="text" step="0.01" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- =================== -->
                    <!-- =================== -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    {{ __('registercomplaint.part_c') }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="sel1">{{ __('registercomplaint.complain_category_id') }}<span style="color: #FF0000;">*</span></label>
                                        @if(Session()->get('applocale')=='ta')
                                        <p>உங்கள் முறைப்பாட்டின் வகையை (ஒன்று அல்லது அதற்கு மேற்பட்டவை) இங்கே தேர்ந்தெடுக்கவும்.</p>
                                        @elseif (Session()->get('applocale')=='si')
                                        <p>ඔබගේ පැමිණිල්ලට අදාල පැමිණිලි වර්ගය (එකක් හෝ කිහිපයක්) මෙතැනින් තෝරා ගන්න.</p>
                                        @else
                                        <p>Select the type of complaint (one or more) relevant to your complaint here.</p>
                                        @endif
                                    </div>
                                    @foreach ($complaincategories as $complaincategory)
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 check_box_col">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="complain_category_id" name="complain_category_id[]" required value="{{ $complaincategory->id }}" class="complain_category_id">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                {{-- @if($complaincategory->id==4)
                                                    @if(Session()->get('applocale')=='ta')
                                                        {{ $complaincategory->category_name_ta }} <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem Ipsum!"></span>
                                                    @elseif (Session()->get('applocale')=='si')
                                                        {{ $complaincategory->category_name_si }} <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="කරුණාකර සේවය අවසන් කළ දින සිට මාස 6කට පසු කම්කරු විනිශ්චය සභාවට පැමිණිල්ලක් ඉදිරිපත් කරන්න."></span>
                                                    @else
                                                        {{ $complaincategory->category_name_en }} <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Please forward a complaint to the labour tribunal 6 months from the termination date."></span>
                                                    @endif

                                                @else --}}
                                                    @if(Session()->get('applocale')=='ta')
                                                        {{ $complaincategory->category_name_ta }}
                                                    @elseif (Session()->get('applocale')=='si')
                                                        {{ $complaincategory->category_name_si }}
                                                    @else
                                                        {{ $complaincategory->category_name_en }}
                                                    @endif
                                                {{-- @endif --}}

                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="label" style="padding: 0em 0em 0em !important;"><span style="color: #FF0000;">{{ __('registercomplaint.category_description') }}</span></label>
                                    </div> --}}
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span id="errordiv" class="text-danger" style="display:none;">You must check at least one box</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <br class="visibl-xs">
                                    <div class="row margin_auto">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label for="sel1">{{ __('registercomplaint.support_files') }}</label>
                                            <div class="input-group hdtuto control-group lst increment" style="width: 100%;">
                                                <input type="file" name="files[]" class="myfrm form-control">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-info btn-sm" id="addrow" type="button" style="background-color: #5D98CC; height:40px; width: 102px;"><i class="glyphicon glyphicon-plus"></i> {{ __('registercomplaint.add') }}</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">-->
                                        <!--    <button class="btn btn-info btn-sm add-more2" id="addrow" type="button" style="margin-top: 25px; background-color: #0055ab;"><i class="glyphicon glyphicon-plus"></i></button>-->
                                        <!--</div>-->
                                    </div>

                                    <div class="clone hide">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="hdtuto control-group lst input-group" style="margin-top:10px; width: 100%;">
                                                    <input type="file" name="files[]" class="myfrm form-control">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-danger btn-sm" id="removerow" type="button" style="margin-top: 0px; height: 40px; width: 102px;"><i class="glyphicon glyphicon-remove"></i> {{ __('registercomplaint.remove') }}</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">-->
                                            <!--    <button class="btn btn-danger btn-sm" id="removerow" type="button" style="margin-top: 15px;"><i class="glyphicon glyphicon-remove"></i></button>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="sel1">{{ __('registercomplaint.already_complaint') }}</label>
                                        <button type="button" class="btn btn-default save_btn" name="1" checked value="1" onclick="alreadyComplain('1');">{{ __('registercomplaint.yes') }}</button>
                                        <button type="button" class="btn btn-default save_btn" name="1" value="0" onclick="alreadyComplain('0');">{{ __('registercomplaint.no') }}</button>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <div id="divAlreadyComplain" style="display: none;">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row margin_auto">
                                                <div class="form-group">
                                                    <label for="usr">{{ __('registercomplaint.submitted_office') }}</label>
                                                    {{-- <select class="form-control" id="submitted_office" name="submitted_office">
                                                    <option value=""> </option>
                                                    @foreach ($labouroffices as $labouroffice)
                                                        <option value="{{ $labouroffice->id }}">{{ $labouroffice->office_name_en }} </option>
                                                    @endforeach
                                                    </select> --}}
                                                    <input type="text" class="form-control" id="submitted_office" name="submitted_office" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group has-feedback">
                                                <label for="sel1">{{ __('registercomplaint.submitted_date') }}</label>
                                                <input type="text" class="form-control form-control_my date" name="submitted_date" id="submitted_date" placeholder="YYYY-MM-DD" value="" data-dateformat='yy-mm-dd' data-parsley-type="date">
                                                <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="usr">{{ __('registercomplaint.case_no') }}</label>
                                                <input id="case_no" name="case_no" type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="usr">{{ __('registercomplaint.received_relief') }}</label>
                                                <textarea class="form-control" rows="5" id="received_relief" name="received_relief"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.complain_purpose') }}</label>
                                            <textarea class="form-control" rows="5" id="complain_purpose" name="complain_purpose"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- =================== -->
                    <!-- =================== -->
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no_padding sub_btn_col">
                <div> {!! htmlFormSnippet() !!} </div>
                @if(Session()->get('applocale')=='ta')
                    <div style="color:#F00; display:none" id="div_cpterror">* தயவுசெய்து reCAPTCHA ஐ முடிக்கவும் </div>
                @elseif(Session()->get('applocale')=='si')
                    <div style="color:#F00; display:none" id="div_cpterror">* කරුණාකර reCAPTCHA සම්පූර්ණ කරන්න </div>
                @else
                    <div style="color:#F00; display:none" id="div_cpterror">* Please Complete reCAPTCHA </div>
                @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no_padding sub_btn_col">
                    <p id="error-msg" style="color: red; display:none;"> {{ __('registercomplaint.mark_fields') }} </p>
                    <br>
                    <a href="{{ url('/') }}"><button type="button" class="btn btn-default save_btn sub_btn">{{ __('registercomplaint.back') }}</button></a>
                    <button type="button" id="button1id" name="button1id" class="btn btn-default save_btn sub_btn">{{ __('registercomplaint.submit_form') }}</button>
                </div>
            </div>
            </div>
        </section>
    </form>
    <!--about section-->
    <br>
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
                        Labour Secretariat, No 41, Kirula Road, <br class="visible-sm visible-xs">Colombo 05, Sri Lanka.
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if(Session()->get('applocale')=='ta')
    <script src="{{ asset('public/back/js/i18n/ta.js') }}"></script>
    @endif
    @if(Session()->get('applocale')=='si')
    <script src="{{ asset('public/back/js/i18n/si.js') }}"></script>
    @endif
    <!-- Script to Activate the Carousel -->
    <script>
        $('.carousel').carousel({

            interval: 5000 //changes the speed

        })
       // $('#new-complaint-form').parsley();

        // $(function() {
        //     $("#error-msg").hide();
        //     $('#new-complaint-form').parsley().on('form:error', function(formInstance) {
        //        $("#error-msg").show();
        //     });
        // });
    </script>

    <script>

        // function numberWithCommas(x) {
        // setTimeout(function(){
        //     if(x.value.lastIndexOf(".")!=x.value.length-1){
        //     var a = x.value.replace(",","");
        //     var nf = new Intl.NumberFormat();
        //     // console.log(nf.format(a));
        //     x.value = nf.format(a);
        //     }
        // },1);
        // }

        var myinput = document.getElementById('allowance');

            myinput.addEventListener('keyup', function() {
            var val = this.value;
            val = val.replace(/[^0-9\.]/g,'');

            if(val != "") {
                valArr = val.split('.');
                valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
                val = valArr.join('.');
            }

            this.value = val;
        });

        var myinput = document.getElementById('basic_sal');

            myinput.addEventListener('keyup', function() {
            var val = this.value;
            val = val.replace(/[^0-9\.]/g,'');

            if(val != "") {
                valArr = val.split('.');
                valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
                val = valArr.join('.');
            }

            this.value = val;
        });

    </script>

    <script>
        $("#duplicate_data").change(function() {
            if(this.checked) {
                var employerName = $('#current_employer_name').val();
                var employerAddress = $('#current_employer_address').val();
                var employerContactNo = $('#current_employer_tel').val();

                $('#employer_name').val(employerName).attr('readonly',true);
                $('#employer_address').val(employerAddress).attr('readonly',true);
                $('#employer_tel').val(employerContactNo).attr('readonly',true);
            } else {
                $('#employer_name').val('').attr('readonly',false);
                $('#employer_address').val('').attr('readonly',false);
                $('#employer_tel').val('').attr('readonly',false);
            }
        });
    </script>

    <!-- scroll top -->
    <script src="{{ asset('public/js/userpanel/scroll-top.js') }}"></script>
    <!-- scroll top -->


    <script type="text/javascript">
        $('#comp_type').on('change', function() {
            var complaintype = $(this).val();

            if (complaintype == "A") {
                $('#title').attr('readonly', 'readonly').val('0');
                $('#complainant_f_name').attr('readonly', 'readonly').val('Anonoumous');
                $('#complainant_l_name').attr('readonly', 'readonly').val('Complaint');
                $('#complainant_full_name').attr('readonly', 'readonly').val('Anonoumous');
                $('#complainant_address').attr('readonly', 'readonly').val('N/A');
                $('#complainant_identify_no').attr('readonly', 'readonly').val('N/A         ');
                $('#complainant_dob').attr('readonly', 'readonly');
                $('#complainant_mobile').attr('readonly', 'readonly').val('');
                $('#complainant_tel').attr('readonly', 'readonly').val('');
                $('#complainant_gender').attr('readonly', 'readonly').val('');
                $('#nationality').attr('readonly', 'readonly');
                $('#complainant_email').attr('readonly', 'readonly').val('');;
            } else {
                $('#title').removeAttr('readonly');
                $('#complainant_f_name').removeAttr('readonly').val('');
                $('#complainant_l_name').removeAttr('readonly').val('');
                $('#complainant_full_name').removeAttr('readonly').val('');
                $('#complainant_address').removeAttr('readonly').val('');
                $('#complainant_identify_no').removeAttr('readonly').val('');
                $('#complainant_dob').removeAttr('readonly');
                $('#complainant_mobile').removeAttr('readonly');
                $('#complainant_tel').removeAttr('readonly');
                $('#complainant_gender').removeAttr('readonly');
                $('#nationality').removeAttr('readonly');
                $('#complainant_email').removeAttr('readonly');
            }
        });
    </script>


    <!--smooth scroll-->
    <script>

        $(document).ready(function(){

                $("#contact_fname").hide();
                $("#contact_lname").hide();
                $("#contact_address").hide();

        });

        function get_form() {

            //alert(value);
            var value = $('#comp_type').val();
            if (value == "U") {

                $("#union").show();
                $("#fullname").hide();
                $("#complainant_full_name").val('');
                $("#complainant_full_name").attr("required", false);
                $("#union_name").attr("required", true);
                $("#union_address").attr("required", true);
                $("#contact_fname").show();
                $("#contact_lname").show();
                $("#contact_address").show();
                $("#comp_fname").hide();
                $("#comp_lname").hide();
                $("#comp_address").hide();

            } else {

                $("#union").hide();
                $("#fullname").show();
                $("#complainant_full_name").attr("required", true);
                $("#union_name").attr("required", false);
                $("#union_address").attr("required", false);
                $("#contact_fname").hide();
                $("#contact_lname").hide();
                $("#contact_address").hide();
                $("#comp_fname").show();
                $("#comp_lname").show();
                $("#comp_address").show();

            }

            if(value == "N") {
                $('#groupcomp').show();
            } else {
                $('#groupcomp').hide();
            }

        }

        $(document).ready(function () {

            $('#union_address').blur(function () {
                    var unionAddress = $(this).val();
                    var unionName = $('#union_name').val();

                    $('#complainant_f_name').val(unionName);
                    $('#complainant_address').val(unionAddress);
            });

        });

        function alreadyComplain(value) {

            //alert(value);

            if (value == "1") {

                $("#divAlreadyComplain").show();

            } else {

                $("#divAlreadyComplain").hide();

            }

        }
    </script>
    <!--smooth scroll-->
    <!-- accordion -->
    <script>
        $('.panel-collapse').on('show.bs.collapse', function() {

            $(this).siblings('.panel-heading').addClass('active');

        });



        $('.panel-collapse').on('hide.bs.collapse', function() {

            $(this).siblings('.panel-heading').removeClass('active');

        });
    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
    {{-- <script src="easy-number-separator.js"></script> --}}
    <!-- accordion -->
    <!-- date picker -->
    <script type="text/javascript" src="{{ asset('public/js/userpanel/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        // complaint lodged date

        //  $('#complainant_dob').datepicker({ format: 'yyyy-mm-yy'});

        //  $('#complainant_dob').on("changeDate", function () {

        //      $('#my_hidden_input').val(

        //          $('#complainant_dob').datepicker('getFormattedDate')

        //      );

        //  });
        $("#complainant_dob").click(function() {
            var currentDate = new Date();
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                endDate: "currentDate",
                maxDate: currentDate,
                forceParse: false,
                autoclose: true,
                // default: false
            }).datepicker("show")
        });


        //  $('#complainant_dob').datepicker({
        //      autoclose: true,

        //  });
        $('#complainant_dob').keyup(function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });

        $('#complainant_dob').on('changeDate', function() {

            $(this).datepicker('hide');

        });


        // complaint send date to NPC

        $('#dComplaintSendDate').datepicker({
            format: 'yyyy-mm-yy'
        });

        $('#dComplaintSendDate').on("changeDate", function() {

            $('#my_hidden_input').val(

                $('#dComplaintSendDate').datepicker('getFormattedDate')

            );

        });

        $('#dComplaintSendDate').datepicker({

            autoclose: true,

        });

        $('#dComplaintSendDate').on('changeDate', function() {

            $(this).datepicker('hide');

        });




        // complaint receive date to NPC

        $('#dComplaintReceiveDate').datepicker({
            format: 'yyyy-mm-yy'
        });

        $('#dComplaintReceiveDate').on("changeDate", function() {

            $('#my_hidden_input').val(

                $('#dComplaintReceiveDate').datepicker('getFormattedDate')

            );

        });

        $('#dComplaintReceiveDate').datepicker({

            autoclose: true,

        });

        $('#dComplaintReceiveDate').on('changeDate', function() {

            $(this).datepicker('hide');

        });



        // terminate date

        //  $('#terminateComplaintDate').datepicker({ format: 'yyyy-mm-yy'});

        //  $('#terminateComplaintDate').on("changeDate", function () {

        //      $('#my_hidden_input').val(

        //          $('#terminateComplaintDate').datepicker('getFormattedDate')

        //      );

        //  });

        //  $('#terminateComplaintDate').datepicker({

        //      autoclose: true,

        //  });


        // joint date

        //  $('#jointComplaintDate').datepicker({ format: 'yyyy-mm-yy'});

        //  $('#jointComplaintDate').on("changeDate", function () {

        //      $('#my_hidden_input').val(

        //          $('#jointComplaintDate').datepicker('getFormattedDate')

        //      );

        //  });

        //  $('#jointComplaintDate').datepicker({

        //      autoclose: true,

        //  });

        $("#jointComplaintDate").click(function() {
            var currentDate = new Date();
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                endDate: "currentDate",
                maxDate: currentDate,
                forceParse: false
            }).datepicker("show")
        });

        $('#jointComplaintDate').keyup(function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });

        $('#jointComplaintDate').on('changeDate', function() {

            $(this).datepicker('hide');

        });

        $("#terminateComplaintDate").click(function() {
            var currentDate = $("#jointComplaintDate").val();
            var startDate = new Date($("#jointComplaintDate").val());
            // console.log(currentDate);
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                startDate: startDate,
                endDate: 'currentDate',
                maxDate: currentDate,
                forceParse: false
            }).datepicker("show")
        });

        $('#terminateComplaintDate').on('changeDate', function() {
            $(this).datepicker('hide');
        });

        // joint date

        //  $('#lastsalaryDate').datepicker({ format: 'yyyy-mm-yy'});

        //  $('#lastsalaryDate').on("changeDate", function () {

        //      $('#lastsalaryDate').val(

        //          $('#lastsalaryDate').datepicker('getFormattedDate')

        //      );

        //  });

        //  $('#lastsalaryDate').datepicker({

        //      autoclose: true,

        //  });

        $("#lastsalaryDate").click(function() {
            var currentDate = new Date();
            $(this).datepicker({
                format: 'yyyy-mm',
                endDate: "currentDate",
                maxDate: currentDate,
                startView: "months",
                minViewMode: "months",
                forceParse: false
            }).datepicker("show")
        });

        $('#lastsalaryDate').on('changeDate', function() {

            $(this).datepicker('hide');

        });



        // submitted date

        // $('#submitted_date').datepicker({
        //     format: 'yyyy-mm-yy'
        // });

        // $('#submitted_date').on("changeDate", function() {

        //     $('#submitted_date').val(

        //         $('#submitted_date').datepicker('getFormattedDate')

        //     );

        // });

        // $('#submitted_date').datepicker({
        //     autoclose: true,
        // });

        // $('#submitted_date').on('changeDate', function() {
        //     $(this).datepicker('hide');
        // });

        $("#submitted_date").click(function() {
            var currentDate = new Date();
            $(this).datepicker({
                format: 'yyyy-mm-dd',
                endDate: "currentDate",
                maxDate: currentDate,
                forceParse: false
            }).datepicker("show")
        });

        $('#submitted_date').keyup(function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });

        $('#submitted_date').on('changeDate', function() {

            $(this).datepicker('hide');

        });

    </script>
    <!-- date picker -->

    <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more").click(function() {
                var html = $(".copy").html();
                $(".after-add-more").after(html);

            });

            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });
        });

        $(document).ready(function() {
            $(".add-more2").click(function() {
                var html = $(".copy2").html();
                $(".after-add-more2").after(html);
            });

            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group2").remove();
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#addrow").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click", "#removerow", function() {
                $(this).parents(".hdtuto").remove();
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#addrowattachment").click(function() {
                var lsthmtl = $(".cloneattachment").html();
                $(".incrementattachment").after(lsthmtl);
            });
            $("body").on("click", "#removerowattachment", function() {
                $(this).parents(".hdtutoattachment").remove();
            });
        });
    </script>

    <script type="text/javascript">
        $('#district_id').change(function() {

            var districtID = $(this).val();
            var sellang = $('#pref_lang').val();

            if (districtID) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getCityFront') }}?district_id=" + districtID,
                    success: function(res) {

                        if (res) {
                            // console.log(res);
                            $("#city_id").empty();
                            //$("#city_id").append('<option>Select City</option>');
                            $("#city_id").append('<option></option>');
                            $.each(res, function(key, value) {
                                // console.log(res);
                                if(sellang == "SI") {

                                    $("#city_id").append('<option value="' + value['id'] + '">' + value['city_name_sin'] +
                                    '</option>');

                                } else if(sellang == "TA") {

                                    $("#city_id").append('<option value="' + value['id'] + '">' + value['city_name_tam'] +
                                    '</option>');

                                } else {

                                    $("#city_id").append('<option value="' + value['id'] + '">' + value['city_name_en'] +
                                    '</option>');
                                }
                            });

                        } else {

                            $("#city_id").empty();
                        }
                    }
                });
            } else {

                $("#city_id").empty();
            }
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('#new-complaint-form').submit(function() {

                var email = $("#complainant_email").val();
                var testEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,6})+$/;
                if (testEmail.test(email)) {
                $("#email_div").css('display', 'none');
                } else {
                $("#email_div").css('display', 'block');
                }

                var $fields = $(this).find('input[name="complain_category_id[]"]:checked');
                console.log($fields.length);
                if (!$fields.length) {
                    $('#errordiv').css('display','block');
                    return false;
                } else {
                    $('#errordiv').css('display','none');
                    return true;
                }
            });
        });
    </script> --}}

    <script>
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
            $('.alert-danger').fadeOut('fast');
        }, 5000);
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#btn1').click(function() {
                $('input').attr('disabled', 'disabled');
            });
            $('#btn2').click(function() {
                $('input').removeAttr('disabled');
            });
        });
    </script>
    <script>
      $(document).ready(function(){
         $('[data-toggle="tooltip"]').tooltip();
      });

        // $(document).ready(function () {

        //     $("#new-complaint-form").submit(function (e) {

        //         $("#button1id").attr("disabled", true);

        //         return true;

        //     });
        // });
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

                size10 = $( ".btn-sm" ).css( "font-size" );
                size10 = parseInt(size10, 10);
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

                if ((size10 + 2) <= 12) {
                    $( ".btn-sm" ).css( "font-size", "+=2");
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

                if ((size10 - 2) >= 12) {
                    $( ".btn-sm" ).css( "font-size", "-=2");
                }
            });
        });
    </script>
   <!-- font sizes increase -->
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   @if(Session()->get('applocale')=='ta')
    <script>
        $('#city_id').change(function(event) {
            var id = $(this).val();
            //console.log(id);
            if(id != '' && id != null){
                event.preventDefault();
                var name = $('#city_id>option:selected').text();
                swal({
                    title: 'Important',
                    text: 'Please note that the complaint will be forwarded to the relevant District Labour Office depending on the city you entered. Therefore, by entering the relevant city correctly, unnecessary delays can be avoided.',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value == true) {
                        $("#city_id").val(id);
                    } else {
                        $("#city_id").val("");
                    }
                });
            }

        });
    </script>
    @elseif(Session()->get('applocale')=='si')
    <script>
        $('#city_id').change(function(event) {
            var id = $(this).val();
            //console.log(id);
            if(id != '' && id != null){
                event.preventDefault();
                var name = $('#city_id>option:selected').text();
                swal({
                    title: 'වැදගත්',
                    text: 'ඔබ ඇතුලත් කල නගරයට අනුව අදාල දිස්ත්‍රික් කම්කරු කාර්යාලය වෙත පැමිණිල්ල යොමු වීම සිදු වන බව කාරුණිකව සලකන්න. එබැවින් අදාල නගරය නිවැරදිව ඇතුලත් කිරීම මඟින් අනවශ්‍ය ප්‍රමාද දෝෂ වලක්වා ගත හැකිය.',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value == true) {
                        $("#city_id").val(id);
                    } else {
                        $("#city_id").val("");
                    }
                });
            }

        });
    </script>
    @else
    <script>
        $('#city_id').change(function(event) {
            var id = $(this).val();
            //console.log(id);
            if(id != '' && id != null){
                event.preventDefault();
                var name = $('#city_id>option:selected').text();
                swal({
                    title: 'Important',
                    text: 'Please note that the complaint will be forwarded to the relevant District Labour Office depending on the city you entered. Therefore, by entering the relevant city correctly, unnecessary delays can be avoided.',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value == true) {
                        $("#city_id").val(id);
                    } else {
                        $("#city_id").val("");
                    }
                });
            }

        });

    </script>
    @endif

    <script>
        $(document).ready(function(){
            $("#button1id").click(function(){
                var error;

                $("#error-msg").hide();
                $('#new-complaint-form').parsley().on('form:error', function(formInstance) {
                    $("#error-msg").show();
                    error = true;
                });

                var googleResponse = document.getElementById('g-recaptcha-response').value;
                if (googleResponse == '')
                {
                    error = true;
                    document.getElementById('div_cpterror').style.display = "block";
                    // console.log(error);
                }
                else
                {
                    document.getElementById('div_cpterror').style.display = "none";
                }

                if(error != true){
                    $("#new-complaint-form").submit();

                    $("#new-complaint-form").submit(function (e) {

                        $("#button1id").attr("disabled", true);

                        return true;

                    });
                }
            });
        });
    </script>

        {{-- complain_category_id --}}
        {{-- @if(Session()->get('applocale')=='ta') --}}
    <script>

        $(document).ready(function(){
            var preflang = $('#pref_lang').val();

            if(preflang == "TA") {
                $('.complain_category_id').click(function() {
                    if ($(":checkbox[value=4]").is(":checked") == true) {
                        var catID = $(this).val();
                        if(catID == 4)
                        {
                            event.preventDefault();
                            var name = $('.complain_category_id>option:checked').text();
                            swal({
                            title: 'Important',
                            text: 'Please forward a complaint to the labour tribunal 6 months from the termination date.',
                            icon: 'warning',
                            buttons: ["Cancel", "Yes!"],
                        }).then(function(value) {

                            if (value == true) {
                                $(":checkbox[value=4]").prop("checked","true");
                            } else {
                                // $(":checkbox[value=4]").prop("checked","false");
                            }
                        });
                        } else {
                            // alert('test');
                        }

                    } else if ($(".complain_category_id").is(":checked") == false) {
                        $(":checkbox[value=4]").prop("unchecked","false");
                    }
                });
            } else if(preflang == "SI") {
                $('.complain_category_id').click(function() {
                    if ($(":checkbox[value=4]").is(":checked") == true) {
                        var catID = $(this).val();
                        if(catID == 4)
                        {
                            event.preventDefault();
                            var name = $('.complain_category_id>option:checked').text();
                            swal({
                            title: 'Important',
                            text: 'කරුණාකර සේවය අවසන් කළ දින සිට මාස 6කට පසු කම්කරු විනිශ්චය සභාවට පැමිණිල්ලක් ඉදිරිපත් කරන්න.',
                            icon: 'warning',
                            buttons: ["Cancel", "Yes!"],
                        }).then(function(value) {
                            if (value == true) {
                                $(":checkbox[value=4]").prop("checked","true");
                            } else {
                                // $(":checkbox[value=4]").prop("checked","false");
                            }
                        });
                        } else {
                            // alert('test');
                        }

                    } else if ($(".complain_category_id").is(":checked") == false) {
                        $(":checkbox[value=4]").prop("unchecked","false");
                    }
                });
            } else {
                $('.complain_category_id').click(function() {
                    if ($(":checkbox[value=4]").is(":checked") == true) {
                        var catID = $(this).val();
                        if(catID == 4)
                        {
                            event.preventDefault();
                            var name = $('.complain_category_id>option:checked').text();
                            swal({
                            title: 'Important',
                            text: 'Please forward a complaint to the labour tribunal 6 months from the termination date.',
                            icon: 'warning',
                            buttons: ["Cancel", "Yes!"],
                        }).then(function(value) {
                            if (value == true) {
                                $(":checkbox[value=4]").prop("checked","true");
                            } else {
                                $(":checkbox[value=4]").prop("unchecked","false");
                            }
                        });
                        } else {
                            // alert('test');
                        }

                    } else if ($(".complain_category_id").is(":checked") == false) {
                        $(":checkbox[value=4]").prop("unchecked","false");
                    }
                });
            }
        });
    </script>
    {{-- @endif --}}

</body>

</html>
