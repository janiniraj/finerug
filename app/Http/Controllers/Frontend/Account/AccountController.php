<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\UserAddress\UserAddress;
use Illuminate\Http\Request;
use App\Models\Access\User\User;

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

    public function editProfile()
    {
        $loggedInUser = Auth::user();

        return view('frontend.account.edit-profile')->with([
            'userData' => $loggedInUser
        ]);
    }

    public function saveEditProfile(Request $request)
    {
        $postData = $request->all();
        $loggedInUser = Auth::user();
        $userData = User::find($loggedInUser->id);
        $userData->first_name = $postData['first_name'];
        $userData->last_name = $postData['last_name'];
        $userData->save();
        Auth::user()->fresh();
        return redirect()->route('frontend.account.my-account')->withFlashSuccess('Profile Successfully saved.');
    }

    public function myOrders()
    {
        $loggedInUser = Auth::user();
        return view('frontend.account.my-orders')->with([
            'orders' => $loggedInUser->orders
        ]);
    }
}
