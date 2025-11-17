@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Why Choose Us</h1>
        <a class="btn btn-success" href="{{ route('why_chooses.create') }}">New Item</a>
    </section>

    <section class="content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @if($item->icon)
                                <img src="{{ asset('storage/'.$item->icon) }}" width="50">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('why_chooses.show',$item->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('why_chooses.edit',$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('why_chooses.destroy',$item->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
