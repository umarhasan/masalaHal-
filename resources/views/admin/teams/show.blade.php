@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid d-flex justify-content-between">
            <h1>Show Team Member</h1>
            <a href="{{ route('teams.index') }}" class="btn btn-primary">Back</a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card p-4">

                <div class="mb-3">
                    <strong>Name:</strong>
                    <p>{{ $team->name }}</p>
                </div>

                <div class="mb-3">
                    <strong>Role:</strong>
                    <p>{{ $team->role }}</p>
                </div>

                <div class="mb-3">
                    <strong>Facebook:</strong>
                    <p>{{ $team->facebook }}</p>
                </div>

                <div class="mb-3">
                    <strong>Twitter:</strong>
                    <p>{{ $team->twitter }}</p>
                </div>

                <div class="mb-3">
                    <strong>LinkedIn:</strong>
                    <p>{{ $team->linkedin }}</p>
                </div>

                <div class="mb-3">
                    <strong>Image:</strong><br>
                    @if($team->image)
                        <img src="{{ asset($team->image) }}" width="180" class="rounded">
                    @endif
                </div>

            </div>

        </div>
    </section>

</div>

@endsection
