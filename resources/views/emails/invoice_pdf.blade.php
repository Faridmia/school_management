<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #555;
            margin: 0;
            padding: 0;
            font-size: 14px;
            line-height: 1.5;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            background-color: #fff;
        }
        .header-table, .addresses-table, .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            vertical-align: top;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }
        .text-right {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        .addresses-table td {
            width: 50%;
            padding: 10px;
            border: 1px solid #eee;
            vertical-align: top;
        }
        .address-header {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
            background-color: #f9f9f9;
            padding: 5px;
            border-bottom: 1px solid #eee;
        }
        .items-table th {
            background-color: #f9f9f9;
            border-bottom: 2px solid #ddd;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            color: #333;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .summary-table {
            width: 40%;
            float: right;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #eee;
        }
        .summary-table .total-row {
            font-weight: bold;
            font-size: 16px;
            color: #c96;
            border-top: 2px solid #ddd;
        }
        .clearfix {
            clear: both;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <!-- Header Section -->
        <table class="header-table">
            <tr>
                <td class="title">
                    {{ $systemSettings->website_name ?? 'E-Commerce' }}
                </td>
                <td class="text-right">
                    <span class="bold">Invoice:</span> #{{ $order->order_number }}<br>
                    <span class="bold">Date:</span> {{ date('d-m-Y', strtotime($order->created_at)) }}<br>
                    <span class="bold">Status:</span> {{ strtoupper($order->status) }}
                </td>
            </tr>
        </table>

        <!-- Addresses -->
        <table class="addresses-table">
            <tr>
                <td>
                    <div class="address-header">Billing Details</div>
                    {{ $order->billing_first_name }} {{ $order->billing_last_name }}<br>
                    @if(!empty($order->billing_company))
                        {{ $order->billing_company }}<br>
                    @endif
                    {{ $order->billing_address_1 }}<br>
                    @if(!empty($order->billing_address_2))
                        {{ $order->billing_address_2 }}<br>
                    @endif
                    Postcode: {{ $order->billing_postcode }}<br>
                    Phone: {{ $order->billing_phone }}<br>
                    Email: {{ $order->billing_email }}
                </td>
                <td>
                    <div class="address-header">Shipping Details</div>
                    @if($order->shipping_first_name)
                        {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                        @if(!empty($order->shipping_company))
                            {{ $order->shipping_company }}<br>
                        @endif
                        {{ $order->shipping_address_1 }}<br>
                        @if(!empty($order->shipping_address_2))
                            {{ $order->shipping_address_2 }}<br>
                        @endif
                        Postcode: {{ $order->shipping_postcode }}<br>
                        Phone: {{ $order->shipping_phone }}
                    @else
                        Same as billing details.
                    @endif
                </td>
            </tr>
        </table>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Price</th>
                    <th style="text-align: center;">Quantity</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            {{ $item->product_name }}
                            @php
                                $attributes = [];
                                if(!empty($item->size)) {
                                    $attributes[] = 'Size: ' . $item->size->name;
                                }
                                if(!empty($item->color)) {
                                    $attributes[] = 'Color: ' . $item->color->name;
                                }
                            @endphp
                            @if(count($attributes) > 0)
                                <br><span style="color: #777; font-size: 11px;">({{ implode(' | ', $attributes) }})</span>
                            @endif
                        </td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td class="text-right">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals Summary -->
        <table class="summary-table">
            <tr>
                <td>Subtotal:</td>
                <td class="text-right">${{ number_format($order->subtotal, 2) }}</td>
            </tr>
            @if($order->discount > 0)
                <tr>
                    <td>Discount:</td>
                    <td class="text-right">-${{ number_format($order->discount, 2) }}</td>
                </tr>
            @endif
            @if($order->shipping_charge > 0)
                <tr>
                    <td>Shipping:</td>
                    <td class="text-right">${{ number_format($order->shipping_charge, 2) }}</td>
                </tr>
            @endif
            @if($order->tax_amount > 0)
                <tr>
                    <td>Tax/VAT:</td>
                    <td class="text-right">${{ number_format($order->tax_amount, 2) }}</td>
                </tr>
            @endif
            <tr class="total-row">
                <td>Total:</td>
                <td class="text-right">${{ number_format($order->total, 2) }}</td>
            </tr>
        </table>
        <div class="clearfix"></div>

        <!-- Footer -->
        <div class="footer">
            Thank you for shopping with us! If you have any questions, please contact support at {{ $systemSettings->submit_email ?? 'support@ecommerce.com' }}
        </div>
    </div>
</body>
</html>
