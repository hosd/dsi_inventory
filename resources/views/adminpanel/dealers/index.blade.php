@section('title', 'Dealers')
@php
if ($savestatus == 'A'){
$name = '';
$email = '';
$phone = '';
$status = '';
$vAddressline1= '';
$vAddressline2= '';
$dealercode= '';
$provinceID = '';
$districtID= '';
$cityID= '';
$vOpeninghours= '';
$vContactperson = '';
$vLatitude= '';
$vLongitude = '';
$bankID = '';
$vBranchname = '';
$vBranchcode = '';
$vAccountnum ='';
$tType ='';

}else{

$name = $info[0]->name;
$email = $info[0]->email;
$phone = $info[0]->phone;
$status = $info[0]->status; 
$vContactperson = $info[0]->Contact_person;
$vOpeninghours= $info[0]->opening_hours;
$vLatitude = $info[0]->vLatitude;
$vLongitude= $info[0]->vLongitude;
$dealercode= $info[0]->dealercode;

$vAddressline1= $addressinfo[0]->vAddressline1;
$vAddressline2= $addressinfo[0]->vAddressline2;
$cityID= $addressinfo[0]->cityID;
$districtID= $addressinfo[0]->districtID;
$provinceID = $addressinfo[0]->provinceID;

$bankID = $info[0]->bankID;
$vBranchname = $info[0]->vBranchname;
$vBranchcode = $info[0]->vBranchcode;
$vAccountnum =$info[0]->vAccountnum;
$tType =$info[0]->tType;
}
@endphp
<x-app-layout>
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
                        <a href="{{ route('new-dealers') }}">
                            <button class="btn cms_top_btn top_btn_height cms_top_btn_active">ADD NEW DEALER</button>
                        </a>

                        <a href="{{ route('dealers-list') }}">
                            <button class="btn cms_top_btn top_btn_height ">VIEW ALL DEALERS <br> {{count($count)}}</button>
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
                    <h2>{{$title}} Dealer</h2>
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
                        <form action="{{ route('new-dealers') }}" enctype="multipart/form-data" method="post" id="store_details_form" class="smart-form">
                            @csrf
                            <fieldset>
                                <div class="row ">

                                    <section class="col col-6">
                                        <label class="label">Dealer Name <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="dealer_name" name="dealer_name" required value="{{$name}}">
                                        </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="label">Email <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="email" id="email" name="email" required value="{{$email}}">
                                        </label>
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
                                        <label class="label">Contact Person </label>
                                        <label class="input inp-holder">
                                            <input type="text" id="vContactperson" name="vContactperson"  value="{{$vContactperson}}">
                                        </label>
                                    </section>

                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">Opening Hours <span style=" color: red;">*</span></label>
                                        <label class="textarea inp-holder">
                                            <textarea id="vOpeninghours" rows="4" name="vOpeninghours" required value="">{{$vOpeninghours}}</textarea>
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
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">Dealer Type <span style=" color: red;">*</span></label>
                                        @foreach($types as $row)
                                            <section class="col col-4">
                                                <input type="checkbox" name="tType[]" id="tType{{  $row->id }}" value="{{  $row->id }}" <?php if(in_array($row->id, explode(',', $tType))){?>checked <?php } ?> style="padding: 10px; border-radius: 4px;margin: 10px;">{{$row->name}}
                                            </section>
                                        @endforeach
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">Dealer Code <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="dealercode" name="dealercode"  value="{{$dealercode}}" required>
                                        </label>
                                    </section>    


                                </div>
                                
                                <div class=" cleafix"></div>
                                <header><b>Address</b></header>
                                <br>
                                <div class="row ">
                                    <section class="col col-6">
                                        <label class="label">Address Line 1 <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="vAddressline1" name="vAddressline1" required value="{{$vAddressline1}}">
                                        </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">Address Line 2 <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="vAddressline2" name="vAddressline2" required value="{{$vAddressline2}}">
                                        </label>
                                    </section>
                                </div>
                                <div class="row ">
                                    <section class="col col-6">
                                        <label class="label">Region <span style=" color: red;">*</span></label>

                                        <label class="select inp-holder">  
                                            <div class="existing_brand">
                                                <select name="provinceID" id="provinceID" required="">
                                                    <option value="" princeID></option>
                                                    @foreach($province as $row)

                                                    <option value="{{  $row->id }}" @if($row->id== $provinceID)selected="selected" @endif > {{$row->province_name_en}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <i></i>

                                        </label>

                                    </section>
                                    <div class="row " id="district_div">
                                    <section class="col col-6">
                                        <label class="label">Territory <span style=" color: red;">*</span></label>

                                        <label class="select inp-holder">  
                                            <div class="existing_district">
                                                <select name="districtID" id="districtID" required="">
                                                    <option value="" princeID></option>
                                                    @foreach($District as $row)

                                                    <option value="{{  $row->id }}" @if($row->id== $districtID)selected="selected" @endif > {{$row->district_name_en}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <i></i>

                                        </label>

                                    </section>
                                    </div>
                                </div>
                                <div class="row" id="city_div">
                                    
                                    
                                    <section class="col col-6">
                                        <label class="label">Town <span style=" color: red;">*</span></label>
                                        
                                            <label class="select inp-holder">  
                                                <div class="existing_city">
                                            <select name="cityID" id="cityID" required="">
                                                <option value="" ></option>
                                                    @foreach($city as $row)

                                                    <option value="{{  $row->id }}" @if($row->id== $cityID)selected="selected" @endif > {{$row->city_name_en}}</option>

                                                    @endforeach
                                            </select>
                                                    </div>
                                            <i></i>
                                            
                                        </label>
                                            
                                    </section>
                                       
                                </div>
                                
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">Google MAP Latitude </label>
                                        <label class="input inp-holder">
                                            <input type="text" id="vLatitude" name="vLatitude"  value="{{$vLatitude}}">
                                        </label>
                                    </section>    
                                <section class="col col-6">
                                        <label class="label">Google MAP Longitude </label>
                                        <label class="input inp-holder">
                                            <input type="text" id="vLongitude" name="vLongitude"  value="{{$vLongitude}}">
                                        </label>
                                    </section> 

                                </div>

                                <div class=" cleafix"></div>
                                <header><b>Bank Details</b></header>
                                <br>
                                <div class="row" >
                                    
                                    
                                    <section class="col col-6">
                                        <label class="label">Select The Bank <span style=" color: red;">*</span></label>
                                        
                                            <label class="select inp-holder"> 
                                            <select name="bankID" id="bankID" required="">
                                                <option value="" ></option>
                                                    @foreach($bank as $row)

                                                    <option value="{{  $row->id }}" @if($row->id== $bankID)selected="selected" @endif > {{$row->name}}</option>

                                                    @endforeach
                                            </select>
                                            <i></i>
                                            
                                        </label>
                                            
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">Branch Name <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="vBranchname" name="vBranchname"  value="{{$vBranchname}}">
                                        </label>
                                    </section> 
                                       
                                </div>
                                <div class="row" >
                                <section class="col col-6">
                                        <label class="label">Branch Code <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="vBranchcode" name="vBranchcode"  value="{{$vBranchcode}}">
                                        </label>
                                </section>
                                <section class="col col-6">
                                        <label class="label">Account Number <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="vAccountnum" name="vAccountnum"  value="{{$vAccountnum}}">
                                        </label>
                                </section>

                                </div>


                                
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
                                <button type="button" class="btn btn-default" onclick="window.history.back();">
                                    Back
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

//                    branch_address_contactEmail: {
//                        required: true,
//                        //ExistingEmail: true,
//                        email: true,
//                    },
                        dealer_name: {
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
                        vAddressline1: {
                            required: true,
                            maxlength: 100
                        },
                        vAddressline2: {
                            required: true,
                            maxlength: 100
                        },
                        status: {
                            required: true,
                        },
                        tType: {
                            required: true,
                        },
                        dealercode: {
                            required: true,
                        },
                        cityID: {
                            required: true,
                        },
                        districtID: {
                            required: true,
                        },
                        vContactperson: {
                            
                            maxlength: 50,
                        },
                        vOpeninghours: {
                            required: true,
                            maxlength: 50,
                        },
                        bankID: {
                            required: true,
                        },
                        vBranchname: {
                            required: true,
                        },
                        vBranchcode: {
                            required: true,
                        },
                        vAccountnum: {
                            required: true,
                        },

                    },
                    messages: {

                        dealer_name: {
                            required: "Please enter dealers name",
                            maxlength: "Maximum length is 50",
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
                        vAddressline1: {
                            required: "Please enter the content for address line 1",
                            maxlength: "Maximum length is 100 characters",
                        },
                        vAddressline2: {
                            required: "Please enter the content for address line 2",
                            maxlength: "Maximum length is 100 characters",
                        },
                        status: {
                            required: "Please the status",
                        },
                        tType: {
                            required: "Please select a dealer type",
                        },
                        dealercode: {
                            required: "Please enter a dealer code",
                        },
                        districtID: {
                            required: "Please select a state",
                        },
                        cityID: {
                            required: "Please select a city",
                        },
                        vContactperson: {
                            //required: "Please enter the contact person name" ,                          
                            maxlength: "Maximum length is 50",
                        },
                        vOpeninghours: {
                            required: "Please enter the opening hours number",
                            maxlength: "Maximum length is 20",
                        },
                        bankID: {
                            required: "Please select a bank",
                        },
                        vBranchname: {
                            required: "Please enter the branch name",
                        },
                        vBranchcode: {
                            required: "Please enter the branch code",
                        },
                        vAccountnum: {
                            required: "Please enter the account number",
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
            
            $(document).on('change', '#provinceID', function (e) {

                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get-dealer-territories') }}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                         "_token": "{{ csrf_token() }}",
                        provinceID: id
                    },
                    success: function (response) {

                        $('#district_div').html('');
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        $(".existing_district").html('');

                        // Read data and create <option >
                        var dropdown = ' <section class="col col-6"> <label class="label">Territory <span style=" color: red;">*</span></label><label class="select inp-holder"><div class="existing_Territory"> <select name="districtID" id="districtID" required=""> <option value="" ></option>';
                        if (len > 0) {

                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].district_name_en;

                                dropdown += "<option value='" + id + "'>" + name + "</option>";
                            }

                        }
                        dropdown += ' </select></select></div> <i></i> </label></section>';
                        $("#district_div").append(dropdown);
                    }
                });

            });

            });
            $(document).on('change', '#districtID', function (e) {

                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get-state-cities') }}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        districtID: id
                    },
                    success: function (response) {

                        $('#city_div').html('');
                        var len = 0;
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        $(".existing_city").html('');

                        // Read data and create <option >
                        var dropdown = ' <section class="col col-6"> <label class="label">Town <span style=" color: red;">*</span></label><label class="select inp-holder"><div class="existing_city"> <select name="cityID" id="cityID" required=""> <option value="" ></option>';
                        if (len > 0) {

                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].city_name_en;

                                dropdown += "<option value='" + id + "'>" + name + "</option>";
                            }

                        }
                        dropdown += ' </select></select></div> <i></i> </label></section>';
                        $("#city_div").append(dropdown);
                    }
                });

            });
            

        </script>
    </x-slot>
</x-app-layout>
