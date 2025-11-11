@extends('company.layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="{{ asset('assets/css/lead.css') }}" rel="stylesheet">
<style>
/* Notification Container Styling */
#notifications {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999; 
    max-width: 300px;
    display: flex;
    flex-direction: column;
    gap: 10px; 
}

/* Notification Box Styling */
.notification {
    position: relative;
    padding: 10px 15px;
    border-radius: 8px;
    background-color: #333; /* Black background for notifications */
    color: white; /* White text for contrast */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: space-between;
    animation: fadeInUp 0.5s ease-in-out;
    border: 1px solid #555;
}

.notification-link {
    text-decoration: none;
    color: #fff; /* White text for links */
    flex-grow: 1;
}

.notification-link:hover {
    text-decoration: underline;
    color: #007bff;
}

.close-btn {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
}

/* Animation for fade-in effect */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@section('content')
            <div class="container">
               <div id="notifications"></div>
                <div class="row">
                    <!-- Sidebar for filters -->
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-user icon"></i> Search by Name</label>
                                    <input type="text" class="form-control" id="nameSearch" placeholder="Enter name" onkeyup="filterLeads()">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-city icon"></i> Search by City</label>
                                    <input type="text" class="form-control" id="citySearch" placeholder="Enter city" onkeyup="filterLeads()">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-globe icon"></i> Search by Country</label>
                                    <input type="text" class="form-control" id="countrySearch" placeholder="Enter country" onkeyup="filterLeads()">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-map-marker icon"></i> Search by State</label>
                                    <input type="text" class="form-control" id="stateSearch" placeholder="Enter state" onkeyup="filterLeads()">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-map-pin icon"></i> Search by Zip Code</label>
                                    <input type="text" class="form-control" id="zipCodeSearch" placeholder="Enter zip code" onkeyup="filterLeads()">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-briefcase icon"></i> Filter by Service</label>
                                    <select id="serviceFilter" class="form-select" onchange="filterLeads()">
                                        <option value="">Select Service</option>
                                        @foreach($service as $srv)
                                            <option value="{{ strtolower($srv->name) }}">{{ $srv->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-briefcase icon"></i> Filter by Lead Service</label>
                                    <select id="leadServiceFilter" class="form-select" onchange="filterLeads()">
                                        <option value="">Select Lead Service</option>
                                        @foreach($lead_service as $lsrv)
                                            <option value="{{ strtolower($lsrv->name) }}">{{ $lsrv->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-filter icon"></i> Filter by Status</label>
                                    <select id="statusFilter" class="form-select" onchange="filterLeads()">
                                        <option value="">Select Status</option>
                                        <option value="null">Pending</option>
                                        <option value="1">Picked</option>
                                        <option value="0">Not Picked</option>
                                    </select>
                                </div>
                                <!-- Budget Dropdown -->
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-money-bill-wave"></i> Filter by Budget</label>
                                    <input type="text" class="form-control" id="budgetSearch" placeholder="Enter Budget" onkeyup="filterLeads()">
                                </div>
                                <button class="btn btn-danger w-100" onclick="clearFilters()">Clear Filters</button>
                            </div>
                        </div>
                    </div>
                    <!-- Main content for lead details -->
                    <div class="col-md-8">
                        <div class="header mb-4 d-flex justify-content-between align-items-center">
                            <!-- Total Leads Section -->
                            <div>
                                <strong>Showing {{ $filteredLeadsCount }} Leads</strong>
                            </div>
                            <!-- Records per page Section -->
                            <div>
                                <label class="form-label">Records per page:</label>
                                <select id="recordsPerPage" class="form-select" onchange="updateRecordsPerPage()">
                                    <option value="0" {{ request('per_page') == 0 ? 'selected' : '' }}>All</option>
                                    <option value="1" {{ request('per_page') == 1 ? 'selected' : '' }}>1</option>
                                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                        </div>
                        @if(isset($leads))
                            <div class="lead-list">
                                @forelse($leads as $lead)
                                    <div class="details-panel lead-card"
                                        data-name="{{ strtolower($lead->name) }}"
                                        data-city="{{ strtolower($lead->City ?? '') }}"
                                        data-country="{{ strtolower($lead->country ?? '') }}"
                                        data-state="{{ strtolower($lead->state ?? '') }}"
                                        data-zip="{{ strtolower($lead->zip ?? '') }}"
                                        data-service="{{ strtolower($lead->service->name ?? '') }}"
                                        data-lead-service="{{ strtolower($lead->service->leadService->name ?? '') }}"
                                        data-status="{{ $lead->status === NULL ? 'null' : $lead->status }}"
                                        data-budget="{{ strtolower($lead->budget) }}">
                                        <div class="details-header">
                                            <h5>{{ $lead->name }} </h5>
                                            <p><span>{{ isset($lead->service) ? $lead->service->name : 'No Service' }}</span> - <span>{{ isset($lead->service->leadService) ? $lead->service->leadService->name : 'No Service Type' }}</span></p>
                                        </div>
                                        <hr>
                                        <div class="lead-details">
                                            <p><strong>City:</strong> <i class="fas fa-city icon"></i> {{ $lead->city ?? 'N/A' }} -
                                                <strong>Zip Code:</strong> <i class="fas fa-map-pin icon"></i> {{ $lead->zip ?? 'N/A' }}</p>
                                             <p><strong>Country:</strong> <i class="fas fa-globe icon"></i> {{ $lead->country ?? 'N/A' }} -
                                                <strong>State:</strong> <i class="fas fa-map-marker icon"></i> {{ $lead->state ?? 'N/A' }}</p>
                                             <p><strong>Location:</strong> <i class="fas fa-map-marker-alt icon"></i> {{ $lead->address ?? 'N/A' }}</p>
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
                                                    <strong class="text-success">Pick</strong>
                                                @elseif($lead->status === 0)
                                                    <strong class="text-danger">Not Pick</strong>
                                                @else
                                                    <strong class="text-warning">Pending</strong>
                                                @endif
                                            </p>
                                            <p><strong>Details:</strong></p>
                                            <ul>
                                                <li><strong>Business:</strong> {{ $lead->business }}</li>
                                                <li><strong>Need:</strong> {{ $lead->need }}</li>
                                                <li><strong>Industry:</strong> {{ $lead->industry }}</li>
                                                <li><strong>Live Website:</strong> {{ $lead->live_website }}</li>
                                            </ul>
                                            <p>
                                                <strong>Credit:</strong><span class="text-info"> {{ $lead->service->credit ?? 'No Credit' }}</span>
                                            </p>
                                            <div>
                                                @if(auth()->user()->assign_status === NULL || auth()->user()->credit === NULL)
                                                    <!-- Redirect to package page if assign_status or credit is null -->

                                                    <a href="{{ route('company.purchase.package', $lead->id ) }}">
                                                        <button class="btn btn-primary btn-not-interested">
                                                            <span style="color:white">Package</span>
                                                        </button>
                                                    </a>
                                                @else
                                                    <!-- Regular buttons if assign_status and credit are not null -->
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
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="header">
                                        <strong>No Leads Found</strong>
                                    </div>
                                @endforelse
                            </div>
                            <!-- Add pagination links -->
                            @if($leads instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $leads->links('vendor.pagination.default') }}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <script src="{{ asset('assets/js/lead.js')}}"></script>
            <script>
                // Store the displayed lead IDs to prevent duplicate notifications
    const displayedLeads = new Set();

    // Update the records per page and reload the page
    function updateRecordsPerPage() {
        var perPage = document.getElementById('recordsPerPage').value;
        window.location.href = "{{ url()->current() }}?per_page=" + perPage;
    }

    // Configure Pusher
    Pusher.logToConsole = true;
    const pusher = new Pusher('d5d22d7c74f866a982c6', {
        cluster: 'mt1',
        encrypted: true,
    });

    const channel = pusher.subscribe('my-channal');

    // Listen for the event
    channel.bind('my-event', function (data) {

        // Check if the lead ID has already been displayed
        if (displayedLeads.has(data.lead.id)) {
            return; // If this notification already exists, don't create a new one
        }

        // Add the lead ID to the displayedLeads set
        displayedLeads.add(data.lead.id);

        const notificationContainer = document.getElementById('notifications');

        // Create a new notification
        const notification = document.createElement('div');
        notification.className = 'notification'; 
        notification.setAttribute('data-lead-id', data.lead.id); // Store lead ID to avoid duplicates
        notification.innerHTML = `
            <a href="/company/leads/show/${data.lead.id}" target="_blank" class="notification-link">
                <strong>New Lead:</strong> ${data.lead.name} <br>
                <span>Message: ${data.lead.contact}</span><br>
            </a>
            <button class="close-btn">&times;</button>
        `;

        // Close notification on click
        notification.querySelector('.close-btn').addEventListener('click', function () {
            notification.remove();
            displayedLeads.delete(data.lead.id); // Remove from the set when closed
        });

        // Append the notification to the container
        notificationContainer.appendChild(notification);

        // Remove notification after 30 seconds
        setTimeout(() => {
            notification.remove();
            displayedLeads.delete(data.lead.id); // Remove from the set after timeout
        }, 30000);
    });
            </script>
@endsection
