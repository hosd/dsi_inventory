@section('title', 'Order Details')
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
        <h2 style="font-size: 18px;" class="heading_text text-white fw-bold ps-4">Order Number : {{$orderinfo['orderRef']}}</h2>
    </div>
     
    <form action="{{ route('update-order-status') }}" enctype="multipart/form-data" autocomplete="off" method="post" id="user_details_form" name="user_details_form">
        @csrf 
        <div class="user_details row">
            <div class="col-lg-6 col-12">

                <div class="mb-2 inp-holder" >
                    <label class="form-label required">Update Status<span style="color: red;">*</span></label>
                    <select class="form-select" aria-label="Default select example" required="" name="status" id="status">
                        <option value="pending"  > Pending</option>
                        <option value="completed"  > Completed</option>
                        <option value="cancelled"  > Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="line-div" style="margin-bottom: 10px"></div>
            <div class="text-end" style="margin-top: 10px">
                <button type="submit" class="btn btn-primary text-end" id="submitBtn">Submit</button>
                <a class="btn btn-default" href="{{route('dealer/pending-orders')}}"> Back</a>

                <input type="hidden" id="dealerID" name="dealerID" value="{{auth()->user()->dealerID }}" />
                <input type="hidden" id="orderid" name="orderid" value="{{$orderinfo['orderID']}}"/>
                <input type="hidden" id="orderRef" name="orderRef" value="{{$orderinfo['orderRef']}}"/>
                <input type="hidden" id="name" name="name" value="{{ $customer['name'] }}"/>
                <input type="hidden" id="email" name="email" value="{{ $customer['email'] }}"/>
             
                 </div>
             </div>
    </form>
                       

                    <div class="dashboard_table">
                        <div>
                            <div class="row">
                                
                                <div class="col-lg-6 col-md-6">
                                    <div class="row">
                                        <div class="col-lg-5 col-5">
                                            <p><b>Order at</b></p>
                                        </div>
                                        <div class="col-lg-7 col-7">
                                            <p><span>:&nbsp;&nbsp;</span>{{$orderinfo['orderdate']}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="row">
                                        <div class="col-lg-5 col-5">
                                            <p class="mb-1"><b>Customer Details</b></p>
                                        </div>
                                        <div class="col-lg-7 col-7">
                                            <p class="mb-1"><span>:&nbsp;&nbsp;</span>{{$customer['name']}}</p>
                                            <p class="mb-1">{{$customer['AddressLine1']}}{{$customer['AddressLine2']}}</p>
                                            <p>{{$customer['mobile']}}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="order_table" class="order_detail_table table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item Details</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price (LKR)</th>
                                        <th scope="col">Discount (%)</th>
                                        <th scope="col">Total (LKR)</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    @if($orderinfo['fixing_fee'] != 0)
                                    <tr style="background-color: #ffe6e6">
                                        <td></td>
                                        <td class="text-end fw-bold">Fixing Fee (LKR)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end fw-bold text-end">{{ number_format($orderinfo['fixing_fee'], 2) }}</td>
                                    </tr>
                                    @endif
                                    <tr style="background-color: #ffe6e6">
                                        <td></td>
                                        <td class="text-end fw-bold">Grand Total (LKR)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end fw-bold text-end">{{ number_format($orderinfo['ordervalue'], 2, '.', '') }}</td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($productlist as $row)
                                    <tr>
                                      <th scope="row">{{$row['LineNumber']}}</th>
                                      <td>{{$row['LabelName']}} - {{$row['ProductCode']}}</td>
                                      <td>{{ $row['Quantity'] }}</td>
                                      <td>{{number_format($row['UnitPrice'], 2, '.', '')}}</td>
                                      <td>{{$row['discount']}}</td>
                                      <td class="text-end">{{ number_format(($row['Quantity']*$row['UnitPrice'])* (1 - $row['discount'] / 100), 2, '.', '')}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                        </div>
                        <br>
                        <div>
                         
                        </div>                        
                    </div>



    <x-slot name="script">
        <script src="{{ asset('public/back/js/plugin/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.colVis.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.tableTools.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatable-responsive/datatables.responsive.min.js') }}"></script> 

        <script type="text/javascript">

$(document).on('click', '.item-btn', function () {
    var recordid = $(this).data('reorder-id');
    $('#recIDitem').val(recordid);
    //console.log(productCode);
});

$('#changepwyes').click(function () { // click to
    $('#changepassword').show(); // removing disabled in this class
    $('.password').attr('disabled', false); // removing disabled in this class
    $('.confirmpassword').attr('disabled', false); // removing disabled in this class
});

$('#changepwno').click(function () { // click to
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
                $.validator.addMethod("lessThanOrEqual", function (value, element, param) {
                    var otherValue = $(param).val();
                    if (value && otherValue) {
                        return parseFloat(value) < parseFloat(otherValue);
                    }
                    return true; // Skip validation if either value is not entered
                }, "Reorder quantity cannot be equal or greater than quantity.");

                $('#user_details_form').on('submit', function() {
                    $('#submitBtn').prop('disabled', true);
                });



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

                        } else {
                            dropdown += "<option value=''>" + 'No Results Found' + "</option>";
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

                        } else {
                            dropdown += "<option value=''>" + 'No Results Found' + "</option>";
                        }
                        dropdown += ' </select></div> ';
                        $("#district_div_item").append(dropdown);
                    }
                });

            });
        </script>

    </x-slot>
</x-dealer-layout>    