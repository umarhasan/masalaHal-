@extends('admin.layouts.app')

@section('title', 'View Service Details')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1>View Service Details</h1>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Service List</a></li>
                        <li class="breadcrumb-item active">View Service</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Service Information</h3>
                    <div class="card-tools">
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary">Edit Service</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <p>{{ $service->name }}</p>
                            </div>
                            <div class="form-group">
                                <strong>Description:</strong>
                                <p>{{ $service->description }}</p>
                            </div>
                            <div class="form-group">
                                <strong>Price:</strong>
                                <p>${{ number_format($service->price, 2) }}</p>
                            </div>
                            <div class="form-group">
                                <strong>Lead Service:</strong>
                                <p>{{ $service->leadService->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
