@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Bulk Update Services</h1>

    <form action="{{ route('admin.services.bulkUpdate') }}" method="POST">
        @csrf
        @method('PUT')
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Credit</th>
                    <th>Lead Service</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <input type="hidden" name="services[{{ $service->id }}][id]" value="{{ $service->id }}">
                    <td>
                        <input type="text" name="services[{{ $service->id }}][name]" value="{{ $service->name }}" class="form-control" required>
                    </td>
                    <td>
                        <textarea name="services[{{ $service->id }}][description]" class="form-control">{{ $service->description }}</textarea>
                    </td>
                    <td>
                        <input type="number" name="services[{{ $service->id }}][price]" value="{{ $service->price }}" class="form-control" required>
                    </td>
                    <td>
                        <input type="number" name="services[{{ $service->id }}][credit]" value="{{ $service->credit }}" class="form-control" required>
                    </td>
                    <td>
                        <select name="services[{{ $service->id }}][lead_service_id]" class="form-control" required>
                            @foreach($leadServices as $leadService)
                                <option value="{{ $leadService->id }}" {{ $service->lead_service_id == $leadService->id ? 'selected' : '' }}>
                                    {{ $leadService->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Update All</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
