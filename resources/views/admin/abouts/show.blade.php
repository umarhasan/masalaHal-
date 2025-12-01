@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Show About</h1>
        <a href="{{ route('abouts.index') }}" class="btn btn-primary mb-2">Back</a>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div><strong>Title:</strong> {{ $about->title }}</div>
                <div><strong>Description:</strong> {{ $about->description }}</div>
                <div>
                    <strong>Image:</strong>
                    @if($about->image)
                        <img src="{{ asset('storage/'.$about->image) }}" width="150">
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
