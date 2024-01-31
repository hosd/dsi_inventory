@section('title', 'Edit Dealer User')
<style>
    .line-div {
  position: relative;
  height: 1px;
  background-color: #00000017;
}

.line-div::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 1px;
  background-color: #00000017;
}
</style>
<x-dealer-layout>
    
    @if ($errors->any())
            <div class="alert alert-danger row my-2 mx-4">
                <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
                
                <div class="col-lg-6 col-6 text-end">
                    <button type="button" style="background-color: transparent;" class="close" data-dismiss="alert" aria-label="Close"  >×</button>
                </div>
                
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                
            </div>
            @endif
            @if ($message = Session::get('success'))

            <div class="alert alert-success row my-2 mx-4">
                <div class="col-lg-6 col-6">
                    <p style="margin-bottom: 0px !important;">{{ $message }}</p>
                </div>
                <div class="col-lg-6 col-6 text-end">
                    <button type="button" style="background-color: transparent;" class="close" data-dismiss="alert" aria-label="Close"  >×</button>
                </div>
            </div>
            @endif
            @if ($message = Session::get('danger'))

            <div class="alert alert-danger row my-2 mx-4">
                 <div class="col-lg-6 col-6">
                    <p style="margin-bottom: 0px !important;">{{ $message }}</p>
                </div>
               <div class="col-lg-6 col-6 text-end">
                    <button type="button" style="background-color: transparent;" class="close" data-dismiss="alert" aria-label="Close"  >×</button>
                </div>      
                
            </div>
            @endif
 <div style="background-color: black;">
                        <h2 class="heading_text text-white ps-4">Edit User</h2>
                    </div>
            <form action="{{ route('save-user-edit') }}" enctype="multipart/form-data" autocomplete="off" method="post" id="user_details_form" name="user_details_form">
                @csrf 
                <div class="user_details row">
                        <div class="col-lg-6 col-12">
                            
                                <div class="mb-2 inp-holder" >
                                     <label for="InputName" class="form-label">Name <span class="required" style="color: red;">*</span></label>
                                     <input type="text" id="name" name="name" class="form-control" value="{{$Userinfo[0]->name}}">
                                </div>
                                <div class="mb-2 inp-holder">
                                    <label for="InputEmail" class="form-label">Email <span class="required" style="color: red;">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control"  value="{{$Userinfo[0]->email}}" aria-describedby="emailHelp">
                                <p id="duplicatecheck-msg" style="color: red; display:none;">This email address already has a dealer user account. </p>
                                </div>
                                
                             
                        </div>
                        <div class="col-lg-6 col-12">
                            
                                <div class="mb-2 inp-holder">
                                    <label for="InputPhone" class="form-label">Mobile Number <span class="required" style="color: red;">*</span></label>
                                    <input type="tel" id="phone" name="phone" class="form-control" value="{{$Userinfo[0]->mobile_no}}" maxlength="10" minlength="10">
                                </div>
                                
                              
                        </div>
                        <div class="row">
                                    <section class="col-lg-12" >
                                        <label class="label" style="margin-top: 2%; margin-bottom: 2%; width: 100%;">Do you want to change the password?
                                            <button id="changepwyes" name="chgpw" type="button" value="Y" style="margin-left: 2%; width: 90px;height: 30px; background-color: #963c2c; color: #e7e7e7;" class="btn btn-default"> Yes </button>
                                            <button id="changepwno" name="chgpw" value="N" type="button" style="margin-left: 2%; width: 90px; height: 30px; background-color: #963c2c; color: #e7e7e7;" class="btn btn-default"> No </button></label>
                                    </section>
                                </div>
                        <div class="row" id="changepassword" style="display: none;margin-bottom: 20px">
                        <div class="col-lg-6  col-12">
                            
                                <div class="mb-2 inp-holder">
                                    <label for="InputPassword" class="form-label">Password <span style="color: red;">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                                </div>
                        </div>
                            <div class="col-lg-6  col-12">
                                <div class="mb-2 inp-holder">
                                    <label for="InputConfirmPassword" class="form-label">Confirm Password <span style="color: red;">*</span></label>
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
                                </div>
                              
                        </div>
                        </div>
                        <div class="line-div" style="margin-bottom: 10px"></div>

                        <div class="text-end" style="margin-top: 10px">
                            <button type="submit" class="btn btn-primary text-end">Submit</button>
                            <a class="btn btn-default" href="{{route('dealer/user-list')}}"> Back</a>
                            <input type="hidden" id="savestatus" name="savestatus" value="{{$savestatus}}" />
                            <input type="hidden" id="dealerID" name="dealerID" value="{{encrypt(auth()->user()->dealerID)}}" />
                            <input type="hidden" id="id" name="id" value="{{encrypt($Userinfo[0]->id)}}" />
                        </div>
                    </div>
                        </form>



    <x-slot name="script">
        <script src="{{ asset('public/back/js/plugin/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.colVis.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.tableTools.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatable-responsive/datatables.responsive.min.js') }}"></script> 

        <script type="text/javascript">
   
            $(document).on('click', '.item-btn', function() {            
            var recordid = $(this).data('reorder-id');            
            $('#recIDitem').val(recordid);
            //console.log(productCode);
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
          <script>
              
                       $(document).ready(function () {

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
                
                // jquery form validation for saving stock
                $('#user_details_form').validate({
                    onfocusout: false,
                    rules: {
             
                        name: {
                            required: true,
                            maxlength: 50,
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
                            maxlength: "Maximum length is 50"
                        },
                        email: {
                            required: "Please enter email address",
                            email: "Please enter a valid email address"
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
                
 
                
            // Custom validation method for check reorder quantity is equal or less than order quantity
                $.validator.addMethod("lessThanOrEqual", function(value, element, param) {
                  var otherValue = $(param).val();
                  if (value && otherValue) {
                    return parseFloat(value) < parseFloat(otherValue);
                  }
                  return true; // Skip validation if either value is not entered
                }, "Reorder quantity cannot be equal or greater than quantity.");
            
            

            });
                  $(document).on('change', '#categoryID', function (e) {

                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get-product-codes') }}",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        cateID: id
                    },
                    success: function (response) {

                        $('#district_div').html('');
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        $(".existing_district").html('');

                        // Read data and create <option >
                        var dropdown = ' <label class="form-label required inp-holder"> Product Code <span style="color: red;">*</span></label><div class="existing_district"> <select class="form-select" aria-label="Default select example" name="productcode" id="productcode"> <option value="" ></option>';
                        if (len > 0) {

                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].productcode;

                                dropdown += "<option value='" + id + "'>" + name + "</option>";
                            }

                        }else{
                            dropdown += "<option value=''>"+'No Results Found'+ "</option>";
                        }
                        dropdown += ' </select></div> ';
                        $("#district_div").append(dropdown);
                    }
                });

            });
            
                        $(document).on('change', '#categoryIDitem', function (e) {

                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get-product-codes') }}",
                    type: 'get',
                    dataType: 'json',
                    data: {
                        cateID: id
                    },
                    success: function (response) {

                        $('#district_div_item').html('');
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        $(".existing_district_edit").html('');

                        // Read data and create <option >
                        var dropdown = ' <label class="form-label required inp-holder"> Product Code <span style="color: red;">*</span></label><div class="existing_district_edit"> <select class="form-select" aria-label="Default select example" name="productcode_item" id="productcode_item"> <option value="" ></option>';
                        if (len > 0) {

                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].productcode;

                                dropdown += "<option value='" + id + "'>" + name + "</option>";
                            }

                        }else{
                            dropdown += "<option value=''>"+'No Results Found'+ "</option>";
                        }
                        dropdown += ' </select></div> ';
                        $("#district_div_item").append(dropdown);
                    }
                });

            });
            </script>
            
    </x-slot>
</x-dealer-layout>    