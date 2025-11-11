@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Leave a Review for {{ $placeDetails['name'] }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('review.store', ['placeId' => $placeDetails['place_id']]) }}" method="POST">
                        @csrf

                        <!-- Rating Section -->
                        <div class="form-group">
                            <label for="rating" class="font-weight-bold">Rating</label>
                            <select id="rating" name="rating" class="form-control custom-select" required>
                                <option value="">Select Rating</option>
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>

                        <!-- Review Section -->
                        <div class="form-group">
                            <label for="review" class="font-weight-bold">Your Review</label>
                            <textarea id="review" name="review" class="form-control" rows="6" placeholder="Write your review here..." required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success btn-lg w-100 mt-3">
                            <i class="fas fa-check-circle"></i> Submit Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 10px;
    }

    .card-header {
        border-radius: 10px 10px 0 0;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        font-size: 16px;
        font-weight: bold;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(60, 169, 200, 0.25);
        border-color: #00b4d8;
    }

    .custom-select {
        border-radius: 8px;
    }

    textarea {
        resize: vertical;
    }

    .font-weight-bold {
        font-weight: 600;
    }
</style>
@endsection
