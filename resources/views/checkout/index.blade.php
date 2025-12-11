@extends('layouts.app')
@section('title','Checkout')

@section('content')
<h3>Checkout</h3>

<form action="{{ route('checkout.place') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Shipping Address</label>
        <textarea name="shipping_address" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Billing Address (optional)</label>
        <textarea name="billing_address" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Payment Method</label>
        <select name="payment_method" class="form-control" required>
            <option value="cod">Cash on Delivery</option>
            <option value="bank">Bank Transfer</option>
            <option value="card">Card Payment</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Place Order</button>
</form>
@endsection
