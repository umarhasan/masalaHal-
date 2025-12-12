@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Order Details</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <h4>Order Info</h4>
                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                <p><strong>User:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total,2) }}</p>

                <h4 class="mt-3">Shipping Address</h4>
                <p>{!! nl2br($order->shipping_address) !!}</p>

                <h4 class="mt-3">Billing Address</h4>
                <p>{!! nl2br($order->billing_address) !!}</p>

                <h4 class="mt-3">Items</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Variant</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
<tr>
    <td>{{ $item->product->name }}</td>
    <td>
        @if(!empty($item->product->images))
            <img src="{{ asset('uploads/products/'.$item->product->images[0]) }}" width="60">
        @endif
    </td>
    <td>
        @if($item->variant)
            Color: {{ $item->variant->color?->color_name ?? 'N/A' }}, Size: {{ $item->variant->size?->size ?? 'N/A' }}
        @else
            N/A
        @endif
    </td>
    <td>{{ $item->quantity }}</td>
    <td>${{ number_format($item->unit_price,2) }}</td>
    <td>${{ number_format($item->total,2) }}</td>
</tr>
@endforeach
                    </tbody>
                </table>

                <h4 class="mt-3">Order Summary</h4>
                <p><strong>Sub Total:</strong> ${{ number_format($order->sub_total,2) }}</p>
                <p><strong>Shipping:</strong> ${{ number_format($order->shipping,2) }}</p>
                <p><strong>Tax:</strong> ${{ number_format($order->tax,2) }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total,2) }}</p>
            </div>
        </div>
    </section>
</div>
@endsection
