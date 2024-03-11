<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

use GuzzleHttp\Client;

class ComingSoonController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
//        $client = new Client;
//        $request = $client->request('GET', "http://" . env('NODEHOST') . ":4943/bot");
//
//        $body = $request->getBody();

        return view('web.coming-soon');
    }
}
