<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\UserAddress\UserAddress;

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
        $this->userAddress = new UserAddress();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function myAccount()
    {
        $loggedInUser = Auth::user();

        $lastOrder = $loggedInUser->orders()->OrderBy('orders.id', 'DESC')->first();
//dd($loggedInUser->orders);
        return view('frontend.account.my-account')->with([
            'addresses' => $loggedInUser->addresses,
            'orders' => $loggedInUser->orders,
            'lastOrder' => $lastOrder
        ]);
    }
}
