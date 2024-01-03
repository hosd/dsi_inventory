@section('title', 'Stock Management')
<x-dealer-layout>
    <div style="background-color: black;">
        <div class="header_bar row mx-auto  px-4">
            <div class="col-lg-6 col-6">
                <h2 class="heading_text text-white">Reorder Stock management</h2>
            </div>
<!--            <div class="add_btn col-lg-6 col-6">
                <div class="text-end header_btn">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addData"><span class="pe-2"><img class="icon_img" src="{{ asset('public/dealer/images/plus.svg') }}"></span>ADD A NEW STOCK</button>
                </div>


            </div>-->
        </div>  
                                      
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
                    <div class="popup_form modal" id="addData">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('save-dealer-stocks') }}" enctype="multipart/form-data" method="post" id="store_details_form" name="store_details_form">
                                     @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Stock</h5>
                                <button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body popup_form_content">
                                
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mb-3 inp-holder">
                                                <label class="form-label required">Product Category <span style="color: red;">*</span></label>
                                                <select class="form-select" aria-label="Default select example" name="categoryID" id="categoryID">
                                                    <option value=""  > </option>
                                                    @foreach($category as $row)

                                                    <option value="{{  $row->id }}"  > {{$row->name}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3 inp-holder">
                                                <label for="InputQuantity" class="form-label ">Quantity <span style="color: red;">*</span></label>
                                                
                                                <input type="text" name="quantity" id="quantity" class="form-control"  >
                                               
                                                </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="mb-3 inp-holder" id="district_div" >
                                                <label class="form-label required inp-holder">Product Code <span style="color: red;">*</span></label>
                                                <div class="existing_district">
                                                    <select class="form-select" aria-label="Default select example" name="productcode" id="productcode">
                                                        <option value="" ></option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 inp-holder">
                                                <label for="InputReorderQ" class="form-label ">Re-order Quantity <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="reorder_quantity" name="reorder_quantity" >
                                            </div>
                                        </div>
                                    </div>


                               
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary submit_btn me-2">Submit</button>
                                <button type="button" class="btn btn-secondary close_btn" data-bs-dismiss="modal">Close</button>
                                <input type="hidden" id="dealerID" name="dealerID" value="{{auth()->user()->dealerID}}" />
                                <input type="hidden" id="savestatus" name="savestatus" value="{{$savestatus}}" />
                            </div>
                             </form>
                        </div>
                    </div>
                </div>
                    <!--    EDIT stock POPUP-->
    
                    <div class="popup_form modal" id="editData">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('save-dealer-stocks') }}" enctype="multipart/form-data" method="post" id="edit_stock_form" name="edit_stock_form">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Stock</h5>
                                        <button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body popup_form_content">

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">

                                                <div class="mb-3 inp-holder">
                                                    <label for="InputQuantity" class="form-label ">Quantity <span style="color: red;">*</span></label>

                                                    <input type="text" name="quantityedit" id="quantityedit" class="form-control"  >

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">

                                                <div class="mb-3 inp-holder">
                                                    <label for="InputReorderQ" class="form-label ">Re-order Quantity <span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="reorder_quantity_edit" name="reorder_quantity_edit" >
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary submit_btn me-2">Submit</button>
                                        <button type="button" class="btn btn-secondary close_btn" data-bs-dismiss="modal">Close</button>
                                        <input type="hidden" id="dealerID" name="dealerID" value="{{auth()->user()->dealerID}}" />
                                        <input type="hidden" id="recIDstock" name="recIDstock" value="" />
                                        <input type="hidden" id="savestatus" name="savestatus" value="E" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     <!--   End EDIT stock POPUP-->
                     
                     <!--    EDIT item POPUP-->
    
                    <div class="popup_form modal" id="edititem">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('save-dealer-stocks') }}" enctype="multipart/form-data" method="post" id="edit_item_form" name="edit_item_form">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Item Details</h5>
                                        <button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body popup_form_content">

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="mb-3 inp-holder">
                                                    <label class="form-label required">Product Category <span style="color: red;">*</span></label>
                                                    <select class="form-select" aria-label="Default select example" name="categoryIDitem" id="categoryIDitem">
                                                        <option value="" selected="selected" > </option>
                                                        @foreach($category as $row)

                                                        <option value="{{  $row->id }}"  > {{$row->name}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="mb-3 inp-holder" id="district_div_item" >
                                                    <label class="form-label required inp-holder">Product Code <span style="color: red;">*</span></label>
                                                    <div class="existing_district_item">
                                                        <select class="form-select" aria-label="Default select example" name="productcode_item" id="productcode_item">
                                                            <option value="" selected="selected" ></option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary submit_btn me-2">Submit</button>
                                        <button type="button" class="btn btn-secondary close_btn" data-bs-dismiss="modal">Close</button>
                                        <input type="hidden" id="dealerID" name="dealerID" value="{{auth()->user()->dealerID}}" />
                                        <input type="hidden" id="recIDitem" name="recIDitem" value="" />
                                        <input type="hidden" id="savestatus" name="savestatus" value="I" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     <!--   End EDIT stock POPUP-->
                     
                     
                        <div class="dashboard_table">
            
                        <!-- <h3>Stock Management</h3> -->
                        <div class="table-responsive">
                            <table  class="pending_orders_table table table-striped data-table" style="width:100%">
                                <thead>
                                    <tr><th scope="col">No</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Code</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Reorder Quantity</th>
                                        <th scope="col">Edit Stock</th>
                                        <th scope="col">Edit Item</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
<!--                                    <tr>
                                      <th scope="row">001</th>
                                      <td>DISCOVERY 120/17</td>
                                      <td>Motorcycles</td>
                                      <td>200</td>
                                      <td>60</td>
                                      <td>
                                          <div class="d-flex"> 
                                              <div class="pe-3"><a href="#"><img src="{{ asset('public/dealer/images/delete.svg') }}" alt=""></a></div> 
                                              <div><a href="#"><img src="{{ asset('public/dealer/images/edit.svg') }}" alt=""> </a></div>  
                                          </div>
                                      </td>
                                    </tr>-->
                                   
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
                        url: "{{ route('dealer/reorder-stocks')}}",
                       
                    },
                    //ajax: "{{ route('dealer/dealer-stock-list') }}",
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
                        
                    ],
