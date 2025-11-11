@extends('admin.layouts.app')

@section('title', 'Create Multiple Services')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1>Add Services</h1>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Services</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route('services.store') }}" id="servicesForm">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-info" onclick="addServiceForm()">
                            <i class="fas fa-plus-circle"></i> Add Service
                        </button>
                    </div>
                    <div class="card-body" id="serviceFormsContainer">
                        <div class="row form-group service-form align-items-end">
                            <div class="col-md-2">
                                <label for="lead_service_id[]">Lead Service:</label>
                                <select class="form-control" name="lead_service_id[]">
                                    <option value="">Select Lead Service</option>
                                    @foreach ($leadServices as $leadService)
                                        <option value="{{ $leadService->id }}">{{ $leadService->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="name[]">Name:</label>
                                <input type="text" class="form-control" name="name[]" required>
                            </div>
                            <div class="col-md-3">
                                <label for="description[]">Description:</label>
                                <textarea class="form-control" name="description[]"></textarea>
                            </div>
                            <div class="col-md-2">
                                <label for="price[]">Price ($):</label>
                                <input type="number" class="form-control" name="price[]" step="0.01" required>
                            </div>
                            <div class="col-md-2">
                                <label for="credit[]">Credit ($):</label>
                                <input type="number" class="form-control" name="credit[]" step="0.01">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger" onclick="removeServiceForm(this)">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Submit All Services
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
function addServiceForm() {
    var container = document.getElementById('serviceFormsContainer');
    var newForm = container.firstElementChild.cloneNode(true);
    newForm.querySelectorAll('input, select, textarea').forEach(input => input.value = '');
    container.appendChild(newForm);
    newForm.querySelector('input').focus(); // Focus on the first input of the new form for user convenience
}

function removeServiceForm(element) {
    if (document.querySelectorAll('.service-form').length > 1) {
        element.closest('.service-form').remove();
    } else {
        alert('You must have at least one service form.');
    }
}
</script>
@endsection
