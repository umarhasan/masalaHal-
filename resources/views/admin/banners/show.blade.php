@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10"><h1>Banner Details</h1></div>
                <div class="col-sm-2 text-right">
                    <a href="{{ route('banners.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group"><strong>Title:</strong> {{ $banner->title }}</div>
                    <div class="form-group">
                        <strong>Image:</strong>
                        @if($banner->image)
                            <br>
                            <img src="{{ asset('uploads/banners/'.$banner->image) }}" width="120">
                        @else
                            N/A
                        @endif
                    </div>
                    <div class="form-group"><strong>Link:</strong> {{ $banner->link }}</div>
                    <div class="form-group"><strong>Status:</strong> {{ $banner->status ? 'Active' : 'Inactive' }}</div>
                    <div class="form-group"><strong>Created At:</strong> {{ $banner->created_at->format('d M, Y') }}</div>
                    <div class="form-group"><strong>Updated At:</strong> {{ $banner->updated_at->format('d M, Y') }}</div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
