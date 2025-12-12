@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Your Cart</h2>
    @if($cart->items->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart->items as $item)
                    @php $subtotal = $item->price * $item->quantity; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td><img src="{{ $item->product->image ? asset('uploads/products/'.$item->product->image) : 'https://via.placeholder.com/50' }}" width="50"></td>
                        <td>Rs. {{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs. {{ $subtotal }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td><strong>Rs. {{ $total }}</strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceed to Checkout</a>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
