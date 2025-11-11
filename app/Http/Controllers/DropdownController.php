<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function getCountries()
    {
        $countries = json_decode(file_get_contents(public_path('json/countries.json')), true);
        dd($countries);
        return response()->json($countries);
    }

    public function getStates(Request $request)
    {
        $countryId = $request->get('country_id');
        $states = json_decode(file_get_contents(public_path('json/states.json')), true);
        $filteredStates = array_filter($states, function ($state) use ($countryId) {
            return $state['country_id'] == $countryId;
        });
        return response()->json($filteredStates);
    }

    public function getCities(Request $request)
    {
        $countryCode = $request->get('country_code');
        $cities = json_decode(file_get_contents(public_path('json/cities.json')), true);
        $filteredCities = array_filter($cities, function ($city) use ($countryCode) {
            return $city['country'] == $countryCode;
        });
        return response()->json($filteredCities);
    }
}
