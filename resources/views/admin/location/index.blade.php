@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="search-box mb-3">
            <form method="POST" action="{{ route('location.search') }}" class="d-flex w-100">
                @csrf
                <input type="text" name="query" id="place-search" placeholder="Search places (e.g., school)..." class="form-control" required>
                <button class="btn btn-primary ml-2" type="submit">Search</button>
            </form>
        </div>
       <div class="card-body table-responsive-md">
             <table id="example1" class="table table-hover table-striped align-middle no-select">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Website</th>
                </tr>
            </thead>
            <tbody>
                <?php  $i = 1; ?>
                @foreach ($places as $place)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $place['name'] }}</td>
                    <td>{{ $place['address'] }}</td>
                    <td><a href="https://wa.me/{{ $place['phone'] }}">{{ $place['phone'] }}</a></td>
                    <td>
                        @if ($place['website'] && $place['website'] !== 'N/A')
                            <a href="{{ $place['website'] }}" target="_blank">{{ $place['website'] }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        
    </div>
</div>
@endsection
