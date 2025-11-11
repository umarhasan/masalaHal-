@extends('admin.layouts.app')

@section('title', 'Slider List')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Slider</h1>
                </div>
                <div class="col-sm-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Slider </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-success" href="{{ route('sliders.create') }}">Create New Slider</a>
                        </div>
                        <div class="card-body table-responsive-md">
                            <!--<table id="example" class="table table-hover table-striped align-middle no-select">-->
                                <table id="example1" class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($sliders)
                                    @php 
                                    $i = 1;
                                    @endphp
                                    @foreach($sliders as $slider)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $slider->title }}</td>
                                            <td>
                                                <span class="short-desc">{{ Str::limit($slider->description, 30, '...') }}</span>
                                                <span class="full-desc d-none">{{ $slider->description }}</span>
                                                <a href="javascript:void(0);" class="read-more text-primary" onclick="toggleDescription(this)">More</a>
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" width="100">
                                            </td>
                                             <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                        
                                                        <a class="dropdown-item" href="{{ route('sliders.edit', $slider->id) }}"
                                                        ><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item"><i class="bx bx-trash-alt me-1"></i> Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                 <tfoot>
                                  <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                  </tr>
                                  </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function toggleDescription(element) {
        let shortDesc = element.previousElementSibling.previousElementSibling;
        let fullDesc = element.previousElementSibling;
        
        if (fullDesc.classList.contains('d-none')) {
            fullDesc.classList.remove('d-none');
            shortDesc.classList.add('d-none');
            element.innerText = "Less";
        } else {
            fullDesc.classList.add('d-none');
            shortDesc.classList.remove('d-none');
            element.innerText = "More";
        }
    }
</script>
@endsection
