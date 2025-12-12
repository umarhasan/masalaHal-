@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Flash Sales</h1>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('flash-sales.create') }}" class="btn btn-success float-right">Add Flash Sale</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($flashSales as $flash)
                            <tr>
                                <td>{{ $flash->id }}</td>
                                <td>{{ $flash->title }}</td>
                                <td>{{ $flash->starts_at }}</td>
                                <td>{{ $flash->ends_at }}</td>
                                <td>{{ $flash->is_active ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('flash-sales.edit', $flash->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('flash-sales.destroy', $flash->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $flashSales->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
