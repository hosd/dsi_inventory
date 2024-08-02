@section('title', 'Completed Order Details')
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
                        <a href="{{ route('completed-order-list') }}">
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
            </div
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
                                        <td style="width: 20%;"><b>Completed at</b></td>
                                        <td style="border-style: hidden">:&nbsp; {{ $orderinfo['completeddate'] }}</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div class="clearfix"></div>
                            <table class="table table-bordered" style="width:100%; border-style: hidden">
                                <tbody>
                                    <tr>
                                        <td align="center" bgcolor="#BECFE9" width="5%"><p>#</p></td>
                                        <td align="center" bgcolor="#BECFE9" width="50%"><p>Item Details</p></td>
                                        <td align="center" bgcolor="#BECFE9" width="5%"><p>Quantity</p></td>
                                        <td align="center" bgcolor="#BECFE9" width="13%"><p>Unit Price (LKR)</p></td>
                                        <td align="center" bgcolor="#BECFE9" width="13%"><p>Discount % </p></td>
                                        <td align="center" bgcolor="#BECFE9" width="13%"><p>Discount Price (LKR)</p></td>
                                        <td align="center" bgcolor="#BECFE9" width="13%"><p>Total (LKR)</p></td>
                                    </tr>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($productlist as $key => $item)
                                        @php
                                            $total = $total ;
                                        @endphp
                                        <tr>
                                            <td align="center" valign="top" bgcolor="#FFFFFF" style="">{{ $key + 1 }}</td>
                                            <td bgcolor="#FFFFFF" valign="middle" style="">{{ $item['LabelName'] }} - {{ $item['ProductCode'] }}</td>
                                            <td align="center" bgcolor="#FFFFFF" valign="top" style="">{{ $item['Quantity'] }}</td>
                                            <td align="right" bgcolor="#FFFFFF" valign="top" style="">{{ number_format($item['UnitPrice'], 2) }}&nbsp;</td>
                                            <td align="right" bgcolor="#FFFFFF" valign="top" style="">{{ number_format($item['discount'], 2) }}&nbsp;</td>
                                            <td align="right" bgcolor="#FFFFFF" valign="top" style="">{{ number_format($item['itemdiscount'], 2) }}&nbsp;</td>
                                            <td align="right" bgcolor="#FFFFFF" valign="top" style="">{{ number_format($item['subtotal'], 2) }}&nbsp;</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td colspan="2" align="right" valign="middle" bgcolor="#FFFFFF">Fixing Fee (LKR)</td>
                                            <td colspan="5" align="right" valign="middle" bgcolor="#FFFFFF">{{ number_format($orderinfo['fixing_fee'], 2, '.', '') }}&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="right" valign="middle" bgcolor="#FFFFFF"><h4>Grand Total (LKR)</h4></td>
                                            <td colspan="5" align="right" valign="middle" bgcolor="#FFFFFF"><h4>{{ number_format($orderinfo['ordervalue'], 2, '.', '') }}&nbsp;</h4></td>
                                        </tr>
                                </tbody>
                            </table>
                            <br>
                            <div class="clearfix"></div>
                            @if(!empty($dealerinfo))
                            <table class="table table-bordered" style="width:100%; border-style: hidden">
                                <tbody style="border-style: hidden">
                                    <tr style="border-style: hidden">
                                        <td style="width: 20%;"><b>Dealer Name</b></td>
                                        <td style="border-style: hidden">:&nbsp; {{ $dealerinfo[0]->name }}</td>
                                        
                                        <td style="width: 20%;"><b>Contact Number</b></td>
                                        <td style="border-style: hidden">:&nbsp; {{ $dealerinfo[0]->phone }}</td>
                                    </tr>
                                    <tr style="border-style: hidden">
                                        <td style="width: 20%;"><b>Dealer Address</b></td>
                                        <td style="border-style: hidden;">:&nbsp; 
                                            {{ $dealerinfo[0]->vAddressline1 }},
                                            {{ $dealerinfo[0]->vAddressline2 }},
                                            {{ $dealerinfo[0]->state }},
                                            {{ $dealerinfo[0]->city }},
                                            <br>
                                            
                                        </td>
                                        <td style="width: 20%;"><b>Opening Hours</b></td>
                                        <td style="border-style: hidden;">:&nbsp; 
                                            {{ $dealerinfo[0]->opening_hours }}<td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                            <br><br>
                        </div>
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
            $(function(){
                $('#order-form').parsley();
            });
        </script>
    </x-slot>
</x-app-layout>
