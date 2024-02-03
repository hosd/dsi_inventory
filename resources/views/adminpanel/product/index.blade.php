@section('title', 'New Products')
@php
if ($savestatus == 'A'){
$categoryID= '';
$subcategoryID= '';
$name = '';
$label_name = '';
$productcode= '';
$status = '';
$designnameID= '';
$designcodeID= '';
$customer_des = '';
$product_des = '';
$unitprice = '';
$modelID = '';
$width = '';
$profile = '';
$rim = '';

}else{
$categoryID= $info[0]->product_category;
$subcategoryID= $info[0]->product_subcategory;
$name = $info[0]->name;
$label_name = $info[0]->label_name;
$productcode= $info[0]->productcode;
$status = $info[0]->status;
$designnameID= $info[0]->designname;
$designcodeID= $info[0]->designcode;
$customer_des = $info[0]->customer_des;
$product_des = $info[0]->product_des;
$unitprice = $info[0]->unitprice;
$width = $info[0]->width;
$profile = $info[0]->profile;
$rim = $info[0]->rim;

}
@endphp

<x-app-layout>
    <style>
        

        .select2-container-multi .select2-choices, .select2-selection--multiple {
            height: auto!important;
            margin: 0;
            padding: 0;
            min-height: 40px !important;
            position: relative;
            border: 1px solid #ccc;
            cursor: text;
            overflow: hidden;
            background-color: #fff;
        }
        .top_btn_height {

            height: 65px;
        }
        .cms_top_btn_list {
            background-color: #2f881ce3 !important;
        }   
        .multiselect {
            height: 10% !important;
        }
    </style>
    <x-slot name="header">

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
                        <a href="{{ route('new-product') }}">
                            <button class="btn cms_top_btn top_btn_height cms_top_btn_active">ADD NEW PRODUCT</button>
                        </a>

                        <a href="{{ route('product-list') }}">
                            <button class="btn cms_top_btn top_btn_height ">VIEW ALL PRODUCTS <br> {{count($count)}}</button>
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
                    <h2>{{$title}} Product</h2>
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
                        <form action="{{ route('new-product') }}" enctype="multipart/form-data" method="post" id="store_details_form" class="smart-form">
                            @csrf
                            <fieldset>
                                <div class="row ">
                                    
                                     
                                    <section class="col col-6">
                                        <label class="label">Product Category <span style=" color: red;">*</span></label>

                                        <label class="select inp-holder">  
                                            <div class="existing_brand">
                                                <select name="categoryID" id="categoryID" required="">
                                                    <option value="" princeID></option>
                                                    @foreach($category as $row)

                                                    <option value="{{  $row->id }}" >{{$row->code}} - {{$row->name}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <i></i>

                                        </label>

                                    </section>
                                    <section class="col col-6">
                                        <label class="label">Product Subcategory <span style=" color: red;">*</span></label>
                                    
                                        <label class="select inp-holder">  
                                            <div class="existing_brand">
                                                <select name="subcategoryID" id="subcategoryID" required="">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <i></i>
                                
                                        </label>

                                    </section>
                                </div>
                                <div class="row " >
                                    <section class="col col-6">
                                        <label class="label">Product Label Name <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="label_name" name="label_name" required value="{{$label_name}}">
                                        </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">Product Name <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="name" name="name" required value="{{$name}}">
                                        </label>
                                    </section>

                                    
                                </div>
                                <div class="row " >
                                    <section class="col col-6">
                                        <label class="label">Product Code </label>
                                        <label class="input inp-holder">
                                            <input type="text" id="productcode" name="productcode"  value="{{$productcode}}">
                                        </label>
                                    </section> 
                                    <section class="col col-6">
                                        <label class="label">Width </label>
                                        <label class="input inp-holder">
                                            <input type="text" id="width" name="width"  value="{{$width}}">
                                        </label>
                                    </section> 


                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">Profile </label>
                                        <label class="input inp-holder">
                                            <input type="text" id="profile" name="profile"  value="{{$profile}}">
                                        </label>
                                    </section> 
                                    <section class="col col-6">
                                        <label class="label">Rim Size </label>
                                        <label class="input inp-holder">
                                            <input type="text" id="rim" name="rim"  value="{{$rim}}">
                                        </label>
                                    </section> 
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                    <label class="label">Design Name</label>

                                        <label class="select inp-holder">  
                                            <div class="existing_brand">
                                                <select name="designnameID" id="designnameID">
                                                    <option value=""></option>
                                                    @foreach($designname as $row)

                                                    <option value="{{  $row->id }}" @if($row->id== $designnameID)selected="selected" @endif > {{$row->name}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <i></i>

                                        </label>
                                     </section>
                                     <section class="col col-6">
                                    <label class="label">Design Code </label>
                                       
                                        <label class="select inp-holder">  
                                            <div class="existing_brand">
                                                <select name="designcodeID" id="designcodeID">
                                                    <option value=""></option>
                                                    @foreach($designcode as $row)

                                                    <option value="{{  $row->id }}" @if($row->id== $designcodeID)selected="selected" @endif > {{$row->name}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <i></i>

                                        </label>
                                     </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                    <label class="label">Product Description </label>

                                        <label class="input inp-holder">
                                            <input type="text" id="product_des" name="product_des"  value="{{$product_des}}">
                                        </label>
                                     </section>
                                     <section class="col col-6">
                                    <label class="label">Customer Description </label>

                                        <label class="input inp-holder">
                                            <input type="text" id="customer_des" name="customer_des"  value="{{$customer_des}}">
                                        </label>
                                     </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                    <label class="label">Unit Price <span style=" color: red;">*</span></label>

                                        <label class="input inp-holder">
                                            <input type="text" id="unitprice" name="unitprice" required value="{{$unitprice}}">
                                        </label>
                                     </section>
                                   <section class="col col-6">
                                        <label class="label">Status</label>
                                        <label class="select">
                                            <select name="status" id="status">
                                                <option value="1" @if( $status == '1') selected="selected" @endif>Active</option>
                                                <option value="0" @if( $status == '0') selected="selected" @endif>Inactive</option>
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>    


                                </div>
<!--                                 <div class="row">
                                     <section class="col col-6">
                                    <label class=" label">Compatible Models - <b>Select multiple using ctrl key + mouse click</b></label>
                                    <label class="select">
                                         <select multiple="multiple" name="modelID[]" id="modelID" size="4" class="multiselect">
                                             @foreach($model as $row)
                                             <option value="{{  $row->id }}" @if($row->id== $modelID)selected="selected" @endif > {{$row->make}} {{$row->name}}</option>
                                             @endforeach
                                         </select>
                                         <i></i>
                                         </label>
                                    </section> 
                                       
                                    </section> 

                                </div>-->
                                
                                <div class=" cleafix"></div>
                                
                                <br>
                               
                            </fieldset>
                            <footer>
                                @if($savestatus !='A')
                                <input type="hidden" id="id" name="id" value="{{encrypt($info[0]->id)}}" />
                                <input type="hidden" id="adddressid" name="adddressid" value="{{encrypt($info[0]->addressID)}}" />
                                @endif
                                <input type="hidden" id="savestatus" name="savestatus" value="{{$savestatus}}" />
                                <button id="button1id" name="button1id" type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <a class="btn btn-default" href="{{route('product-list')}}"> Back</a>
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
                var baseUrl = '{{ url('/') }}';
                existing_productcode_url = baseUrl + "/check_existing_productcode";
                $('#store_details_form').validate({
                    onfocusout: false,
                    rules: {

//                    
                        name: {
                            required: true,
                            maxlength: 50,
                        },
                        categoryID: {
                            required: true,
                        },
                       
                        productcode: {
                            required: true,
                            maxlength: 50,
                            remote: {
                                    url: existing_productcode_url,
                                    type: "GET",
                                    headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                    data: {
                                    "_token": "{{ csrf_token() }}",    
                                    'code': function() {
                                        return $( "#productcode" ).val();
                                    },                                    
                                    },                                
                                  },
                                    },
                        
                        status: {
                            required: true,
                        },
                       
                        product_des: {
                            
                            maxlength: 1000,
                        },
                        customer_des: {
                           
                            maxlength: 1000,
                        },
                        
                        unitprice: {
                            required: true,
                            maxlength: 50,
                            number:true
                        },
                        

                    },
                    messages: {

                        name: {
                            required: "Please enter product name",
                            maxlength: "Maximum length is 50",
                        },
                        categoryID: {
                            required: "Please select a product category",
                        },
                        
                        productcode: {
                            required: "Please enter product code",
                            maxlength: "Maximum length is 50 characters",
                            remote: "Product code already exist",
                        },
                        tyresizeID: {
                            required: "Please select tyre size",
                        },
                        status: {
                            required: "Please the status",
                        },
                        
                        product_des: {
                                                
                            maxlength: "Maximum length is 1000",
                        },
                        customer_des: {
                            
                            maxlength: "Maximum length is 1000",
                        },
                        unitprice: {
                            required: "Please enter unit price",
                            maxlength: "Maximum length is 1000",
                            number:"Enter only the numeric values"
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
           
            $('#categoryID').change(function() {
            
                var categoryID = $(this).val();

                if (categoryID) {

                    $.ajax({
                        type: "post",
                        url: "{{ url('adminpanel/get-subcategory') }}",
                        data: {
                         "_token": "{{ csrf_token() }}",
                          category_id: categoryID
                        
                    },
                        success: function(res) {

                            if (res) {
                                // console.log(res);
                                var lang = $('#lang').val();
                                $("#subcategoryID").empty();
                                $("#subcategoryID").append('<option value=""></option>');
                                $.each(res, function(key, value) {
                                        $("#subcategoryID").append('<option value="' + value['id'] + '">'+ value['code'] + ' - ' + value['name'] +
                                        '</option>');
                                });

                            } else {
                                $("#subcategoryID").empty();
                            }
                        }
                    });
                } else {
                    $("#subcategoryID").empty();
                }
                $("#subcategoryID").val(null).trigger('change');
            });

        </script>
    </x-slot>
</x-app-layout>
