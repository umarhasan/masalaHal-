@extends('admin.layouts.app')

@section('title', 'View Lead Service Details')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1>View Lead Service Details</h1>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('lead-services.index') }}">Lead Services List</a></li>
                        <li class="breadcrumb-item active">View Lead Service</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lead Service Information</h3>
                    <div class="card-tools">
                        <a href="{{ route('lead-services.edit', $leadService->id) }}" class="btn btn-primary">Edit Lead Service</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <p>{{ $leadService->name }}</p>
                            </div>
                            <div class="form-group">
                                <strong>Description:</strong>
                                <p>{{ $leadService->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('lead-services.index') }}" class="btn btn-default">Back to List</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
