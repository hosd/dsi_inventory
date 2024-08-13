<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <p>Dear {{ $user['name'] }},</p>
                <p>Congratulations! Your tyres pickup for order #{{ $order['orderRef'] }} has been successfully completed.</p>
            </td>
        </tr>
        <tr>
            <td align="left">
                <table width="100%" border="0" cellspacing="20" cellpadding="0" bgcolor="#fff" style="margin: 20px auto;">
                    <!-- Header Section -->
                    <tr>
                        <td align="left">
                            <img src="{{ url('public/dealer/images/dsi-tyres.png') }}" alt="DSI Tyres Logo">
                        </td>
                        <td align="left">
                            Samson Rubber Industries (Pvt) Ltd, Jinasena Mawatha, Mahara, Kadawatha, Sri Lanka. <br/>
                            <a style="color: #000" href="tel:+94770600601">+94770600601</a> |
                            <a style="color: #000" href="tel:+94 (0)11 2928700">+94 (0)11 2928700</a><br/>
                            <a style="color: #000;" href="mailto:dsityreshop@dsityre.lk">dsityreshop@dsityre.lk</a>
                        </td>
                    </tr>
                    <!-- Customer and Order Details Section -->
                    <tr>
                        <td align="center" colspan="2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="33%">
                                        <h4>Customer Details</h4>
                                        <strong>
                                            {{ $user['name'] }}<br/>
                                            {{ $user['AddressLine1'] }}<br/>
                                            {{ $user['AddressLine2'] }}<br/>
                                            {{ $user['AddressLine3'] }}<br/>
                                            {{ $user['mobile'] }}
                                        </strong>
                                    </td>
                                    @if($dealer)
                                        <td width="33%">
                                            <h4>Dealer Information</h4>
                                            <strong>
                                                {{ $dealer->name }}<br/>
                                                {{ $dealer->vAddressline1 }}
                                                {{ $dealer->vAddressline2 }}<br/>
                                                <a target="_blank" href="https://www.google.com/maps?q={{ $dealer->latitude }},{{ $dealer->longitude }}">Google Maps</a><br/>
                                                {{ $dealer->phone }}<br/>
                                                Opening hours : {{ $dealer->opening_hours }}<br/>
                                            </strong>
                                        </td>
                                    @endif
                                    <td width="33%">
                                        <h4>Order ID : {{ $order['orderRef'] }}</h4>
                                        @php
                                            $orderDate = \Carbon\Carbon::parse($order['orderdate']);
                                        @endphp
                                        <strong>
                                            Order Date: {{ $orderDate->format('Y-m-d') }}<br/>
                                            Payment Method : 
                                            @if($order['payment_option'] == 'cod')
                                                Cash On Delivery
                                            @else
                                                @php
                                                    $paymentOption = $order['payment_option'];
                                                    $paymentPlan = is_numeric($paymentOption) ? HeaderHelper::getPaymentPlan($paymentOption) : $paymentOption;
                                                @endphp
                                                {{ $paymentPlan }}
                                            @endif<br/>
                                            Delivery Method : {{ $order['delivery_option'] }}<br/><br/><br/><br/>
                                        </strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Order Items Section -->
                    <tr>
                        <td align="center" colspan="2">
                            <table width="100%" border="1" cellspacing="0" cellpadding="10" bgcolor="#EFEFEF">
                                <tr>
                                    <th>#</th>
                                    <th>Item Details</th>
                                    <th>Quantity</th>
                                    <th>Unit Price (LKR)</th>
                                    <th>Discount Price (LKR)</th>
                                    <th>Total (LKR)</th>
                                </tr>
                                <!-- Initialize $total before the loop -->
                                @php 
                                    $total = 0;
                                @endphp
                                <!-- Loop through order items -->
                                @foreach ($orderitem as $key => $item)
                                    @php
                                        $total = $total + $item['subtotal'];
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                    <td>{{ $item['LabelName'] }} - {{ $item['ProductCode'] }}</td>
                                    <td align="right">{{ $item['Quantity'] }}</td>
                                    <td align="right">{{ number_format($item['UnitPrice'], 2) }}&nbsp;</td>
                                    <td align="right">{{ number_format($item['discount'], 2) }}&nbsp;</td>
                                    <td align="right">{{ number_format($item['subtotal'], 2) }}&nbsp;</td>
                                    </tr>
                                @endforeach
                                @if($order['delivery_fee'] != 0)
                                <tr>
                                    <td colspan="2" align="right">Delivery Fee (LKR)</td>
                                    <td colspan="4" align="right">{{ number_format($order['delivery_fee'], 2) }}&nbsp;</td>
                                </tr>
                                @php
                                    $total = $total + $order['delivery_fee'];
                                @endphp
                                @endif
                                @if($order['cod_fee'] != 0)
                                <tr>
                                    <td colspan="2" align="right">Cash on Delivery Fee (LKR)</td>
                                    <td colspan="4" align="right">{{ number_format($order['cod_fee'], 2) }}&nbsp;</td>
                                </tr>
                                @php
                                    $total = $total + $order['cod_fee'];
                                @endphp
                                @endif
                                <tr>
                                    <td colspan="2" align="right">Grand Total (LKR)</td>
                                    <td colspan="4" align="right">{{ number_format($total, 2) }}&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    @if($dealer)
                                        <td width="33%">
                                            <h4>Pickup Details </h4>
                                            <strong>
                                                {{ $dealer->name }}<br/>
                                                {{ $dealer->vAddressline1 }}
                                                {{ $dealer->vAddressline2 }}<br/>
                                                {{ $dealer->phone }}<br/>
                                                Pickup Date: {{ $order['completeddate'] }}<br/>
                                                Pickup Time: {{ $order['completedtime'] }}<br/>
                                            </strong>
                                        </td>
                                    @endif
                                    <td width="33%"></td>
                                    <td width="33%"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <p>We hope your experience with our pickup service was smooth.</p>
                <p>If you have any feedback or further inquiries, please don't hesitate to reach out to our customer support at [<a style="color: #000;" href="mailto:dsityreshop@dsityre.lk">dsityreshop@dsityre.lk</a> / <a style="color: #000" href="tel:+94770600601">+94770600601</a>].</p>
                <p>Thank you very much.</p>
            </td>
        </tr>
    </table>
</body>
</html>
