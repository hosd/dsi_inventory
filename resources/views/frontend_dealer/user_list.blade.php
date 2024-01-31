@section('title', 'User List')
<x-dealer-layout>
    <div style="background-color: black;">
        <div class="header_bar row mx-auto  px-4">
            <div class="col-lg-6 col-6">
                <h2 class="heading_text text-white">User List</h2>
            </div>
            <div class="add_btn col-lg-6 col-6">
                <div class="text-end header_btn">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addData"><span class="pe-2"><img class="icon_img" src="{{ asset('public/dealer/images/plus.svg') }}"></span>ADD A NEW USER</button>
                </div>


            </div>
        </div>  
                                      
    </div>
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
                <div class="header_bar row mx-auto  px-4">


                    <div class="add_btn col-lg-6 col-6">

                        <div class="popup_form modal" id="addData">
                            <div class="modal-dialog">
                                <form action="{{ route('save-user-edit') }}" enctype="multipart/form-data" method="post" id="store_details_form" name="store_details_form">
                                    @csrf  
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Add New User</h5>
                                            <button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body popup_form_content">

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3 inp-holder">
                                                        <label for="InputName" class="form-label">Name <span style="color: red;">*</span></label>
                                                        <input type="text" id="name" name="name" class="form-control">
                                                    </div>
                                                   <div class="mb-3 inp-holder">
                                                        <label for="InputContact" class="form-label">Mobile Number <span style="color: red;">*</span></label>
                                                        <input type="tel" id="phone" name="phone" class="form-control" maxlength="10" minlength="10">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3 inp-holder">
                                                        <label for="InputEmail" class="form-label">Email <span style="color: red;">*</span></label>
                                                        <input type="email" id="email" name="email" class="form-control"   aria-describedby="emailHelp">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3 inp-holder">
                                                        <label for="InputPassword" class="form-label">Password <span style="color: red;">*</span></label>
                                                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="mb-3 inp-holder">
                                                        <label for="InputConfirmPassword" class="form-label">Confirm Password <span style="color: red;">*</span></label>
                                                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" id="savestatus" name="savestatus" value="{{$savestatus}}" />
                                            <input type="hidden" id="dealerID" name="dealerID" value="{{encrypt(auth()->user()->dealerID)}}" />
                                            <button type="submit" class="btn btn-primary submit_btn me-2">Submit</button>
                                            <button type="button" class="btn btn-secondary close_btn" data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>                       
            </div>

                     
                     
                        <div class="dashboard_table">
            
                        <!-- <h3>Stock Management</h3> -->
                        <div class="table-responsive">
                            <table  class="pending_orders_table table table-striped data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Mobile_Number</th>
                                        <th scope="col">Edit Item</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                   
                                  </tbody>
                                </table>
                        </div>

                    </div>

    <x-slot name="script">
        <script src="{{ asset('public/back/js/plugin/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.colVis.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.tableTools.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatable-responsive/datatables.responsive.min.js') }}"></script> 

        <script type="text/javascript">
            $(function() {

                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('dealer/user-list') }}",
                    order: [ 1, 'asc' ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            "className": "text-center"
                        },
                        
                        
                        {
                            data: 'email',
                            name: 'email',
                            "className": "text-center"
                        },
                        {
                            data: 'role',
                            name: 'role',
                            "className": "text-center"
                        },
                        {
                            data: 'mobile_no',
                            name: 'mobile_no',
                            "className": "text-center"
                        },

                        {
                            data: 'edit',
                            name: 'edit',
                            "className": "text-center",
                            orderable: false,
                            searchable: false
                        },
                        
                        {
                            data: 'activation',
                            name: 'activation',
                            "className": "text-center",
                            orderable: false,
                            searchable: false
                        },
                        
                    ]
                });
            });
            
            $(document).on('click', '.edit-btn', function() {
            //var categoryId = $(this).data('category-id');
            var quantity = $(this).data('quantity');
            //var productCode = $(this).data('product-code');
            var reorderQuantity = $(this).data('reorder-quantity');
            var recordid = $(this).data('reorder-id');            
            // Encrypt the recordid value
            //var encryptedRecordid = '{{ encrypt('recordid') }}'.replace('recordid', recordid);

            // Set the values in the modal fields
            //$('#categoryIDedit').val(categoryId);
            $('#quantityedit').val(quantity);
            //$('#productcode_edit').val(productCode);
            $('#reorder_quantity_edit').val(reorderQuantity);
            $('#recIDstock').val(recordid);
             //console.log(productCode);
            });

            $(document).on('click', '.item-btn', function() {            
            var recordid = $(this).data('reorder-id');            
            $('#recIDitem').val(recordid);
            //console.log(productCode);
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
                $('#store_details_form').validate({
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