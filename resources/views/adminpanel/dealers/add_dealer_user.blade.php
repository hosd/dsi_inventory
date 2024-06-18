@section('title', 'Dealers')
@php
$addnew_url = route('new-dealer-user',$Dealer_ID);
$list_url = route('dealer-user-list',$Dealer_ID);

if ($savestatus == 'A'){
$name = '';
$email = '';
$phone = '';
$status = '';

}else{
$name = $Userinfo[0]->name;
$email = $Userinfo[0]->email;
$phone = $Userinfo[0]->mobile_no;
$status = $Userinfo[0]->status; 

}
@endphp
<x-app-layout>
    <x-slot name="header">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  </x-slot>

    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon">
        </div>
        <!-- END RIBBON -->
        <div id="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row cms_top_btn_row" style="margin-left:auto;margin-right:auto;"> 
                        <a href="{{ $addnew_url  }}">
                            <button class="btn cms_top_btn top_btn_height cms_top_btn_active">ADD NEW DEALER USER</button>
                        </a>

                        <a href="{{ $list_url }}">
                            <button class="btn cms_top_btn top_btn_height ">VIEW ALL DEALER USERS</button>
                        </a>
                        <a href="{{ route('dealers-list')  }}">
                            <button class="btn cms_top_btn top_btn_height cms_top_btn_active">DEALERS LIST</button>
                        </a>
                    </div>
                </div>
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
                    <h2>Add new user to {{$info[0]->name}} dealer</h2>
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
                        <form action="{{ route('save-dealer-user') }}" enctype="multipart/form-data" method="post" id="store_details_form" class="smart-form">
                            @csrf
                            <fieldset>
                                <div class="row ">

                                    <section class="col col-6">
                                        <label class="label">User's Name <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="name" name="name" required value="{{$name}}">
                                        </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="label">Email <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="email" id="email" name="email" required value="{{$email}}">
                                        </label>
                                        <p id="duplicatecheck-msg" style="color: red; display:none;">This email address already has a dealer user account. </p>
                                    </section>
                                </div>
                                <div class="row " >
                                    <section class="col col-6">
                                        <label class="label">Phone Number <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="phone" name="phone" required value="{{$phone}}">
                                        </label>
                                    </section>
                                     <section class="col col-6">
                                        <label class="label">Status</label>
                                        <label class="select">
                                            <select name="status" id="status">
                                                <option value="Y" @if( $status == 'Y') selected="selected" @endif>Active</option>
                                                <option value="N" @if( $status == 'N') selected="selected" @endif>Inactive</option>
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>
                                    

                                </div>
                                @if($savestatus == 'E')
                                <div class="row">
                                    <section class="col-lg-12" style="margin-top: 2%; margin-left:16px;">
                                        <label class="label">Do you want to change the password?
                                            <button id="changepwyes" name="chgpw" type="button" value="Y" style="margin-left: 2%; width: 90px; background-color: #963c2c; color: #e7e7e7;" class="btn btn-default"> Yes </button>
                                            <button id="changepwno" name="chgpw" value="N" type="button" style="margin-left: 2%; width: 90px; background-color: #963c2c; color: #e7e7e7;" class="btn btn-default"> No </button></label>
                                    </section>
                                </div>
                                <div class="row" id="changepassword" style="display: none;">
                                    <section class="col col-4">
                                        <label class="label">Password <span style=" color: red;">*</span> </label>
                                        <label class="input inp-holder">
                                            <input type="password" id="password" name="password" value="" minlength="6" class="password" disabled>
                                        </label>
                                    </section>

                                    <section class="col col-4">
                                        <label class="label">Confirm Password  <span style=" color: red;">*</span> </label>
                                        <label class="input inp-holder">
                                            <input type="password" id="confirmpassword" name="confirmpassword" value="" data-parsley-equalto="#password" class="confirmpassword" disabled>
                                        </label>
                                    </section>
                                </div>
                                @else
                                <div class="row">


                                    <section class="col col-6">
                                        <label class="label">Password <span style=" color: red;">*</span> </label>
                                        <label class="input inp-holder">
                                            <input type="password" id="password" name="password" required value="" minlength="6">
                                        </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">Confirm Password <span style=" color: red;">*</span> </label>
                                        <label class="input inp-holder">
                                            <input type="password" id="confirmpassword" name="confirmpassword" required value="" data-parsley-equalto="#password">
                                        </label>
                                    </section>
                                </div>
                                @endif
                                
                                
                                <div class=" cleafix"></div>
                               



                                
                            </fieldset>
                            <footer>
                                @if($savestatus !='A')
                                <input type="hidden" id="id" name="id" value="{{encrypt($Userinfo[0]->id)}}" />
                                
                                @endif
                                <input type="hidden" id="savestatus" name="savestatus" value="{{$savestatus}}" />
                                <input type="hidden" id="Dealer_id" name="Dealer_id" value="{{$Dealer_ID}}" />
                                <button id="button1id" name="button1id" type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <a class="btn btn-default" href="{{route('dealers-list')}}"> Back</a>
                                
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
            $(function () {
                //window.ParsleyValidator.setLocale('ta');
                $('#category-form').parsley();
            });
        </script>
        <script>
            $(document).ready(function () {
//            $("[data-hide]").on("click", function() {
//                $(this).closest("." + $(this).attr("data-hide")).hide();
//            });
//            $(".selectpicker, .multiselect").chosen({
//
//                disable_search_threshold: 5,
//                search_contains: false,
//                enable_split_word_search: false,
//                single_backstroke_delete: false,
//                allow_single_deselect: true,
//                display_selected_options: false
//            });
//            $('.blocks').on('click', 'a.chosen-single', function() {
//                if ($(this).next().width() < $(this).outerWidth()) {
//                    $(this).next().css('width', '100%');
//                }
//            });
                /*$("#filter_search_invoices").chosen({
                 disable_search_threshold: 0
                 });*/

                $.validator.addMethod(
                        "regex",
                        function (value, element, regexp) {
                            var re = new RegExp(regexp);
                            return this.optional(element) || re.test(value);
                        },
                        "Please enter only digits and ' - '."
                        );
                $.validator.setDefaults({
                    ignore: ":hidden:not(.selectpicker)"
                });
                $('#store_details_form').validate({
                    onfocusout: false,
                    rules: {

                    name: {
                            required: true,
                            maxlength: 50,
                            //alphabetsnspace:true
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        phone: {
                            required: true,
                            //matches   : "[0-9]+",
                            number: true,
                            minlength: 10,
                            maxlength: 20
                        },
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

                    },
                    messages: {

                        name: {
                            required: "Please enter the name",
                            maxlength: "Maximum length is 50",
                            //alphabetsnspace:"Please enter alphabets only"
                        },
                        email: {
                            required: "Please enter email address",
                            email: "Please enter a valid email address",
                        },
                        phone: {
                            required: "Please enter phone number",
                            //matches   : "Please eneter valid phone number",
                            number: "Please enter the numbers only",
                            minlength: "Minimum length is 10",
                            maxlength: "Maximum length is 20"
                        },
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
            $('#email').keyup(function () {
                var email = $(this).val();
                //alert(email);
                $("#duplicatecheck-msg").hide();

                if(email) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('checkEmail_dealeruser') }}",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: {email:email},
                        success: function(data) {
                            if (data != "") {

                                console.log(data);

                                    $("#duplicatecheck-msg").show();
                                    $('#button1id').attr('disabled','disabled');
                                    return false;

                            } else {

                                $("#duplicatecheck-msg").hide();
                                $('#button1id').removeAttr('disabled');


                            }
                        }
                    });
                } 
            });
            
            $('#changepwyes').click(function(){ // click to
                    $('#changepassword').show(); // removing disabled in this class
                    $('.password').attr('disabled',false); // removing disabled in this class
                    $('.confirmpassword').attr('disabled',false); // removing disabled in this class
                });

                $('#changepwno').click(function(){ // click to
                    $("#changepassword").hide(); // removing disabled in this class
                    $("#confirmpassword").val('');
                    $("#password").val('');
                });
            

        </script>
    </x-slot>
</x-app-layout>
