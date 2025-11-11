function filterLeads() {
    var nameSearch = document.getElementById("nameSearch").value.toLowerCase();
    var citySearch = document.getElementById('citySearch').value.toLowerCase();
    var countrySearch = document.getElementById('countrySearch').value.toLowerCase();
    var stateSearch = document.getElementById('stateSearch').value.toLowerCase();
    var zipSearch = document.getElementById('zipCodeSearch').value.toLowerCase();
    var budgetSearch = document.getElementById("budgetSearch").value.toLowerCase();
    var serviceFilter = document.getElementById("serviceFilter").value.toLowerCase();
    var leadServiceFilter = document.getElementById("leadServiceFilter").value.toLowerCase();
    var statusFilter = document.getElementById("statusFilter").value;
    var leads = document.querySelectorAll(".lead-card");

    leads.forEach(function(lead) {
        var name = lead.getAttribute("data-name");
        var city = lead.getAttribute("data-city");
        var country = lead.getAttribute("data-country");
        var state = lead.getAttribute("data-state");
        var zip = lead.getAttribute("data-zip");
        var budget = lead.getAttribute("data-budget");
        var service = lead.getAttribute("data-service");
        var leadService = lead.getAttribute("data-lead-service");
        var status = lead.getAttribute("data-status"); // Get the status attribute
        // Check if the search input matches any of the lead fields
        if (
            name.includes(nameSearch) &&
            city.includes(citySearch) &&
            country.includes(countrySearch) &&
            state.includes(stateSearch) &&
            zip.includes(zipSearch) &&
            budget.includes(budgetSearch) &&
            (serviceFilter === "" || service.includes(serviceFilter)) &&
            (leadServiceFilter === "" || leadService.includes(leadServiceFilter)) &&
            (statusFilter === "" || status === statusFilter)
        ) {
            lead.style.display = "block";
        } else {
            lead.style.display = "none";
        }
    });
}

function clearFilters() {
    document.getElementById("nameSearch").value = '';
    document.getElementById("budgetearch").value = '';
    document.getElementById("locationSearch").value = '';
    document.getElementById("serviceFilter").value = '';
    document.getElementById("leadServiceFilter").value = '';
    document.getElementById("statusFilter").value = '';
    filterLeads();
}