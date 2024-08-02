@section('title', 'Dealers')
@php
$addnew_url = route('new-dealer-commission',$Dealer_ID);
$list_url = route('dealer-commission-list',$Dealer_ID);

if ($savestatus == 'A'){
$commission = '';
$date = '';
$status = '';

}else{
$commission = $commisioninfo[0]->commission;
$date = $commisioninfo[0]->date;
$status = $commisioninfo[0]->status; 

}
@endphp
<x-app-layout>
    <x-slot name="header">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                        <a href="{{ $addnew_url  }}">
                            <button class="btn cms_top_btn top_btn_height cms_top_btn_active">ADD NEW DEALER COMMISSION</button>
                        </a>

                        <a href="{{ $list_url }}">
                            <button class="btn cms_top_btn top_btn_height ">VIEW ALL DEALER COMMISSIONS</button>
                        </a>
                        <a href="{{ route('dealers-list')  }}">
                            <button class="btn cms_top_btn top_btn_height cms_top_btn_active">DEALERS LIST</button>
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
                    <h2>Add new commission to {{$info[0]->name}} dealer</h2>
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
                        <form action="{{ route('save-dealer-commission') }}" enctype="multipart/form-data" method="post" id="store_details_form" class="smart-form">
                            @csrf
                            <fieldset>
                                <div class="row " >
                                    <section class="col col-6">
                                        <label class="label">Commission <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="text" id="commission" name="commission" required value="{{$commission}}">
                                        </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">Date <span style=" color: red;">*</span></label>
                                        <label class="input inp-holder">
                                            <input type="date" id="date" name="date" required value="{{$date}}">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                     <section class="col col-6">
                                        <label class="label">Status</label>
                                        <label class="select">
                                            <select name="status" id="status">
                                                <option value="Y" @if( $status == 'Y') selected="selected" @endif>Active</option>
                                                <option value="N" @if( $status == 'N') selected="selected" @endif>Inactive</option>
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>
                                    

                                </div>
                                <div class=" cleafix"></div>
                                
                            </fieldset>
                            <footer>
                                @if($savestatus !='A')
                                <input type="hidden" id="id" name="id" value="{{encrypt($commisioninfo[0]->id)}}" />
                                
                                @endif
                                <input type="hidden" id="savestatus" name="savestatus" value="{{$savestatus}}" />
                                <input type="hidden" id="Dealer_id" name="Dealer_id" value="{{$Dealer_ID}}" />
                                <button id="button1id" name="button1id" type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <a class="btn btn-default" href="{{route('dealers-list')}}"> Back</a>
                                
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

                        commission: {
                            required: true
                            //alphabetsnspace:true
                        },
                        date: {
                            required: true
                        }

                    },
                    messages: {

                        commission: {
                            required: "Please enter the commission"
                            //alphabetsnspace:"Please enter alphabets only"
                        },
                        date: {
                            required: "Please enter date"
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


            });

        </script>
    </x-slot>
</x-app-layout>
