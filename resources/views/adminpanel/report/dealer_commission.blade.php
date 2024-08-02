@section('title', 'Dealer Commission')

<x-app-layout>
    <x-slot name="header">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            #sparks li {
                display: inline-block;
                max-height: 47px;
                overflow: hidden;
                text-align: left;
                box-sizing: content-box;
                -moz-box-sizing: content-box;
                -webkit-box-sizing: content-box;
                width: 95px;
            }

            #sparks li h5 {
                color: #555;
                float: none;
                font-size: 11px;
                font-weight: 400;
                margin: -3px 0 0 0;
                padding: 0;
                border: none;
                font-weight: 900;
                text-transform: uppercase;
                webkit-transition: all 500ms ease;
                -moz-transition: all 500ms ease;
                -ms-transition: all 500ms ease;
                -o-transition: all 500ms ease;
                transition: all 500ms ease;
                text-align: center;
            }

            #sparks li span {
                color: #324b7d;
                display: block;
                font-weight: 900;
                margin-top: 5px;
                webkit-transition: all 500ms ease;
                -moz-transition: all 500ms ease;
                -ms-transition: all 500ms ease;
                -o-transition: all 500ms ease;
                transition: all 500ms ease;
            }

            #sparks li h5:hover {
                color: #999999;
            }

            #sparks li span:hover {
                color: #ffffff;
            }
            .dt-buttons {
                float: right !important;
            }
            .select2-selection__rendered {
                padding-left: 5px !important;
            }
        </style>
    </x-slot>

    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon"></div>
        <!-- END RIBBON -->
        <div id="content">
          
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">
                    <!-- NEW WIDGET START -->
                    
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                   
                                    <div id="search-log-form" class="smart-form">
                                         <form name="search-form" id="search-form" method="get" >
                                        <fieldset>
                                            <div class="row ">
                                            <section class="col col-4">
                                                <label class="label">Dealer</label>
                                                <select class="select2" id="dealer_id" name="dealer_id" required>
                                                    <option value="all">All</option>
                                                    @foreach($dealers as $row)
                                                    <option value="{{  $row->id }}" > {{$row->name}}</option>
                                                    @endforeach
                                                </select> <i></i>
                                            </section>
                                            <section class="col col-4">
                                                <label class="label">Ordered Date From</label>
                                                <label class="input inp-holder">
                                                    <input type="date" id="ordered_from" name="ordered_from" >
                                                </label>
                                            </section>
                                            <section class="col col-4">
                                                <label class="label">Ordered Date To</label>
                                               <label class="input inp-holder">
                                                   <input type="date" id="ordered_to" name="ordered_to" >
                                                </label>
                                                <span class="text-danger" id="date_error_orderdate"  style=" display: none; width: 400px">'Ordered Date To' cannot be before 'Ordered Date From'</span>
                                            </section>
                                        </div>
                                        </fieldset>
                                         <footer class="col col-10" style="padding-right: 0px">
                                             <button id="button1id" name="button1id" type="submit" onclick="return check_order_dates()"  class="btn btn-primary">
                                                 Search
                                             </button>
                                             <a href="{{ route('dealer-commission-report') }}">
                                                 <button name="reset" id="reset" type="button" class="btn btn-default"> Clear</button>
                                             </a>

                                         </footer>
                                    </form>
                                     <footer class="col col-2" style="padding-left: 0px">
                                         <form method="POST" id="excel_form" name="excel_form" action="{{ route('dealer-commission-report-excel') }}">
                                             @csrf
                                             <input type="hidden" name="ex_dealer_id" id="ex_dealer_id" />
                                             <input type="hidden" name="ex_ordered_from" id="ex_ordered_from" />                                             
                                             <input type="hidden" name="ex_ordered_to" id="ex_ordered_to" />

                                             <a class="btn btn-success btn-lg pull-left" style="font-weight: 900 !important;" onclick="add_valuesto_excel();" > <b> Excel </b></a>

                                         </form>
                                     </footer>

                                 </section>
                                    </div>
                              
                        
        </article>
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->

                        <div class="jarviswidget jarviswidget-color-darken" id="user_types" data-widget-editbutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Reports</h2>
                            </header>
                            <!-- widget div-->
                            <div>
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->
                                </div>
                                <!-- end widget edit box -->
                                <!-- widget content -->
                                <div class="widget-body no-padding table-responsive">
                                    <table class="table table-bordered data-table" width="100%" id="order-table">
                                        <thead>
                                            <tr>
                                                <th width="50px">No</th>
                                                <th>Dealer</th>
                                                <th>Order Ref No</th>
                                                <th>Customer Name</th>
                                                <th>Ordered Date</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Quantity</th>
                                                <th>Dealer Income</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- end widget content -->
                            </div>
                            <!-- end widget div -->
                        </div>
                        <!-- end widget -->
                    </article>
                    <!-- WIDGET END -->
                </div>
                <!-- end row -->
                <!-- end row -->
            </section>
        </div>
    </div>
    <x-slot name="script">
    <script src="{{ asset('public/back/js/plugin/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.colVis.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.tableTools.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatable-responsive/datatables.responsive.min.js') }}"></script>

        <script src="{{ asset('public/back/js/plugin/datatable-buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatable-buttons/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatable-buttons/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatable-buttons/buttons.print.min.js') }}"></script>
        <script src="{{ asset('public/back/js/plugin/datatable-buttons/buttons.colVis.min.js') }}"></script>

        <script type="text/javascript">
            function add_valuesto_excel()
            {
                $("#ex_dealer_id").val($("#dealer_id").val());
                $("#ex_ordered_from").val($("#ordered_from").val());
                $("#ex_ordered_to").val($("#ordered_to").val());
           
                $('#excel_form').submit();
            }

        $('#ordered_to').change(function() {
 
                var ordered_from = $('#ordered_from').val();
                var ordered_to = $('#ordered_to').val();
              if (ordered_from && ordered_to) {

                if (ordered_from >ordered_to ) {
                    // Display an error message or handle the validation error
                   $('#date_error_orderdate').show();
                    return false; // 
                }else{
                    $('#date_error_orderdate').hide();
                    return true;
                }
            }
        });
                    function check_order_dates() {
 
                var ordered_from = $('#ordered_from').val();
                var ordered_to = $('#ordered_to').val();
              if (ordered_from && ordered_to) {

                if (ordered_from >ordered_to ) {
                    // Display an error message or handle the validation error
                   $('#date_error_orderdate').show();
                    return false; // 
                }else{
                    $('#date_error_orderdate').hide();
                    return true;
                }
            }
        }
                         
            $(function() {

                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        url: "{{ route('dealer-commission-report') }}",
                       
                        data: function (d) {
                            
                            d.dealer_id = $('#dealer_id').val();
                            d.ordered_from = $('#ordered_from').val();
                            d.ordered_to = $('#ordered_to').val();
                        }
                    },
                    order: [ 0, 'desc' ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'dealer',
                            name: 'dealer'
                        },
                        {
                            data: 'order_ref_no',
                            name: 'order_ref_no'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'orderdate',
                            name: 'orderdate'
                        },
                        {
                            data: 'label_name',
                            name: 'label_name'
                        },
                        {
                            data: 'productcode',
                            name: 'productcode'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'dealer_charge',
                            name: 'dealer_charge'
                        }
                    ],
                    dom: 'Blfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });

                $('#search-form').on('submit', function(e) {
                    table.draw();
                    e.preventDefault();
                });

                $('#reset').click(function(){
                    $("#dealer_id").val(null).trigger('change');
                    $("#ordered_from").val('');
                    $("#ordered_to").val('');
                    table.draw();
                    e.preventDefault();
                });
                
//                var today = new Date();
//                $('#ordered_from').datepicker({
//              format: 'mm-dd-yyyy',
//            autoclose:true,
//            endDate: "today",
//            maxDate: today
//            });
            
            
            });
            
            
        </script>
    </x-slot>
</x-app-layout>
