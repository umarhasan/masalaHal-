@extends('admin.layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1>Edit Service</h1>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Service</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route('services.update', $service->id) }}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <strong>Service Details:</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $service->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description">{{ $service->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" name="price" value="{{ $service->price }}" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Credit:</label>
                            <input type="number" class="form-control" name="credit" value="{{ $service->credit }}" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="lead_service_id">Lead Service:</label>
                            <select class="form-control" name="lead_service_id" required>
                                <option value="">Select Lead Service</option>
                                @foreach ($leadServices as $leadService)
                                    <option value="{{ $leadService->id }}" {{ $service->lead_service_id == $leadService->id ? 'selected' : '' }}>{{ $leadService->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
