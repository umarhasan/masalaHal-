@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Add New Flash Sale</h1>
            <a href="{{ route('flash-sales.index') }}" class="btn btn-secondary mb-2">Back</a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('flash-sales.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Start Date</label>
                            <input type="datetime-local" name="starts_at" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>End Date</label>
                            <input type="datetime-local" name="ends_at" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button class="btn btn-success">Save Flash Sale</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
