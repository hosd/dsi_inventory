@section('title', 'Dashboard')
  <style>
    .db_summary_card {
    padding: 20px;
    color: #ffffff;
    border-radius: 10px;
    background-color: #045C8F;
    background-image: url('{{ asset('public/dealer/images/summary_card_bg.jpg') }}')!important;
    background-position: center;
    border-bottom: 2px solid #FF1414;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: 0.5s ease !important;
    min-height: 200px !important;
    }

    .db_summary_card h1{
    font-family: 'Oswald', sans-serif;
    font-size: 30px;
    }

    .db_summary_card h5{
    font-size: 16px;
    font-weight: 600;
    }

    @media only screen and (max-width : 768px) {
        .db_summary_card{
            min-height: auto !important;
        }
	}

    @media only screen and (max-width : 575px) {

        .db_summary_card h1{
            font-family: 'Oswald', sans-serif;
            font-size: 25px;
        }
    }

    @media only screen and (max-width : 375px) {
        .db_summary_card h5{
            font-size: 14px;
        }

    }

  </style>
<x-dealer-layout>

   
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
                
<!--            <div class="dashboard_table">

                <div class="table-responsive">
                    <p><a href="{{route('dealer/reorder-stocks')}}">Reorder Items {{count($count);}}</a></p>

                </div>


            </div>-->
              <div style="background-color: black;">
                        <h2 class="heading_text text-white ps-4">Summary</h2>
                    </div>
                    
                    <div class="user_details" style="background-image: url('{{ asset('public/dealer/images/db_bg_img.jpg') }}')!important; background-position: center; height: 75vh; background-size: cover;">
                        <div class="row" >
                            <div class="col-lg-6 col-12">
                                <a href="">
                                    <div class="db_summary_card">
                                        <h5>Monthly Dealer Income</h5>
                                        <h1 class="text-end mb-0">LKR {{ number_format($monthly_total, 2) }}</h1>
                                    </div>
                                </a>
                                <br class="d-lg-none d-block">
                            </div>
                            <div class="col-lg-3 col-12">
                                <a href="{{route('dealer/reorder-stocks')}}">
                                    <div class="db_summary_card">
                                        <h5>Reorder Products</h5>
                                        <h1 class="text-end mb-0">{{count($count);}}</h1>
                                    </div>
                                </a>
                                <br class="d-lg-none d-block">
                            </div>
                            <div class="col-lg-3 col-12">
                                <a href="{{route('dealer/pending-orders')}}">
                                    <div class="db_summary_card">
                                        <h5>Ongoing Orders</h5>
                                        <h1 class="text-end mb-0">{{$pendingout;}}</h1>
                                    </div>
                                </a>
                            </div>
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

                var table = $('.data-table-pend').DataTable({
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    ajax: "{{ route('dealer/dealer-stock-list') }}",
                    order: [ 1, 'asc' ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'procode',
                            name: 'procode',
                            "className": "text-center"
                        },
                        
                        
                        {
                            data: 'category',
                            name: 'category',
                            "className": "text-center"
                        },
                        {
                            data: 'quantity',
                            name: 'quantity',
                            "className": "text-center"
                        },
                        {
                            data: 'reorder_quantity',
                            name: 'reorder_quantity',
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
                            data: 'item',
                            name: 'item',
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
            
              $(function() {
                                           // reorder quantity
                    var table = $('.data-table-reorder').DataTable({
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    ajax: "{{ route('dealer/dealer-stock-list') }}",
                    order: [ 1, 'asc' ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'procode',
                            name: 'procode',
                            "className": "text-center"
                        },
                        
                        
                        {
                            data: 'category',
                            name: 'category',
                            "className": "text-center"
                        },
                        {
                            data: 'quantity',
                            name: 'quantity',
                            "className": "text-center"
                        },
                        {
                            data: 'reorder_quantity',
                            name: 'reorder_quantity',
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