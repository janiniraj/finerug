<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{

    /**
     * AccountController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\View\View
     */
    public function myAccount()
    {
        return view('frontend.account.my-account');
    }
}
