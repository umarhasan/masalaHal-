@extends('customer.layouts.app')
<style>

</style>
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Edit Profile</h1>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<main id="main" class="main">

        <section class="section dashboard">
            <div class="row">
                <!-- Section 2: Basic Information -->
                <div class="col-xl-12" style="background:#fff">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <!-- Section 1: Basic Information -->          
                                <div class="card mb-4">
                                            <form action="{{ route('customer.profile.update', ['section' => 'basic']) }}" method="POST">
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
                                    <form action="{{ route('customer.profile.update', ['section' => 'contact']) }}" method="POST">
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
                                    <form action="{{ route('customer.profile.update', ['section' => 'professional']) }}" method="POST">
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
                                    <form action="{{ route('customer.profile.update', ['section' => 'social']) }}" method="POST" enctype="multipart/form-data">
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
                                                <label for="logo">Uploaded Logo</label><br>
                                                @if($userInformation && $userInformation->logo)
                                                    <img src="{{ asset('storage/' . $userInformation->logo) }}" alt="Logo" width="100">
                                                @else
                                                    <p>No logo uploaded</p>
                                                @endif
                                                <input type="file" name="logos" class="form-control">
                                            </div>
                    
                                            <div class="form-group mb-3">
                                                <label for="images">Uploaded Images</label><br>
                                                @if($userInformation && $userInformation->images)
                                                    <h5>General Uploaded Images:</h5>
                                                    @foreach(json_decode($userInformation->images, true) as $image)
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Image" width="100" class="me-2">
                                                    @endforeach
                                                @else
                                                    <p>No general images uploaded</p>
                                                @endif
                                                <input type="file" name="images[]" class="form-control" multiple>
                                            </div>
                    
                    
                                            <button type="submit" class="btn btn-primary">Update Social & Media</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Section 5: Company Details -->
                                <div class="card mb-4">
                                    <form action="{{ route('customer.profile.update', ['section' => 'details']) }}" method="POST" enctype="multipart/form-data">
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
                                <!-- Section 6: Hobbies -->
                                <div class="card mb-4">
                                    <form action="{{ route('customer.profile.update', ['section' => 'hobbies']) }}" method="POST">
                                        @csrf
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5>Hobbies</h5>
                                            <button type="button" class="btn btn-sm btn-outline-primary toggle-section" data-section="hobbies-section">Edit</button>
                                        </div>
                                        <div class="card-body section" id="hobbies-section" style="display: none;">
                                            <div class="form-group mb-3">
                                                <label for="hobbies">Hobbies</label>
                                                <input type="text" name="hobbies" class="form-control" value="{{ $userInformation ? $userInformation->hobbies : old('hobbies') }}">
                                                {{-- <textarea name="hobbies" class="form-control">{{ $userInformation ? implode(',', json_decode($userInformation->hobbies ?? '[]', true)) : '' }}</textarea> --}}
                                                {{-- <small class="text-muted">Enter hobbies separated by commas (e.g., Reading, Traveling, Gaming)</small> --}}
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Hobbies</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    </section>
    </div>
</main>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
        }
    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
    });
</script>
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

