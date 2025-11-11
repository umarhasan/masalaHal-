<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GooglePlaceService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('Google_API_KEY');  // Ensure you have the correct API key in .env
    }

    public function searchPlaces($query, $nextPageToken = null)
    {
        $params = [
            'query' => $query,
            'key'   => $this->apiKey,
        ];

        if ($nextPageToken) {
            $params['pagetoken'] = $nextPageToken; // Use the next page token for pagination
        }

        $response = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', $params);
        return $response->json(); // Returns the JSON response
    }
    
    // New method to get detailed information for a place
    public function getPlaceDetails($placeId)
    {
        $params = [
            'place_id' => $placeId,
            'fields'   => 'name,formatted_address,formatted_phone_number,website',
            'key'      => $this->apiKey,
        ];

        $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', $params);
        return $response->json();
    }
}