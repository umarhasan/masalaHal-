@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Checkout</h2>
    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Shipping Address</label>
            <textarea name="shipping_address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" class="form-control" required>
                <option value="cod">Cash on Delivery</option>
                <option value="bank">Bank Transfer</option>
            </select>
        </div>

        <h4>Order Summary</h4>
        <ul class="list-group mb-3">
            @php $total = 0; @endphp
            @foreach($cart->items as $i)
                @php $subtotal = $i->price * $i->quantity; $total += $subtotal; @endphp
                <li class="list-group-item d-flex justify-content-between">
                    {{ $i->product->name }} (x{{ $i->quantity }})
                    <span>Rs. {{ $subtotal }}</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
                <strong>Total</strong>
                <strong>Rs. {{ $total }}</strong>
            </li>
        </ul>

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection
