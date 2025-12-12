@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Flash Sale Details</h1>
        <a href="{{ route('flash-sales.index') }}" class="btn btn-secondary mb-2">Back</a>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td>{{ $flashSale->title }}</td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{ \Carbon\Carbon::parse($flashSale->starts_at)->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>{{ \Carbon\Carbon::parse($flashSale->ends_at)->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $flashSale->is_active ? 'Active' : 'Inactive' }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $flashSale->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $flashSale->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
