@section('title', 'Profile')
<x-app-layout>
  <x-slot name="header">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  </x-slot>

    @if(Session()->get('applocale')=='ta')
        @php
        $lang = "TA";
        @endphp
        @elseif(Session()->get('applocale')=='si')
        @php
        $lang = "SI";
        @endphp
        @else
        @php
        $lang = "EN";
        @endphp
    @endif

  <div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
    </div>
    <!-- END RIBBON -->
    <div id="content">
      <div class="row">
      <div class="col-lg-12">
                    <div class="row cms_top_btn_row" style="margin-left:auto;margin-right:auto;">
                        <a href="{{ route('users.index') }}">
                            <button class="btn cms_top_btn top_btn_height cms_top_btn_active">{{ __('user.add_new') }}</button>
                        </a>

                        <a href="{{ route('users-list') }}">
                            <button class="btn cms_top_btn top_btn_height ">{{ __('user.view_all') }}</button>
                        </a>
                    </div>
                </div>
        <!-- <div class="col-lg-8">
          <ul id="sparks" class="">
            <ul id="sparks" class="">
              <li class="sparks-info sparks-info_active" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 22px 15px; min-width: auto;">
                <a href="{{ route('users.index') }}">
                  <h5>{{ __('user.add_new') }}</h5>
                </a>
              </li>
              <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 10px; min-width: auto;">
                <a href="{{ route('users-list') }}">
                  <h5>{{ __('user.view_all') }}<span class="txt-color-blue" style="text-align: center"><i class=""></i></span></h5>
                </a>
              </li>
            </ul>
          </ul>
        </div> -->
      </div>

      @if ($errors->any())
      <div class="alert alert-danger">
        <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"  >×</button>       
                <p>{{ $message }}</p>
            </div>
      @endif
      @if ($message = Session::get('danger'))

        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"  >×</button>       
            <p>{{ $message }}</p>
        </div>
        @endif
      <!-- Widget ID (each widget will need unique ID)-->
      <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
        <header>
          <h2>{{ __('user.title') }}</h2>
        </header>
        <!-- widget div-->
        <div>
          <!-- widget edit box -->
          <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->
          </div>
          <!-- end widget edit box -->
          <!-- widget content -->
          <div class="widget-body no-padding">
            <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="post" id="user-form" class="smart-form">
              @csrf
              <fieldset>
                  <input type="hidden" name="lang" value="{{ $lang }}">
                <div class="row">
                  <section class="col col-6">
                    <label class="label">{{ __('user.name') }} <span style=" color: red;">*</span> </label>
                    <label class="input inp-holder">
                      <input type="text" id="name" name="name"  value="">
                    </label>
                  </section>
                    <section class="col col-6">
                    <label class="label">{{ __('user.email') }} <span style=" color: red;">*</span> </label>
                    <label class="input inp-holder">
                      <input type="text" id="email" name="email" required value="">
                    </label>
                    <p id="duplicatecheck-msg" style="color: red; display:none;">This email address already has a user account. </p>
                  </section>
                  
                </div>

                <div class="row">
                  

                  <section class="col col-6">
                    <label class="label">{{ __('user.password') }} <span style=" color: red;">*</span> </label>
                    <label class="input inp-holder">
                      <input type="password" id="password" name="password" required value="" minlength="6">
                    </label>
                  </section>
                  <section class="col col-6">
                    <label class="label">{{ __('user.confirmpassword') }} <span style=" color: red;">*</span> </label>
                    <label class="input inp-holder">
                      <input type="password" id="confirmpassword" name="confirmpassword" required value="" data-parsley-equalto="#password">
                    </label>
                  </section>
                </div>
                <div class="row">
                  
                  <section class="col col-6">
                    <label class="label">{{ __('user.role') }} <span style=" color: red;">*</span></label>
                   <label class="select inp-holder"> 
                      <select id="roles" name="roles" >
                        <option value=""></option>
                        @foreach($roles as $row)
                        @if($row->id != '2')
                        <option value="{{  $row->name }}" > {{$row->name}}</option>
                       @endif
                        @endforeach
                      </select>
                      <i></i>
                    </label> 
                  </section>
                </div>

                
              </fieldset>
              <footer>
                <button id="button1id" name="button1id" type="submit" class="btn btn-primary">
                  {{ __('user.submit') }}
                </button>
                <button type="button" class="btn btn-default" onclick="window.history.back();">
                  {{ __('user.back') }}
                </button>
              </footer>
            </form>
          </div>
          <!-- end widget content -->
        </div>
        <!-- end widget div -->
      </div>
      <!-- end widget -->
    </div>
  </div>
  <x-slot name="script">
    <script>
      $(function() {
        //window.ParsleyValidator.setLocale('ta');
        //$('#user-form').parsley();
      });
    </script>

    <script>
        $(".select2").select2();
    </script>

    <script>
        $(document).ready(function () {
            //            $("[data-hide]").on("click", function() {
//                $(this).closest("." + $(this).attr("data-hide")).hide();
//            });

                

                $.validator.addMethod(
                        "regex",
                        function (value, element, regexp) {
                            var re = new RegExp(regexp);
                            return this.optional(element) || re.test(value);
                        },
                        "Please enter only digits and ' - '."
                        );
                $.validator.addMethod("alphabetsnspace", function (value, element) {
                return this.optional(element) || /^[a-zA-Z]{1}[a-zA-Z ]*$/.test(value);
                });
                
                
                $('#user-form').validate({
                    onfocusout: false,
                    rules: {

//                    branch_address_contactEmail: {
//                        required: true,
//                        //ExistingEmail: true,
//                        email: true,
//                    },
                        name: {
                            required: true,
                            maxlength: 50,
                            //alphabetsnspace:true
                        },
                        email: {
                            required: true,
                            email: true,
                        },
//                        phone: {
//                            required: true,
//                            //matches   : "[0-9]+",
//                            number: true,
//                            minlength: 10,
//                            maxlength: 20
//                        },
                        password: {
                            required: true,
                            minlength: 6,
                            maxlength: 40
                        },
                        confirmpassword: {
                            required: true,
                            minlength: 6,
                            maxlength: 40,
                            equalTo: '#password'
                        },
                        roles: {
                            required: true,
                        },
                        

                    },
                    messages: {

                        name: {
                            required: "Please enter the name",
                            maxlength: "Maximum length is 50",
                            alphabetsnspace:"Please enter alphabets only"
                        },
                        email: {
                            required: "Please enter email address",
                            email: "Please enter a valid email address",
                        },
//                        phone: {
//                            required: "Please enter phone number",
//                            //matches   : "Please eneter valid phone number",
//                            number: "Please enter the numbers only",
//                            minlength: "Minimum length is 10",
//                            maxlength: "Maximum length is 20"
//                        },
                        password: {
                            required: "Please enter the password",
                            minlength: "Minimum length is 6 characters",
                            maxlength: "Maximum length is 40 characters",
                        },
                        confirmpassword: {
                            required: 'Please enter your password one more time',
                            minlength: "Minimum length is 6 characters",
                            maxlength: "Maximum length is 40 characters",
                            equalTo: 'Please enter the same password as above'
                        },
                        roles: {
                            required: "Please select a role",
                        },
                        

                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.inp-holder').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                    invalidHandler: function (form, validator) {
                        var errors = validator.numberOfInvalids();
                        if (errors) {
                            $("#page_top_error_message").show();
                            window.scrollTo(0, 0);
                            //validator.errorList[0].element.focus();

                        }
                    }
                });


            });

      


//            $("#user-form").submit(function (e) {
//
//                $("#button1id").attr("disabled", true);
//
//                return true;
//
//            });

            $('#email').blur(function () {
                var email = $(this).val();
                $("#duplicatecheck-msg").hide();

                if(email) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('checkEmailAvailability') }}",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: {email:email},
                        success: function(data) {
                            if (data != "") {

                                console.log(data);

                                    $("#duplicatecheck-msg").show();

                            } else {

                                $("#duplicatecheck-msg").hide();


                            }
                        }
                    });
                } else {

                    $("#district_id").empty();
                }
            });
        
    </script>
  </x-slot>
</x-app-layout>
