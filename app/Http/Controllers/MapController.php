<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    public function showMap()
    {
        $url = 'https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_day.geojson';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            return "cURL error: $error";
        }
        curl_close($ch);
        $earthquakeData = json_decode($response, true);

        return view('welcome', [
            'earthquakeData' => $earthquakeData,
        ]);
    }
}
