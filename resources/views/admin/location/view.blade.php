@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <!-- Place Details -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div id="place-image-container" class="mb-4">
                                <!-- Image will be injected here via JavaScript -->
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h3 class="card-title">{{ $placeDetails['name'] }}</h3>
                            <p class="card-text"><strong>Address:</strong> {{ $placeDetails['formatted_address'] }}</p>
                            <p class="card-text"><strong>Coordinates:</strong>
                                ({{ $placeDetails['geometry']['location']['lat'] }}, {{ $placeDetails['geometry']['location']['lng'] }})
                            </p>
                        </div>
                    </div>



                    {{-- Reviews --}}
                    @if(isset($placeDetails['reviews']) && count($placeDetails['reviews']) > 0)
                        <h4>Reviews</h4>
                        @foreach($placeDetails['reviews'] as $review)
                            <div class="media mb-4">
                                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($review['author_name']))) }}"
                                     class="mr-3 rounded-circle" alt="Author Image" style="width: 50px; height: 50px;">
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $review['author_name'] }}</h5>
                                    <p class="mb-2">{{ $review['text'] }}</p>
                                    <p><strong>Rating:</strong> {{ $review['rating'] }} / 5</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            No reviews available for this place yet.
                        </div>
                    @endif

                    <!-- Review Form Button -->
                    <div class="text-center mt-4">
                        <a href="{{ route('places.review', ['placeId' => $placeDetails['place_id']]) }}" class="btn btn-outline-success">
                            <i class="fas fa-star"></i> Leave a Review
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar (Optional) -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Place Information</h5>
                    <p><strong>Phone:</strong> {{ $placeDetails['formatted_phone_number'] ?? 'Not Available' }}</p>
                    <p><strong>Website:</strong> <a href="{{ $placeDetails['url'] ?? '#' }}" target="_blank">Visit Website</a></p>
                    @if(isset($placeDetails['opening_hours']) && $placeDetails['opening_hours'])
                        <p><strong>Open Now:</strong>
                            @if($placeDetails['opening_hours']['open_now'])
                                Yes
                            @else
                                No
                            @endif
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript to handle dynamic image display based on Google API response
document.addEventListener("DOMContentLoaded", function() {
    let placeDetails = @json($placeDetails); // Passing the placeDetails data to JS

    let placeImage = `<img src="https://via.placeholder.com/150" alt="Place Image" class="img-thumbnail" style="width: 150px; height: 150px; margin-right: 15px;">`;

    if (placeDetails.photos && placeDetails.photos.length > 0) {
        placeImage = `<img src="https://maps.googleapis.com/maps/api/place/photo?maxwidth=150&photoreference=${placeDetails.photos[0].photo_reference}&key=AIzaSyAa9BJa70uf_20IoTJfAiK_3wz5Vr_I7wM" alt="Place Image" class="img-thumbnail" style="width: 150px; height: 150px; margin-right: 15px;">`;
    }

    // Inject the image into the HTML
    document.getElementById('place-image-container').innerHTML = placeImage;
});
</script>

@endsection