//                    createdRow: function(row, data, dataIndex) {
//                    // Check if quantity is less than reorder_quantity
//                    if (parseInt(data['quantity']) < parseInt(data['reorder_quantity'])) {
//                        // Highlight the row and add a class for styling
//                        $(row).addClass('bg-danger text-white');
//                    }
//                }
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
            $(document).on('change', '#categoryID', function (e) {
    var catid = $('#categoryID').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{ route('get-product-codes') }}",
        type: 'post',
        dataType: 'json',
        data: {
            "_token": "{{ csrf_token() }}",
            cateID: catid
        },
        success: function (response) {
            $('#district_div').html('');

            var len = response.data ? response.data.length : 0;

            $(".existing_district").html('');

            var dropdown = '<label class="form-label required inp-holder"> Product Code <span style="color: red;">*</span></label><div class="existing_district"><select class="form-select" aria-label="Default select example" name="productcode" id="productcode"><option value=""></option>';

            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var id = response.data[i].id;
                    var name = response.data[i].productcode;
                    var lable = response.data[i].label_name;
                    if(lable){
                        dropdown += "<option value='" + name + "'>" + lable +' - '+ name  + "</option>";
                    }else{
                        dropdown += "<option value='" + name + "'>" + name + "</option>";
                    }
                    
                }
            } else {
                dropdown += "<option value=''>" + 'No Results Found' + "</option>";
            }

            dropdown += '</select></div>';
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
                                var lable = response.data[i].label_name;

                            if(lable){
                        dropdown += "<option value='" + name + "'>" + lable +' - '+ name  + "</option>";
                    }else{
                        dropdown += "<option value='" + name + "'>" + name + "</option>";
                    }
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