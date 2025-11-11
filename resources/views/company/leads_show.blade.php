@extends('company.layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="{{ asset('assets/css/lead.css') }}" rel="stylesheet">
@section('content')
<div class="content-wrapper no-select">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9"></div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Leads / Information</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="lead-list">
                        <div class="details-panel lead-card"
                            data-name="{{ strtolower($lead->name) }}"
                            data-location="{{ strtolower($lead->address) }}"
                            data-service="{{ strtolower($lead->service->name ?? '') }}"
                            data-lead-service="{{ strtolower($lead->service->leadService->name ?? '') }}"
                            data-status="{{ $lead->status === NULL ? 'null' : $lead->status }}"
                            data-budget="{{ strtolower($lead->budget) }}">
                            <div class="details-header">
                                <h5>{{ $lead->name }} - {{ isset($lead->service->leadService) ? $lead->service->leadService->name : 'No Service' }}</h5>
                            </div>
                            <hr>
                            <div class="lead-details">
                                <p><strong>Location:</strong> <i class="fas fa-map-marker-alt icon"></i> {{ $lead->address }}</p>
                                <p>
                                    <strong>Contact:</strong>
                                    <i class="fas fa-phone-alt icon"></i>
                                    <span>
                                        @if($lead->status == 1)
                                            {{ $lead->phone }} <!-- Show full phone number -->
                                        @else
                                            {{ '+' . substr($lead->phone, 1, 3) }}xxx-xx-{{ substr($lead->phone, -2, 1) }}-xx
                                        @endif
                                    </span> |
                                    <i class="fas fa-envelope icon"></i>
                                    <span>
                                        @if($lead->status == 1)
                                            {{ $lead->email }} <!-- Show full email -->
                                        @else
                                            {{ substr($lead->email, 0, 2) }}xxxx{{ substr(strrchr($lead->email, "@"), 0) }}
                                        @endif
                                    </span>
                                </p>
                                <p><strong>Average Value:</strong> {{ $lead->budget }}</p>
                                <p><strong>Status:</strong>
                                    @if($lead->status == 1)
                                        Pick
                                    @else
                                        Not Pick
                                    @endif
                                </p>
                                <p><strong>Details:</strong></p>
                                <ul>
                                    <li><strong>Business:</strong> {{ $lead->business }}</li>
                                    <li><strong>Need:</strong> {{ $lead->need }}</li>
                                    <li><strong>Industry:</strong> {{ $lead->industry }}</li>
                                    <li><strong>Live Website:</strong> {{ $lead->live_website }}</li>
                                </ul>
                                <p><strong>Credit:</strong> {{ $lead->service->credit ?? 'No Credit' }}</p>
                                <div>
                                    @if($lead->status === NULL)
                                        <button class="btn btn-primary">
                                            <a href="{{ route('company.lead_pick', $lead->id) }}">
                                                <span style="color:white">{{ $lead->name }}</span>
                                            </a>
                                        </button>
                                        <button class="btn btn-secondary btn-not-interested">
                                            <a href="{{ route('company.lead_not_pick', $lead->id) }}">
                                                <span style="color:white">Not interested</span>
                                            </a>
                                        </button>
                                    @elseif($lead->status === 1)
                                        <button class="btn btn-warning">
                                            <a href="#">
                                                <span style="color:white">Picked</span>
                                            </a>
                                        </button>
                                    @elseif($lead->status === 0)
                                        <button class="btn btn-danger">
                                            <a href="#">
                                                <span style="color:white">Not Picked</span>
                                            </a>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>
<script src="{{ asset('assets/js/lead.js')}}"></script>
@endsection
