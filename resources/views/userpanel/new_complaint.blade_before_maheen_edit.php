<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
      <!--main css-->
      <link href="{{ asset('public/css/userpanel/laybour_dep.css') }}" rel="stylesheet" type="text/css" media="screen">
      <!--main css-->
      <!--media query css-->
      <link href="{{ asset('public/css/userpanel/mediaquery.css') }}" rel="stylesheet" type="text/css" media="screen">
      <!--media query css-->
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
            </div>
            </div>
        </div>
      <!--=============================================-->
      <!--===================header====================-->
      <div class="row margin_auto bg_row">
         <div class="container no_padding">
            <h4>Deparment of Labour / Make a complaint</h4>
            <h1>Make a complaint</h1>
         </div>
      </div>
      <!--=============================================-->
      <!--===================body====================-->
      <br>
      <div class="row margin_auto">
              <!-- mobile view -->
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 visible-xs">
                   <p class="lang_p" style="text-align: right; margin-top: 15px;">
                     <a href=""><span class="lan_text_e">ENGLISH</span></a>
                     <a href=""><span class="lan_text_s">සිංහල</span></a>
                     <a href=""><span class="lan_text_t">தமிழ்</span></a>
                   </p>
                </div>
              <!-- mobile view -->
         <div class="container white_box">
            <h1 style="margin-top: 0px; font-size: 20px; font-weight: 900;">How to submit your complaint?</h1>
            <p>
               Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
               industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
               scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
               into electronic typesetting
            </p>
            <p>
               remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
               containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
               including versions of Lorem Ipsum.
            </p>
         </div>
      </div>

      <br>
      <!--about section-->
      <form action="{{ route('new-complaint') }}" enctype="multipart/form-data" method="post" id="new-complaint-form" class="smart-form">
        @csrf
        <section id="about" class="margin_auto">
            <div class="container">
                <div class="row">
                <div class="wrapper center-block">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading active" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                Part A - Your details
                                </a>
                            </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                            aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <label for="sel1">{{ __('registercomplaint.comp_type_select') }}</label>
                                            <select class="form-control" id="comp_type" name="comp_type" onchange=get_form();>
                                            <option value="N">{{ __('registercomplaint.normal') }}</option>
                                            <option value="U">{{ __('registercomplaint.union') }}</option>
                                            <option value="A">{{ __('registercomplaint.anonymous') }}</option>
                                            </select>
                                            <div class="clearfix"></div>
                                            <hr>
                                            <!-- <input type="hidden" id="ref_no" name="ref_no" value="">
                                            <input type="hidden" id="external_ref_no" name="external_ref_no" value="{{-- $new_complaint_no --}}"> -->
                                            <input type="hidden" id="pref_lang" name="pref_lang" value="EN">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no_padding">
                                            <!-- main div -->
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="sel1">{{ __('registercomplaint.title') }}*</label>
                                                        <select class="form-control" id="title" name="title" required>
                                                        <option value="" selected="" disabled=""> </option>
                                                        <option value="1">Mr</option>
                                                        <option value="2">Miss</option>
                                                        <option value="3">Mrs</option>
                                                        <option value="4">Rev</option>
                                                        <option value="5">Dr</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="usr">{{ __('registercomplaint.complainant_f_name') }}*</label>
                                                        <input id="complainant_f_name" name="complainant_f_name" type="text"
                                                        class="form-control" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        <!--===========================-->
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                            <div class="form-group">
                                                <label for="usr">{{ __('registercomplaint.complainant_l_name') }}*</label>
                                                <input id="complainant_l_name" name="complainant_l_name" type="text"
                                                    class="form-control" value="" required>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- main div -->
                                    <div class="clearfix"></div>
                                    <!-- ======================== -->
                                    <div class="row margin_auto">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                            <div class="form-group">
                                                <label for="usr">{{ __('registercomplaint.complainant_full_name') }}*</label>
                                                <input id="complainant_full_name" name="complainant_full_name" type="text"
                                                    class="form-control" value="" required>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.complainant_address') }}</label>
                                            <textarea class="form-control" rows="1" id="complainant_address"
                                                name="complainant_address" style="min-height: 40px;"></textarea>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- ======================== -->
                                    <div class="row margin_auto">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="sel1">{{ __('registercomplaint.nic_passport') }}*</label>
                                            <input type="text" class="form-control" id="complainant_identify_no" name="complainant_identify_no" maxlength="12" value="" required>
                                        </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group has-feedback">
                                            <label for="sel1">{{ __('registercomplaint.complainant_dob') }}</label>
                                            <input type="text" class="form-control form-control_my date"
                                                name="complainant_dob" id="complainant_dob" placeholder="" value="" data-dateformat='yy-mm-dd'>
                                            <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                        </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.complainant_mobile') }}*</label>
                                            <input type="text" class="form-control" id="complainant_mobile" name="complainant_mobile"
                                                value="" required>
                                        </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.complainant_tel') }}</label>
                                            <input type="text" class="form-control" id="complainant_tel" name="complainant_tel"
                                                value="">
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
                                                    <input type="text" class="form-control" id="nationality"
                                                    name="nationality" value="">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="usr">{{ __('registercomplaint.complainant_email') }}*</label>
                                                    <input id="complainant_email" name="complainant_email" type="text"
                                                    class="form-control" aria-describedby="emailHelp"
                                                    value="" required>
                                                </div>
                                                <span id="email_div" class="text-danger" style="display:none;">You must enter valid email address</span>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="union" style="display: none;">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="row margin_auto">
                                            <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.union_name') }}</label>
                                            <input id="union_name" name="union_name" type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.union_address') }}</label>
                                            <textarea class="form-control" rows="1" id="union_address"  name="union_address" style="min-height: 40px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label style="margin-bottom: 15px; font-weight: 900;">Name and address of union Chairmen, Secretary and Treasurer</label>
                                        </div>

                                        <div class="clearfix"></div>
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
                                                <textarea class="form-control" rows="1" id="union_officer_address"  name="union_officer_address[]" style="min-height: 40px;"></textarea>
                                            </div>
                                            
                                        </div>

                                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                                <button  class="btn btn-info btn-sm add-more2" id="add" type="button" style="margin-top: 25px; background-color: #0055ab;"><i class="glyphicon glyphicon-plus"></i></button>
                                            </div>
                                        </div>

                                        <div class="copy2 hide margin_auto row ">
                                            <div  class="row clearfix control-group2 margin_auto">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <label for="sel1">{{ __('registercomplaint.union_officer_name') }}</label>
                                                <input type="text" class="form-control" id="union_officer_name" name="union_officer_name[]">
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-7 col-sm-10 col-xs-10">
                                                <div class="form-group">
                                            <label for="sel1">{{ __('registercomplaint.union_officer_address') }}</label>
                                            <textarea class="form-control" rows="1" id="union_officer_address"  name="union_officer_address[]" style="min-height: 40px;"></textarea>
                                            </div>
                                        </div>

                                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                                <button class="btn btn-danger btn-sm remove" id="remove" type="button" style="margin-top: 25px;"><i class="glyphicon glyphicon-remove"></i></button>
                                            </div>
                                            </div>
                                        </div>

                                        <!-- ====================== -->
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
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                    href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Part B - Details on employers - employee relationship
                                </a>
                            </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                            aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.employer_name') }} *</label>
                                            <input id="employer_name" name="employer_name" type="text"
                                                class="form-control" value="" required>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <label for="usr">{{ __('registercomplaint.employer_address') }} *</label>
                                        <textarea class="form-control" rows="1" id="employer_address"
                                            name="employer_address" style="min-height: 40px;" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                        <div class="form-group">
                                            <label for="sel1">{{ __('registercomplaint.district_id') }}*</label>
                                            <select class="form-control" id="district_id" name="district_id" required>
                                                <option value=""> </option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->district_name_en }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                        <div class="form-group">
                                            <label for="sel1">{{ __('registercomplaint.city_id') }}*</label>
                                            <select class="form-control" id="city_id" name="city_id" required>
                                                <option value=""> </option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->city_name_en }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <label for="usr">{{ __('registercomplaint.employer_tel') }}</label>
                                        <input id="employer_tel" name="employer_tel" type="text" class="form-control"
                                            value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <label for="usr">{{ __('registercomplaint.business_nature') }}</label>
                                        <textarea class="form-control" rows="1" id="business_nature"
                                            name="business_nature" style="min-height: 40px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!--=======================================-->
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="sel1">{{ __('registercomplaint.establishment_type_id') }}</label>
                                                <select class="form-control" id="establishment_type_id" name="establishment_type_id" >
                                                    <option value=""> </option>
                                                    @foreach ($establishmenttypes as $establishmenttype)
                                                        <option value="{{ $establishmenttype->id }}">{{ $establishmenttype->establishment_name_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.establishment_reg_no') }}</label>
                                            <input id="establishment_reg_no" name="establishment_reg_no" type="text" class="form-control"
                                                value="">
                                            </div>
                                        </div> -->
                                    </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.employer_no') }}</label>
                                            <input id="employer_no" name="employer_no" type="text"
                                                class="form-control" value="">
                                        </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <label for="usr">{{ __('registercomplaint.ppe_no') }}</label>
                                        <input id="ppe_no" name="ppe_no" type="text" class="form-control"
                                            value="">
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <label for="usr">{{ __('registercomplaint.employee_no') }}</label>
                                        <input id="employee_no" name="employee_no" type="text" class="form-control"
                                            value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.epf_no') }}</label>
                                            <input id="epf_no" name="epf_no" type="text"
                                                class="form-control" value="">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <label for="usr">{{ __('registercomplaint.employee_mem_no') }}</label>
                                        <input id="employee_mem_no" name="employee_mem_no" type="text" class="form-control"
                                            value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <label for="usr">{{ __('registercomplaint.designation') }}</label>
                                        <input id="designation" name="designation" type="text" class="form-control"
                                            value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                        <div class="form-group has-feedback">
                                            <label for="sel1">{{ __('registercomplaint.join_date') }}</label>
                                            <input type="text" class="form-control form-control_my date"
                                                name="join_date" id="jointComplaintDate" placeholder="" value="" data-dateformat='yy-mm-dd'>
                                            <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group has-feedback">
                                        <label for="sel1">{{ __('registercomplaint.terminate_date') }}</label>
                                        <input type="text" class="form-control form-control_my date"
                                            name="terminate_date" id="terminateComplaintDate" placeholder="" value="" data-dateformat='yy-mm-dd'>
                                        <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group has-feedback">
                                        <label for="sel1">{{ __('registercomplaint.last_sal_date') }}</label>
                                        <input type="text" class="form-control form-control_my date" name="last_sal_date" id="lastsalaryDate" placeholder="" value="" data-dateformat='yy-mm-dd'>
                                        <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row margin_auto">
                                                <div class="form-group">
                                                    <label for="usr">{{ __('registercomplaint.basic_sal') }}</label>
                                                    <input id="basic_sal" name="basic_sal" type="text"
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                            <div class="form-group">
                                                <label for="usr">{{ __('registercomplaint.allowance') }}</label>
                                                <input id="allowance" name="allowance" type="text" class="form-control" value="">
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
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                    href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Part C - Nature of complaint
                                </a>
                            </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                            aria-labelledby="headingThree">
                            <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label for="sel1">{{ __('registercomplaint.complain_category_id') }}*</label>
                                        </div>
                                        @foreach ($complaincategories as $complaincategory)
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="checkbox">
                                                <label>
                                                <input type="checkbox" id="complain_category_id"
                                                    name="complain_category_id[]" value="{{ $complaincategory->id }}">
                                                <span class="cr"><i
                                                    class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    {{ $complaincategory->category_name_en }}
                                                </label>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <span id="errordiv" class="text-danger" style="display:none;">You must check at least one box</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <br class="visibl-xs">
                                        
                                         <div class="row margin_auto">
                                             <div class="col-lg-11 col-md-11 col-sm-10 col-xs-10">
                                                <label for="sel1">{{ __('registercomplaint.support_files') }}</label>
                                                <div class="input-group hdtuto control-group lst increment" style="width: 100%;">
                                                    <input type="file" name="files[]" class="myfrm form-control">
                                                    <!--<div class="input-group-btn">-->
                                                    <!--<button class="btn btn-info btn-sm" id="addrow" type="button" style="background-color: #5D98CC; height:40px; width: 102px;"><i class="glyphicon glyphicon-plus"></i> {{ __('registercomplaint.add') }}</button>-->
                                                    <!--</div>-->
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                                <button class="btn btn-info btn-sm add-more2" id="addrow" type="button" style="margin-top: 25px; background-color: #0055ab;"><i class="glyphicon glyphicon-plus"></i></button>
                                            </div>
                                         </div>
                                        
                                        <div class="clone hide">
                                            <div class="row">
                                                <div class="col-lg-11 col-md-11 col-sm-10 col-xs-10">
                                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px; width: 100%;">
                                                    <input type="file" name="files[]" class="myfrm form-control">
                                                    <!--<div class="input-group-btn">-->
                                                    <!--    <button class="btn btn-danger" id="removerow" type="button" style="margin-top: 0px; height: 40px; width: 102px;"><i class="glyphicon glyphicon-remove"></i> {{ __('registercomplaint.remove') }}</button>-->
                                                    <!--</div>-->
                                                    </div>
                                                </div>
                                                
                                                 <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                                    <button class="btn btn-danger btn-sm" id="removerow" type="button" style="margin-top: 15px;"><i class="glyphicon glyphicon-remove"></i></button>
                                                </div>
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
                                        <button type="button" class="btn btn-default save_btn" name="1" checked value="1"
                                        onclick="alreadyComplain('1');">YES</button>
                                        <button type="button" class="btn btn-default save_btn" name="1" value="0"
                                        onclick="alreadyComplain('0');">NO</button>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <div id="divAlreadyComplain" style="display: none;">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row margin_auto">
                                            <div class="form-group">
                                                <label for="usr">{{ __('registercomplaint.submitted_office') }}</label>
                                                <select class="form-control" id="submitted_office" name="submitted_office">
                                                    <option value=""> </option>
                                                    @foreach ($labouroffices as $labouroffice)
                                                        <option value="{{ $labouroffice->id }}">{{ $labouroffice->office_name_en }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group has-feedback">
                                            <label for="sel1">{{ __('registercomplaint.submitted_date') }}</label>
                                            <input type="text" class="form-control form-control_my date" name="submitted_date" id="submitted_date" placeholder="" value="" data-dateformat='yy-mm-dd'>
                                            <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                        </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.case_no') }}</label>
                                            <input id="case_no" name="case_no" type="text" class="form-control"
                                                value="">
                                        </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="usr">{{ __('registercomplaint.received_relief') }}</label>
                                            <textarea class="form-control" rows="5" id="received_relief"
                                                name="received_relief"></textarea>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <label for="usr">{{ __('registercomplaint.complain_purpose') }}</label>
                                        <textarea class="form-control" rows="5" id="complain_purpose"
                                            name="complain_purpose"></textarea>
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no_padding">

                    <br>
                    <button type="submit" id="button1id" name="button1id" class="btn btn-default save_btn sub_btn">{{ __('registercomplaint.submit_form') }}</button>
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
                     Labour Secretariat, no 41, kirula Road,  <br class="visible-sm visible-xs">colombo 05, sri Lanka.
                  </p>
                  <p>Tel.
                    <a href="tel:+94112581142" style="color: #fff">011 2581142</a> |
                    <a href="tel:+94112581143" style="color: #fff">011 112581143</a> |
                    <a href="tel:+94112581146" style="color: #fff">011 2581146</a> |
                    <a href="tel:+94112581148" style="color: #fff">011 2581148</a> |
                    <a href="tel:+94112581149" style="color: #fff">011 2581149</a>
                  </p>
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
      <!-- Script to Activate the Carousel -->
      <script>
         $('.carousel').carousel({

             interval: 5000 //changes the speed

         })

      </script>
      <!-- scroll top -->
      <script src="{{ asset('public/js/userpanel/scroll-top.js') }}"></script>
      <!-- scroll top -->
      {{-- <script>
        $(function(){
            //window.ParsleyValidator.setLocale('ta');
            $('#new-complaint-form').parsley();
        });
    </script> --}}
      <!--smooth scroll-->
      <script>

         function get_form() {

             //alert(value);
              var value =  $('#comp_type').val();
             if (value == "U") {

                 $("#union").show();

             } else {

                 $("#union").hide();

             }

         }

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
         $('.panel-collapse').on('show.bs.collapse', function () {

             $(this).siblings('.panel-heading').addClass('active');

         });



         $('.panel-collapse').on('hide.bs.collapse', function () {

             $(this).siblings('.panel-heading').removeClass('active');

         });

      </script>
      <!-- accordion -->
      <!-- date picker -->
      <script type="text/javascript" src="{{ asset('public/js/userpanel/datepicker/bootstrap-datepicker.min.js') }}"></script>
      <script>
         // complaint lodged date

         $('#complainant_dob').datepicker({ format: 'yyyy-mm-yy'});

         $('#complainant_dob').on("changeDate", function () {

             $('#my_hidden_input').val(

                 $('#complainant_dob').datepicker('getFormattedDate')

             );

         });

         $('#complainant_dob').datepicker({

             autoclose: true,

         });

         $('#complainant_dob').on('changeDate', function () {

             $(this).datepicker('hide');

         });



         // complaint send date to NPC

         $('#dComplaintSendDate').datepicker({ format: 'yyyy-mm-yy'});

         $('#dComplaintSendDate').on("changeDate", function () {

             $('#my_hidden_input').val(

                 $('#dComplaintSendDate').datepicker('getFormattedDate')

             );

         });

         $('#dComplaintSendDate').datepicker({

             autoclose: true,

         });

         $('#dComplaintSendDate').on('changeDate', function () {

             $(this).datepicker('hide');

         });



         // complaint receive date to NPC

         $('#dComplaintReceiveDate').datepicker({ format: 'yyyy-mm-yy'});

         $('#dComplaintReceiveDate').on("changeDate", function () {

             $('#my_hidden_input').val(

                 $('#dComplaintReceiveDate').datepicker('getFormattedDate')

             );

         });

         $('#dComplaintReceiveDate').datepicker({

             autoclose: true,

         });

         $('#dComplaintReceiveDate').on('changeDate', function () {

             $(this).datepicker('hide');

         });



         // terminate date

         $('#terminateComplaintDate').datepicker({ format: 'yyyy-mm-yy'});

         $('#terminateComplaintDate').on("changeDate", function () {

             $('#my_hidden_input').val(

                 $('#terminateComplaintDate').datepicker('getFormattedDate')

             );

         });

         $('#terminateComplaintDate').datepicker({

             autoclose: true,

         });

         $('#terminateComplaintDate').on('changeDate', function () {

             $(this).datepicker('hide');

         });



         // joint date

         $('#jointComplaintDate').datepicker({ format: 'yyyy-mm-yy'});

         $('#jointComplaintDate').on("changeDate", function () {

             $('#my_hidden_input').val(

                 $('#jointComplaintDate').datepicker('getFormattedDate')

             );

         });

         $('#jointComplaintDate').datepicker({

             autoclose: true,

         });

         $('#jointComplaintDate').on('changeDate', function () {

             $(this).datepicker('hide');

         });



         // joint date

         $('#lastsalaryDate').datepicker({ format: 'yyyy-mm-yy'});

         $('#lastsalaryDate').on("changeDate", function () {

             $('#lastsalaryDate').val(

                 $('#lastsalaryDate').datepicker('getFormattedDate')

             );

         });

         $('#lastsalaryDate').datepicker({

             autoclose: true,

         });

         $('#lastsalaryDate').on('changeDate', function () {

             $(this).datepicker('hide');

         });



         // submitted date

         $('#submitted_date').datepicker({ format: 'yyyy-mm-yy'});

         $('#submitted_date').on("changeDate", function () {

             $('#submitted_date').val(

                 $('#submitted_date').datepicker('getFormattedDate')

             );

         });

         $('#submitted_date').datepicker({
             autoclose: true,
         });

         $('#submitted_date').on('changeDate', function () {
             $(this).datepicker('hide');
         });



      </script>
      <!-- date picker -->

      <script type="text/javascript">
    $(document).ready(function () {
        $(".add-more").click(function () {
            var html = $(".copy").html();
            $(".after-add-more").after(html);

        });

        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group").remove();
        });
    });

     $(document).ready(function () {
        $(".add-more2").click(function () {
            var html = $(".copy2").html();
            $(".after-add-more2").after(html);
        });

        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group2").remove();
        });

        });

   </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#addrow").click(function(){
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click","#removerow",function(){
                $(this).parents(".hdtuto").remove();
            });
        });
    </script>

    <script type="text/javascript">

        $('#district_id').change(function() {

        var districtID = $(this).val();
        console.log(districtID);

        if (districtID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getCity') }}?district_id=" + districtID,
                success: function(res) {

                    if (res) {
                        console.log(res);
                        $("#city_id").empty();
                        $("#city_id").append('<option>Select City</option>');
                        $.each(res, function(key, value) {
                            $("#city_id").append('<option value="' + key + '">' + value +
                                '</option>');
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
    <script>
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
    </script>
    <script>
      $(document).ready(function(){
         $('[data-toggle="tooltip"]').tooltip();
      });
   </script>

   </body>
</html>
