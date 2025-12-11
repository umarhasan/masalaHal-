@extends('layouts.app')
@section('title','Cart')

@section('content')
<h3>Shopping Cart</h3>

@if($cart->items->isEmpty())
<p>Your cart is empty.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $grand=0; @endphp
        @foreach($cart->items as $item)
        @php $total = $item->quantity*$item->price; $grand+=$total; @endphp
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>${{ $item->price }}</td>
            <td>${{ $total }}</td>
            <td>
                <form action="{{ route('cart.remove',$item->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">Remove</button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3"><strong>Grand Total</strong></td>
            <td colspan="2"><strong>${{ $grand }}</strong></td>
        </tr>
    </tbody>
</table>
<a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
@endif
@endsection
