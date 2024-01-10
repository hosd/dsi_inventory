@section('title', 'Dealer Commission')

<x-dealer-layout>
    <div style="background-color: black;">
        <h2 class="heading_text text-white ps-4">Dealer Commission</h2>
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
            <!-- ====================  -->
            <div>
                <form name="search-form" id="search-form" method="get" >
                    <div class="user_details row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Ordered Date From</label>
                                <input type="date" class="form-control" id="ordered_from" name="ordered_from">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Ordered Date To</label>
                                <input type="date" class="form-control" id="ordered_to" name="ordered_to">
                            </div>
                            
                        </div>
                        <div class="justify-content-end d-flex gap-2">
                            <input type="hidden" name="ex_ordered_from" id="ex_ordered_from" />                                             
                            <input type="hidden" name="ex_ordered_to" id="ex_ordered_to" />
                            <button type="submit" onclick="return check_order_dates()" class="btn btn-primary text-end border-0" style="background-color:#00AEEF;">Search</button>
                            <a href="{{ route('commission-report') }}">
                                <button name="reset" id="reset" type="button" class="btn btn-primary text-end border-0" style="background-color:#FF0000;">Clear</button>
                            </a>
                            <button type="button" class="btn btn-primary text-end border-0" style="background-color: #1D6C41;" onclick="add_valuesto_excel();submitForExcel();">Excel</button>
                        </div>
                    </div>
                </form>
            </div>
                    <!-- ====================  -->
               <div class="dashboard_table">
                        <!-- <h3>Pending Orders</h3> -->
                        <div class="table-responsive">
                            <table id="table_1" class="pending_orders_table table table-striped data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="50px">No</th>
                                        <th>Order Ref No</th>
                                        <th>Customer Name</th>
                                        <th>Ordered Date</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Quantity</th>
                                        <th>Dealer Charge</th>
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
            function add_valuesto_excel()
            {
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
                        url: "{{ route('commission-report') }}",
                       
                        data: function (d) {
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
        <script>
            function submitForExcel() {
                // Get input values
                const exDealerId = '{{ auth()->user()->dealerID }}';
                const exOrderedFrom = $('#ex_ordered_from').val();
                const exOrderedTo = $('#ex_ordered_to').val();

                // Create a form dynamically
                const form = $('<form action="{{ route('commission-report-excel') }}" method="POST" style="display: none;"></form>');
                form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
                form.append('<input type="hidden" name="ex_dealer_id" value="' + exDealerId + '">');
                form.append('<input type="hidden" name="ex_ordered_from" value="' + exOrderedFrom + '">');
                form.append('<input type="hidden" name="ex_ordered_to" value="' + exOrderedTo + '">');

                // Append the form to the body and submit it
                $('body').append(form);
                form.submit();
            }
        </script>
            
    </x-slot>
</x-dealer-layout>    