@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>Edit Why Choose Us</h1>
                </div>

                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Why Choose</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>


    <section class="content">
        <div class="container-fluid">

            <div class="card p-4">

                <form action="{{ route('why-chooses.update', $whyChoose->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $whyChoose->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ $whyChoose->subtitle }}">
                    </div>

                    <div class="mb-3">
                        <label>Section</label>
                        <input type="text" name="section" class="form-control" value="{{ $whyChoose->section }}">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{ $whyChoose->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">

                        @if($whyChoose->image)
                            <div class="mt-2">
                                <img src="{{ asset($whyChoose->image) }}" width="100" class="rounded">
                            </div>
                        @endif
                    </div>

                    <button class="btn btn-success">Update</button>

                </form>

            </div>

        </div>
    </section>

</div>
@endsection
