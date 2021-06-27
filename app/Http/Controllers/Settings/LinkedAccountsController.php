<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\AccountHelper;
use App\Http\Controllers\Controller;

class LinkedAccountsController extends Controller
{
    /**
     * Get all the information about the account in terms of storage.
     */
    public function index()
    {
        $accountHasLimitations = AccountHelper::hasLimitations(auth()->user()->account);

        return view('settings.linkedaccounts.index')
            ->withAccountHasLimitations($accountHasLimitations);
    }
}
