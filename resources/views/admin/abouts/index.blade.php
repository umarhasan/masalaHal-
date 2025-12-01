@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Abouts</h1>
        <a class="btn btn-success" href="{{ route('abouts.create') }}">New About</a>
    </section>
    <br/>
    <section class="content">
        <div class="card">
        <div class="card-body">
        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($abouts as $key => $about)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $about->title }}</td>
                        <td>{{ $about->description }}</td>
                        <td>
                            @if($about->image)
                                <img src="{{ asset('storage/'.$about->image) }}" width="80">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('abouts.show',$about->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('abouts.edit',$about->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('abouts.destroy',$about->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        </div>
    </section>
</div>
@endsection
