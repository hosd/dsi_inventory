@section('title', 'Cancelled Pickup Orders')

<x-dealer-layout>
    <div style="background-color: black;">
        <h2 class="heading_text text-white ps-4">Cancelled Pickup Orders</h2>
    </div>
    @if ($errors->any())
            <div class="alert alert-danger row my-2 mx-4">
                <!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
                
                <div class="col-lg-6 col-6 text-end">
                    <button type="button" style="background-color: transparent;" class="close" data-dismiss="alert" aria-label="Close"  >×</button>
                </div>
                <div class="col-lg-6 col-6 text-end">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
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
               <div class="dashboard_table">
                        <!-- <h3>Pending Orders</h3> -->
                        <div class="table-responsive">
                            <table id="table_1" class="pending_orders_table table table-striped data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Order No.</th>
                                        <th scope="col">Ordered Date</th>
                                        <th scope="col">Cancelled Date</th>
                                        <th scope="col">Total (Rs.)</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Mobile Number</th>
                                        <th scope="col">View </th>
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
                     ajax: {
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        url: "{{ route('dealer/cancelled-orders')}}",
                       
                    },
                    order: [ 1, 'asc' ],
                    columns: [
                        {
                            data: 'orderRef',
                            name: 'orderRef'
                        },
                        {
                            data: 'orderdate',
                            name: 'orderdate',
                            "className": "text-center"
                        },
                        
                        
                        {
                            data: 'cancelleddate',
                            name: 'cancelleddate',
                            "className": "text-center"
                        },
                        {
                            data: 'ordervalue',
                            name: 'ordervalue',
                            "className": "text-center"
                        },
                        {
                            data: 'customerName',
                            name: 'customerName',
                            "className": "text-center"
                        },
                        {
                            data: 'mobile',
                            name: 'mobile',
                            "className": "text-center"
                        },
                        {
                            data: 'edit',
                            name: 'edit',
                            "className": "text-center",
                            orderable: false,
                            searchable: false
                        },
                        
                    ]
                    
                    
                });
                
                      // Add event listener to capture dropdown changes
//        $('.data-table').on('click', '.dropdown-toggle', function() {
//            
//            var selectedStatus = $(this).text().trim();
//            var orderID = $(this).attr('id').replace('pendingDropdown', '');
//alert(selectedStatus);
//            // Send selectedStatus and orderID to your API
//            $.ajax({
//                url: '{{ route("update-order-status") }}', // Replace with your API endpoint
//                method: 'POST',
//                data: {
//                    "_token": "{{ csrf_token() }}",
//                    orderID: orderID,
//                    status: selectedStatus
//                },
//                success: function(response) {
//                    // Handle success (if needed)
//                    console.log(response);
//                },
//                error: function(error) {
//                    // Handle error (if needed)
//                    console.error(error);
//                }
//            });
//        });
        
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
             
                        quantity: {
                            required: true,
                            maxlength: 5,
                            number:true
                        },
                        categoryID: {
                            required: true
                        },
                       
                        productcode: {
                            required: true
                        },
                        reorder_quantity: {
                            required: true,
                            maxlength: 5,
                            number:true,
                            lessThanOrEqual: "#quantity" // Custom rule to check if reorder_quantity is less than or equal to quantity
                        }
                        
                    },
                    messages: {

                        quantity: {
                            required: "Please enter an quatity",
                            maxlength: "Maximum length is 5",
                             number:"Enter only the numeric values"
                        },
                        categoryID: {
                            required: "Please select a product category"
                        },
                                              
                        productcode: {
                            required: "Please select a product"
                        },
                       reorder_quantity: {
                            required: "Please enter an reorder quatity",
                            maxlength: "Maximum length is 5",
                             number:"Enter only the numeric values",
                             lessThanOrEqual: "Reorder quantity cannot be greater than quantity"
                        }
                        
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
                
                // jquery form validation for edit stock
                
                $('#edit_stock_form').validate({
                    onfocusout: false,
                    rules: {

                        quantityedit: {
                            required: true,
                            maxlength: 5,
                            number:true
                        },
                        
                        reorder_quantity_edit: {
                            required: true,
                            maxlength: 5,
                            number:true,
                            lessThanOrEqual: "#quantityedit" // Custom rule to check if reorder_quantity is less than or equal to quantity
                        }
                        
                    },
                    messages: {

                        quantityedit: {
                            required: "Please enter an quatity",
                            maxlength: "Maximum length is 5",
                             number:"Enter only the numeric values"
                        },
                       
                       reorder_quantity: {
                            required: "Please enter an reorder quatity",
                            maxlength: "Maximum length is 5",
                             number:"Enter only the numeric values",
                             lessThanOrEqual: "Reorder quantity cannot be equal or greater than quantity"
                        }
                      
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
                
                // jquery form validation for edit item info
                
                $('#edit_item_form').validate({
                    onfocusout: false,
                    rules: {
             
                        
                        categoryIDitem: {
                            required: true
                        },
                       
                        productcode_item: {
                            required: true
                        },
                        
                        
                    },
                    messages: {

                        
                        categoryIDitem: {
                            required: "Please select a product category"
                        },
                                              
                        productcode_item: {
                            required: "Please select a product"
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
    

            </script>
            
    </x-slot>
</x-dealer-layout>    