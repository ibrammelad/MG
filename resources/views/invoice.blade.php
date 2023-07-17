<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        .invoice {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .invoice h1 {
            font-size: 24px;
            font-weight: normal;
            margin: 0 0 10px 0;
        }
        .invoice p {
            margin: 0;
        }
        .invoice table {
            border-collapse: collapse;
            width: 100%;
        }
        .invoice table th, .invoice table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        .invoice table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="invoice">
    <h1>Invoice</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Date: {{ $order->created_at }}</p>
    <table>
        <thead>
        <tr>
            <th>Item</th>
            <th>amount_to_pay</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($order->orderDetails as $orderDetail)
            <tr>
                <td>{{ $orderDetail->meal->description }}</td>
                <td>{{ $orderDetail->amount_to_pay }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td>{{ $order->total }}</td>
        </tr>
        </tfoot>
    </table>
</div>
</body>
</html>
