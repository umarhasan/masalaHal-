@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-8">
                    <h1>Why Choose Us List</h1>
                </div>

                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Why Choose Us</li>
                    </ol>
                </div>

            </div>

            <a href="{{ route('why-chooses.create') }}" class="btn btn-primary">Add New</a>
        </div>
    </section>


    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card mt-3">

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Section</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th width="180px">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($whyChooses as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->subtitle }}</td>
                                <td>{{ $item->section }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" width="70" class="rounded">
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('why-chooses.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('why-chooses.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('why-chooses.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>

                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </section>

</div>
@endsection
