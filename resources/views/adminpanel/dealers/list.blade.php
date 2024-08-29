@section('title', 'Dealers')

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
            
        </style>
    </x-slot>

    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon"></div>
        <!-- END RIBBON -->
        <div id="content">
            <div class="row">
            <div class="col-lg-12">
                    <div class="row cms_top_btn_row" style="margin-left:auto;margin-right:auto;"> 
                        <a href="{{ route('new-dealers') }}">
                            <button class="btn cms_top_btn top_btn_height ">ADD NEW DEALER </button>
                        </a>

                        <a href="{{ route('dealers-list') }}">
                            <button class="btn cms_top_btn top_btn_height cms_top_btn_active">VIEW ALL DEALERS <br> {{count($count)}}</button>
                        </a>
                    </div>
                </div>
            </div>
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
                                    <div class="row">
                                    <section class="col col-4">
                                        <label class="label">Dealer Type</label>
                                            <select class="select2" name="type_id[]" id="type_id" required="" multiple>
                                                <option value=""></option>
                                                @foreach($types as $row)
                                                <option value="{{  $row->id }}"> {{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            <i></i>
                                        </section>
                                    </div>
                                </fieldset>
                                <footer class="col col-10">
                                    <button id="button1id" name="button1id" type="submit"class="btn btn-primary">
                                        Search
                                    </button>
                                    <a href="{{ route('dealers-list') }}">
                                        <button name="reset" id="reset" type="button" class="btn btn-default"> Clear</button>
                                    </a>

                                </footer>
                            </form>
                        </div>
                    </article>
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->

                        <div class="jarviswidget jarviswidget-color-darken" id="user_types" data-widget-editbutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Dealers List</h2>
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
                                    <table class="table table-bordered data-table" width="100%">
                                        <thead>
                                            <tr >
                                                <th width="4%">No</th>
                                                <th width="10%">Dealer Name</th>
                                                <th width="10%">Type</th>    
                                                <th width="10%">Code</th>
                                                <th width="10%">Email</th>
                                                <th width="10%">Phone Number</th>
                                                
                                                <th width="10%">Territory</th>
                                                <th width="10%">Town</th>
                                                <th width="10%">Status</th>
                                                <th width="4%">Edit</th>
                                                <th width="4%" align="center" >Activation</th>
                                                <th width="4%" align="center" >Users</th>
                                                <th width="4%" align="center" >Pay Commission</th>
                                                <th width="4%" align="center" >Stock Upload</th>
                                                <th width="4%">Delete</th>
                                                <!-- <th width="4%" align="center" >Paid Total Commission</th> -->
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
        <script type="text/javascript">
            $(function() {

                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        url: "{{ route('dealers-list') }}",
                       
                        data: function (d) {
                            
                            d.type_id = $('#type_id').val();
                        }
                    },
                    order: [ 1, 'asc' ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'type_name',
                            name: 'type_name'
                        },
                        {
                            data: 'dealercode',
                            name: 'dealercode'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        
                        {
                            data: 'state',
                            name: 'state'
                        },
                        {
                            data: 'city',
                            name: 'city'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        
                        {
                            data: 'edit',
                            name: 'edit',
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
                        {
                             data: 'users',
                            name: 'users',
                            "className": "text-center",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'commission',
                            name: 'commission',
                            "className": "text-center",
                            orderable: false,
                            searchable: false
                        },
                        // {
                        //     data: 'total_paid',
                        //     name: 'total_paid'
                        // },
                        {
                            data: 'stock',
                            name: 'stock',
                            "className": "text-center",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'blockdealer',
                            name: 'blockdealer',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                $('#search-form').on('submit', function(e) {
                    table.draw();
                    e.preventDefault();
                });

                $('#reset').click(function(){
                    $("#type_id").val(null).trigger('change');
                    table.draw();
                    e.preventDefault();
                });

            });
        </script>
    </x-slot>
</x-app-layout>
