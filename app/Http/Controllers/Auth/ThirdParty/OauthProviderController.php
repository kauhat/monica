<?php

namespace App\Http\Controllers\Auth\ThirdParty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class OauthProviderController extends Controller
{
    public function redirect(Request $request, $provider)
    {
        try {
            $access_token = $request->session()->get('google_access_token');

            if ($access_token) {
                $user = Socialite::driver('google')->userFromToken($access_token); #

                //
                if ($user) {
                    return back();
                }
            }
        } catch (ClientException) {
            //
        }

        return Socialite::driver($provider)
            ->scopes(['https://www.googleapis.com/auth/contacts.readonly'])
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->redirect();
    }

    public function callback(Request $request, $provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $request->session()->put('google_access_token', $user->token);
        } catch (InvalidStateException) {
            //
        }

        return redirect('https://monica.lndo.site/settings/linkedAccounts');
    }
}
