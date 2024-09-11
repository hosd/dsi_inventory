@section('title', 'Change Dealer Details')
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
                        <a href="{{ route('order-list') }}">
                            <button class="btn cms_top_btn top_btn_height ">View List</button>
                        </a>
                    </div>
                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
                <header>
                    <h2>Order - {{ $orderinfo['orderRef'] }}</h2>
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
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width:100%; border-style: hidden">
                                <tbody style="border-style: hidden">
                                    <tr style="border-style: hidden">
                                        <td style="width: 20%;"><b>Order Ref No</b></td>
                                        <td style="border-style: hidden">:&nbsp; {{$orderinfo['orderRef'] }}</td>
                                        
                                        <td style="width: 20%;"><b>Order at</b></td>
                                        <td style="border-style: hidden">:&nbsp; {{ $orderinfo['orderdate'] }}</td>
                                    </tr>
                                    <tr style="border-style: hidden">
                                        <td style="width: 20%;"><b>Customer Details</b></td>
                                        <td style="border-style: hidden;">:&nbsp; 
                                            {{ $customer['name'] }}<br>
                                            {{ $customer['AddressLine1']  }}
                                            {{ $customer['AddressLine2'] }}

                                            {{ $customer['mobile'] }}</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                            <br>
                        </div>
                    </div>
                    <!-- end widget content -->
                     <!-- widget content -->
                    <div class="widget-body no-padding">
                        <form action="{{ route('update-dealer') }}" enctype="multipart/form-data" method="post" id="dealer-form" class="smart-form">
                            @csrf
                            <fieldset>
                                <div class="row ">
                                    <?php /* ?>
                                    <section class="col col-6">
                                        <label class="label">Region <span style=" color: red;">*</span></label>

                                        <label class="select inp-holder">  
                                            <div class="existing_brand">
                                                <select name="provinceID" id="provinceID" required="">
                                                    <option value="" princeID></option>
                                                    @foreach($provinces as $row)

                                                    <option value="{{  $row->id }}" @if($row->id== $dealerinfo->province)selected="selected" @endif > {{$row->province_name_en}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                            <i></i>

                                        </label>

                                    </section>
                                    <?php */ ?>
                                    <div id="district_div">
                                        <section class="col col-6">
                                            <label class="label">Territory <span style=" color: red;">*</span></label>

                                            <label class="select inp-holder">  
                                                <div class="existing_district">
                                                    <select name="districtID" id="districtID" required="">
                                                        <option value="" princeID></option>
                                                        @foreach($districts as $row)

                                                        <option value="{{  $row->id }}" @if($row->id== $dealerinfo->state)selected="selected" @endif > {{$row->district_name_en}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                                <i></i>

                                            </label>

                                        </section>
                                    </div>
                                    <div id="city_div">
                                        <section class="col col-6">
                                            <label class="label">Town <span style=" color: red;">*</span></label>
                                            
                                                <label class="select inp-holder">  
                                                    <div class="existing_city">
                                                <select name="cityID" id="cityID" required="">
                                                    <option value="" ></option>
                                                        @foreach($cities as $row)

                                                        <option value="{{  $row->id }}" @if($row->id== $dealerinfo->city)selected="selected" @endif > {{$row->city_name_en}}</option>

                                                        @endforeach
                                                </select>
                                                        </div>
                                                <i></i>
                                                
                                            </label>
                                                
                                        </section>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div id="dealer_div">
                                        <section class="col col-6">
                                            <label class="label">Dealer <span style=" color: red;">*</span></label>
                                            
                                                <label class="select inp-holder">  
                                                    <div class="existing_dealer">
                                                <select name="dealerID" id="dealerID" required="">
                                                    <option value="" ></option>
                                                        @foreach($dealers as $row)

                                                        <option value="{{  $row->id }}" @if($row->id== $dealerinfo->id)selected="selected" @endif > {{$row->name}}</option>

                                                        @endforeach
                                                </select>
                                                        </div>
                                                <i></i>
                                                
                                            </label>
                                                
                                        </section>
                                    </div>
                                       
                                </div>
                            </fieldset>
                            <footer>
                                <input type="hidden" name="orderID" value="{{ $orderinfo['orderID'] }}" />
                                <input type="hidden" name="orderRef" value="{{ $orderinfo['orderRef'] }}" />
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
                $('#dealer-form').parsley();
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#dealer-form').validate({
                    onfocusout: false,
                    rules: {
                        cityID: {
                            required: true,
                        },
                        districtID: {
                            required: true,
                        },

                    },
                    messages: {
                        districtID: {
                            required: "Please select a state",
                        },
                        cityID: {
                            required: "Please select a city",
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

                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
            });
            
            $(document).on('change', '#provinceID', function (e) {

                var id = $(this).val();

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
                        $(".existing_city").html('');
                        $(".existing_dealer").html('');

                        // Read data and create <option >
                        var dropdown = ' <section class="col col-6"> <label class="label">Territory <span style=" color: red;">*</span></label><label class="select inp-holder"><div class="existing_Territory"> <select name="districtID" id="districtID" required=""> <option value="" ></option>';
                        if (len > 0) {

                            for (var i = 0; i < len; i++) {

                                var id = response['data'][i].id;
                                var name = response['data'][i].district_name_en;

                                dropdown += "<option value='" + id + "'>" + name + "</option>";
                            }

                        }
                        dropdown += ' </select></div> <i></i> </label></section>';
                        $("#district_div").append(dropdown);
                    }
                });

            });

            $(document).on('change', '#districtID', function (e) {

                var id = $(this).val();

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

                $.ajax({
                    url: "{{ route('get-dealer') }}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        districtID: id,
                        cityId: $('#cityID').val(),
                        productList : @json($productlist)
                    },
                    success: function (response) {

                        $('#dealer_div').html('');
                        var len = 0;
                        if (response && typeof response['data'] === 'object') {
                            var dataKeys = Object.keys(response['data']); // Get keys of the object
                            len = dataKeys.length;
                        }
                        $(".existing_dealer").html('');

                        // Read data and create <option >
                        var dropdown = ' <section class="col col-6"> <label class="label">Dealer <span style=" color: red;">*</span></label><label class="select inp-holder"><div class="existing_dealer"> <select name="dealerID" id="dealerID" required=""> <option value="" ></option>';
                        if (len > 0) {

                            dataKeys.forEach(function(key) {
                                var id = response['data'][key].id;
                                var name = response['data'][key].name;

                                dropdown += "<option value='" + id + "'>" + name + "</option>";
                            });

                        }
                        dropdown += ' </select></div> <i></i> </label></section>';
                        $("#dealer_div").append(dropdown);
                    }
                });

            });

            $(document).on('change', '#cityID', function (e) {
                var id = $(this).val();

                $.ajax({
                    url: "{{ route('get-dealer') }}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        districtID: $('#districtID').val(),
                        cityId: id,
                        productList : @json($productlist)
                    },
                    success: function (response) {
                        $('#dealer_div').html('');
                        var len = 0;
                        if (response && typeof response['data'] === 'object') {
                            var dataKeys = Object.keys(response['data']); // Get keys of the object
                            len = dataKeys.length;
                        }
                        $(".existing_dealer").html('');

                        // Read data and create <option >
                        var dropdown = ' <section class="col col-6"> <label class="label">Dealer <span style=" color: red;">*</span></label><label class="select inp-holder"><div class="existing_dealer"> <select name="dealerID" id="dealerID" required=""> <option value="" ></option>';
                        if (len > 0) {

                            dataKeys.forEach(function(key) {
                                var id = response['data'][key].id;
                                var name = response['data'][key].name;

                                dropdown += "<option value='" + id + "'>" + name + "</option>";
                            });

                        }
                        dropdown += ' </select></div> <i></i> </label></section>';
                        $("#dealer_div").append(dropdown);
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
