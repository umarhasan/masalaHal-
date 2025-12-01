@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1>Show Why Choose Us</h1>
                </div>

                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Show Why Choose</li>
                    </ol>
                </div>
            </div>

            <a href="{{ route('why-chooses.index') }}" class="btn btn-primary mb-3">Back</a>

        </div>
    </section>


    <section class="content">
        <div class="container-fluid">

            <div class="card p-4">

                <div class="mb-3">
                    <strong>Title:</strong>
                    <p>{{ $whyChoose->title }}</p>
                </div>

                <div class="mb-3">
                    <strong>Subtitle:</strong>
                    <p>{{ $whyChoose->subtitle }}</p>
                </div>

                <div class="mb-3">
                    <strong>Section:</strong>
                    <p>{{ $whyChoose->section }}</p>
                </div>

                <div class="mb-3">
                    <strong>Description:</strong>
                    <p>{{ $whyChoose->description }}</p>
                </div>

                <div class="mb-3">
                    <strong>Image:</strong><br>
                    @if($whyChoose->image)
                        <img src="{{ asset($whyChoose->image) }}" width="120" class="rounded">
                    @endif
                </div>

            </div>

        </div>
    </section>

</div>
@endsection
