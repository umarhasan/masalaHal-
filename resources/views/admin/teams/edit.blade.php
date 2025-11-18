@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($team) ? 'Edit' : 'Add' }} Team Member</h1>

    <form action="{{ isset($team) ? route('teams.update', $team->id) : route('teams.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($team))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $team->name ?? old('name') }}" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <input type="text" name="role" class="form-control" value="{{ $team->role ?? old('role') }}">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if(isset($team) && $team->image)
                <img src="{{ asset($team->image) }}" width="50" class="mt-2">
            @endif
        </div>

        <div class="mb-3">
            <label>Facebook</label>
            <input type="url" name="facebook" class="form-control" value="{{ $team->facebook ?? old('facebook') }}">
        </div>

        <div class="mb-3">
            <label>Twitter</label>
            <input type="url" name="twitter" class="form-control" value="{{ $team->twitter ?? old('twitter') }}">
        </div>

        <div class="mb-3">
            <label>LinkedIn</label>
            <input type="url" name="linkedin" class="form-control" value="{{ $team->linkedin ?? old('linkedin') }}">
        </div>

        <button type="submit" class="btn btn-success">{{ isset($team) ? 'Update' : 'Save' }}</button>
    </form>
</div>
@endsection
