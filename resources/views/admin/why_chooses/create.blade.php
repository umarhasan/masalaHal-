@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>Add Why Choose Us</h1>
                </div>

                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Why Choose</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>


    <section class="content">
        <div class="container-fluid">

            <div class="card p-4">

                <form action="{{ route('why-chooses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Section</label>
                        <input type="text" name="section" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <button class="btn btn-success">Save</button>

                </form>

            </div>

        </div>
    </section>

</div>
@endsection
