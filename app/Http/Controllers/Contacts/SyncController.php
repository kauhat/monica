<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use \Google_Client;
use \Google_Service_PeopleService;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;


class SyncController extends Controller
{
    /**
     * Get the list of all contacts to sync
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, Google_Client $client)
    {
        $access_token = $request->session()->get('google_access_token');

        //
        try {
            $user = Socialite::driver('google')->userFromToken($access_token);

            //
            $client->setAccessToken($user->token);

        } catch (ClientException) {
            return redirect()->route('auth.thirdparty.callback', 'google');
        }

        // Get the API client and construct the service object.
        $service = new Google_Service_PeopleService($client);

        // Print the names for up to 10 connections.
        $optParams = array(
            'pageSize' => 1000,
            'personFields' => 'names,emailAddresses',
        );

        $results = $service->people_connections->listPeopleConnections('people/me', $optParams);

        dump(collect($results)->pluck('names.0'));
    }
}
