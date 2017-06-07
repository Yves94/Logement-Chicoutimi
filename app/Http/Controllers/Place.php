<?php

namespace App\Http\Controllers;

use App\Service\HttpClientService;
use Illuminate\Http\Request;

class Place extends Controller
{
    const PLACE_ENDPOINT = '/places';
    private $httpClient;

    public function __construct(HttpClientService $httpClientService)
    {
        $this->httpClient = $httpClientService;
    }

    public function index(Request $request)
    {
        $params = '?lat=' . $request->get('lat') . '&long=' . $request->get('long') . '&radius=' . $request->get('radius');

        $places = $this->httpClient->callApi(
            HttpClientService::GET_METHOD,
            self::PLACE_ENDPOINT . $params
        );

        return view('home', [
            'places' => $places
        ]);
    }

    public function show($id)
    {
        $place = $this->httpClient->callApi(
            HttpClientService::GET_METHOD,
            self::PLACE_ENDPOINT . '/' . $id
        );

        return view('show', [
            'place' => $place,
        ]);
    }

    public function create()
    {
        return view('sale');
    }

    public function store()
    {
        return view('sale');
    }
}