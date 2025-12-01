@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Team Member</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card p-4">

                <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   value="{{ $team->name }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" name="role"
                                   class="form-control"
                                   value="{{ $team->role }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">

                            @if($team->image)
                                <img src="{{ asset($team->image) }}" width="80" class="mt-2 rounded">
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="url" name="facebook" class="form-control"
                                   value="{{ $team->facebook }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Twitter</label>
                            <input type="url" name="twitter" class="form-control"
                                   value="{{ $team->twitter }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">LinkedIn</label>
                            <input type="url" name="linkedin" class="form-control"
                                   value="{{ $team->linkedin }}">
                        </div>

                    </div>

                    <button class="btn btn-success">Update</button>

                </form>

            </div>

        </div>
    </section>

</div>

@endsection
