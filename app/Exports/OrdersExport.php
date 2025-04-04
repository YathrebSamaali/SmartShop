<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Order::with(['orderItems'])
                ->latest()
                ->get();
    }

    public function headings(): array
    {
        return [
            'Order Number',
            'Customer Name',
            'Email',
            'Phone',
            'Address',
            'City',
            'Zip Code',
            'Country',
            'Total Amount',
            'Status',
            'Payment Method',
            'Delivery Method',
            'Order Date',
            'Items Count'
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_number,
            $order->customer_first_name.' '.$order->customer_last_name,
            $order->customer_email,
            $order->customer_phone,
            $order->delivery_street,
            $order->delivery_city,
            $order->delivery_zip_code,
            $order->delivery_country,
            number_format($order->total, 2),
            ucfirst($order->status),
            ucfirst(str_replace('_', ' ', $order->payment_method)),
            $order->delivery_method ?? 'Standard',
            $order->created_at->format('Y-m-d H:i:s'),
            $order->orderItems->count()
        ];
    }
}
