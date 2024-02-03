@section('title', 'Products')
@php
if ($savestatus == 'A'){
$categoryID= '';
$name = '';
$productcode= '';
$status = '';
$tyresizeID = '';
$designnameID= '';
$designcodeID= '';
$customer_des = '';
$product_des = '';
$unitprice = '';
$modelID = '';

}else{
$categoryID= $info[0]->product_category;
$name = $info[0]->name;
$productcode= $info[0]->productcode;
$status = $info[0]->status;
$tyresizeID = $info[0]->tyresize;
$designnameID= $info[0]->designname;
$designcodeID= $info[0]->designcode;
$customer_des = $info[0]->customer_des;
$product_des = $info[0]->product_des;
$unitprice = $info[0]->unitprice;

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
                        

                        <a href="{{ route('product-list') }}">
                            <button class="btn cms_top_btn top_btn_height ">VIEW ALL ORDERS <br> {{0}}</button>
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
                    <h2>Pending Order list</h2>
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
                                <div class="row">
                                
                                    <p style="font-size: 30px; text-align: center; font-weight: 700; color: red;">UNDER CONSTRUCTION</p>
                         
                                    
                                </div>
                               
                             
                           
                               
                                
                                <div class=" cleafix"></div>
                                
                                <br>
                               
                            </fieldset>
<!--                            <footer>
                                @if($savestatus !='A')
                                <input type="hidden" id="id" name="id" value="{{encrypt($info[0]->id)}}" />
                                <input type="hidden" id="adddressid" name="adddressid" value="{{encrypt($info[0]->addressID)}}" />
                                @endif
                                <input type="hidden" id="savestatus" name="savestatus" value="{{$savestatus}}" />
                                <button id="button1id" name="button1id" type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <a class="btn btn-default" href="{{route('product-list')}}"> Back</a>
                            </footer>-->
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
                                    'code': function() {
                                        return $( "#productcode" ).val();
                                    },                                    
                                    },                                
                                  },
                                    },
                        tyresizeID: {
                            required: true,
                        },
                        status: {
                            required: true,
                        },
                        designnameID: {
                            required: true,
                        },
                        designcodeID: {
                            required: true,
                        },
                        product_des: {
                            required: true,
                            maxlength: 1000,
                        },
                        customer_des: {
                            required: true,
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
                        designnameID: {
                            required: "Please select design name",
                        },
                        designcodeID: {
                            required: "Please select design code",
                        },
                        product_des: {
                            required: "Please enter product description" ,                          
                            maxlength: "Maximum length is 1000",
                        },
                        customer_des: {
                            required: "Please enter customer description",
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
           
            

        </script>
    </x-slot>
</x-app-layout>
