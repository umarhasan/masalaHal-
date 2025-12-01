@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Add Team Member</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card p-4">

                <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" name="role" class="form-control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="url" name="facebook" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Twitter</label>
                            <input type="url" name="twitter" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">LinkedIn</label>
                            <input type="url" name="linkedin" class="form-control">
                        </div>

                    </div>

                    <button class="btn btn-success">Save Member</button>

                </form>

            </div>

        </div>
    </section>

</div>

@endsection
