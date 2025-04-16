<!DOCTYPE html>
<html>
<head>
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .invoice-container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .company-info { text-align: right; }
        .invoice-details { margin: 20px 0; }
        .customer-info, .order-info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <div>
                <h1>INVOICE</h1>
                <p>Order #: {{ $order->order_number }}</p>
            </div>
            <div class="company-info">
                <h2>SmartShop</h2>
                <p>el kef<br>
                el kef,  tunisie<br>
                VAT: XXXXXXXX</p>
            </div>
        </div>

        <div class="invoice-details">
            <div class="customer-info">
                <h3>Bill To:</h3>
                <p>{{ $order->customer_first_name }} {{ $order->customer_last_name }}<br>
                {{ $order->customer_email }}<br>
                {{ $order->customer_phone ?? '' }}</p>
                <p>
                    {{ $order->delivery_street }}<br>
                    {{ $order->delivery_city }}, {{ $order->delivery_zip_code }}<br>
                    {{ $order->delivery_country }}
                </p>
            </div>

            <div class="order-info">
                <p><strong>Invoice Date:</strong> {{ now()->format('Y-m-d') }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Product' }}</td>
                    <td>{{ number_format($item->price, 2) }} DT</td>
                    <td>{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->price * $item->quantity, 2) }} DT</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-right">Subtotal:</td>
                    <td class="text-right">{{ number_format($order->subtotal, 2) }} DT</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Delivery Cost:</td>
                    <td class="text-right">{{ number_format($order->delivery_cost, 2) }} DT</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Tax:</td>
                    <td class="text-right">{{ number_format($order->tax_amount, 2) }} DT</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" class="text-right">Total:</td>
                    <td class="text-right">{{ number_format($order->total, 2) }} DT</td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>If you have any questions about this invoice, please contact our support team.</p>
        </div>
    </div>
</body>
</html>
