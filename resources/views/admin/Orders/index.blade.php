@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Orders</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Number</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>${{ number_format($order->total,2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="form-control form-control-sm">
                                        @foreach(['pending','processing','shipped','delivered','cancelled','refunded'] as $status)
                                            <option value="{{ $status }}" @if($order->status == $status) selected @endif>{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
