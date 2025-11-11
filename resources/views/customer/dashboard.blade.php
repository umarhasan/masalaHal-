@extends('customer.layouts.app')

@section('content')
    <div class="content">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-8 mb-4 order-0">
                        <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Congratulations {{ $user->name }}! 🎉</h5>
                                        <p class="mb-4">
                                            You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in your profile.
                                        </p>

                                        <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                                    </div>
                                </div>
                                <div class="col-sm-5 text-center text-sm-left">
                                    <div class="card-body pb-0 px-0 px-md-4">
                                        <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 order-1">
                        <div class="container">
                            <div class="container">
                                <h4 class="mb-4">Complete Your Profile</h4>
                                <!-- Dynamic Profile Completion Progress Bar -->
                                <div class="progress" style="height: 30px;">
                                    <div
                                        class="progress-bar"
                                        role="progressbar"
                                        style="width: {{ $completionPercentage }}%; background-color: #4caf50;"
                                        aria-valuenow="{{ $completionPercentage }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                        {{ number_format($completionPercentage, 2) }}%
                                    </div>
                                </div></br>
                                <p style="font-weight: 700;font-size: 24px;color: #696cff;">Complete the remaining sections to reach 100%.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- Company Profile --}}
        <div class="container">
            <div class="card mb-4">
                <form action="{{ route('company.profile.update', ['section' => 'basic']) }}" method="POST">
                    @csrf
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Basic Information</h5>
                        <button type="button" class="btn btn-sm btn-outline-primary toggle-section" data-section="basic-info">Edit</button>
                    </div>
                    <div class="card-body section" id="basic-info" style="display: none;">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user ? $user->phone : old('phone') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Basic Information</button>
                    </div>
                </form>
            </div>

            <!-- Section 2: Contact Information -->
            <div class="card mb-4">
                <form action="{{ route('company.profile.update', ['section' => 'contact']) }}" method="POST">
                    @csrf
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Contact Information</h5>
                        <button type="button" class="btn btn-sm btn-outline-primary toggle-section" data-section="contact-info">Edit</button>
                    </div>
                    <div class="card-body section" id="contact-info" style="display: none;">
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control">{{ $userInformation ? $userInformation->address : old('address') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="country">Country</label>
                            <select name="country" class="form-control">
                                <option value="">Select Country</option>
                                <!-- You can replace this with your dynamic country list -->
                                <option value="Pakistan" {{ $userInformation && $userInformation->country == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                <option value="India" {{ $userInformation && $userInformation->country == 'India' ? 'selected' : '' }}>India</option>
                                <!-- Add more countries as needed -->
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="state">State</label>
                            <input type="text" name="state" class="form-control" value="{{ $userInformation ? $userInformation->state : old('state') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="city">City</label>
                            <select name="city" class="form-control">
                                <option value="">Select City</option>
                                <!-- You can replace this with your dynamic city list based on the selected country -->
                                <option value="Karachi" {{ $userInformation && $userInformation->city == 'Karachi' ? 'selected' : '' }}>Karachi</option>
                                <option value="Lahore" {{ $userInformation && $userInformation->city == 'Lahore' ? 'selected' : '' }}>Lahore</option>
                                <!-- Add more cities based on the country -->
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control" value="{{ $userInformation ? $userInformation->zip_code : old('zip_code') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Contact Information</button>
                    </div>
                </form>
            </div>

            <!-- Section 3: Professional Details -->
            <div class="card mb-4">
                <form action="{{ route('company.profile.update', ['section' => 'professional']) }}" method="POST">
                    @csrf
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Professional Details</h5>
                        <button type="button" class="btn btn-sm btn-outline-primary toggle-section" data-section="professional-details">Edit</button>
                    </div>
                    <div class="card-body section" id="professional-details" style="display: none;">
                        <div class="form-group mb-3">
                            <label for="industry_type">Industry Type</label>
                            <input type="text" name="industry_type" class="form-control" value="{{ $userInformation ? $userInformation->industry_type : old('industry_type') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="number_of_employees">Number of Employees</label>
                            <input type="number" name="number_of_employees" class="form-control" value="{{ $userInformation ? $userInformation->number_of_employees : old('number_of_employees') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="work_experience_years">Work Experience (Years)</label>
                            <input type="number" name="work_experience_years" class="form-control" value="{{ $userInformation ? $userInformation->work_experience_years : old('work_experience_years') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="work_experience_details">Work Experience Details</label>
                            <textarea name="work_experience_details" class="form-control">{{ $userInformation ? $userInformation->work_experience_details : old('work_experience_details') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Professional Details</button>
                    </div>
                </form>
            </div>

            <!-- Section 4: Social & Media -->
            <div class="card mb-4">
                <form action="{{ route('company.profile.update', ['section' => 'social']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Social & Media</h5>
                        <button type="button" class="btn btn-sm btn-outline-primary toggle-section" data-section="social-media">Edit</button>
                    </div>
                    <div class="card-body section" id="social-media" style="display: none;">
                        <div class="form-group mb-3">
                            <label for="website">Website</label>
                            <input type="url" name="website" class="form-control" value="{{ $userInformation ? $userInformation->website : old('website') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="social_links">Social Links</label>
                            <textarea name="social_links" class="form-control">{{ $userInformation ? $userInformation->social_links : old('social_links') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="images">Images</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Social & Media</button>
                    </div>
                </form>
            </div>

            <!-- Section 5: Company Details -->
            <div class="card mb-4">
                <form action="{{ route('company.profile.update', ['section' => 'details']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Company Details</h5>
                        <button type="button" class="btn btn-sm btn-outline-primary toggle-section" data-section="company-details">Edit</button>
                    </div>
                    <div class="card-body section" id="company-details" style="display: none;">
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control">{{ $userInformation ? $userInformation->description : old('description') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="founded_year">Founded Year</label>
                            <input type="number" name="founded_year" class="form-control" value="{{ $userInformation ? $userInformation->founded_year : old('founded_year') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="registration_number">Registration Number</label>
                            <input type="text" name="registration_number" class="form-control" value="{{ $userInformation ? $userInformation->registration_number : old('registration_number') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Company Details</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-section');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const sectionId = this.dataset.section;
                    const section = document.getElementById(sectionId);

                    if (section.style.display === 'none' || section.style.display === '') {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
