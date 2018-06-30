<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PlacesController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        //Google Places API
        $api_key = 'AIzaSyDJuAwR7uqo5QVISH_kzU-ABEnSpjY3Abg';
        $input = $request->input('query');
        $search_url = 'https://maps.googleapis.com/maps/api/place/textsearch/json?query=' . $input . '&key=' . $api_key;
        $client = new Client(); //GuzzleHttp\Client
        $google_result = $client->get($search_url);
        $google_result = json_decode($google_result->getBody()->getContents(), true);
        //End of Google places API

        //Search results for Yelp, Foursquare can be added to "result" array

        $result['google'] = $google_result['results'];

        return $result;
    }
}
