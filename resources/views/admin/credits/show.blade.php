@extends('admin.layouts.app')


@section('content')
@section('content')
    <div class="container">
        <h2>Package Details</h2>
        <p><strong>Name:</strong> {{ $package->name }}</p>
        <p><strong>Amount:</strong> {{ $package->amount }}</p>
        <p><strong>Description:</strong> {{ $package->description }}</p>
        <a href="{{ route('package.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
