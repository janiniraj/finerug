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
            'addresses' => $loggedInUser->addresses()->where('is_deleted', 0)->get(),
            'orders' => $loggedInUser->orders,
            'lastOrder' => $lastOrder
        ]);
    }

    public function editProfile()
    {
        $loggedInUser = Auth::user();

        return view('frontend.account.edit-profile')->with([
            'userData' => $loggedInUser,
            'addresses' => $loggedInUser->addresses()->where('is_deleted', 0)->get()
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

    public function myAddresses()
    {
        $loggedInUser = Auth::user();
        return view('frontend.account.my-addresses')->with([
            'addresses' => $loggedInUser->addresses()->where('is_deleted', 0)->get()
        ]);
    }

    public function deleteAddress($addressId)
    {
        $addressData = $this->userAddress->find($addressId);
        $addressData->is_deleted = 1;
        if($addressData->save())
        {
            return response()->json([
                'success' => true,
                'message' => 'Address Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Error in deleting address.'
            ]);
        }
    }

    public function editAddress($addressId)
    {
        $addressData = $this->userAddress->find($addressId)->toArray();
        return response()->json($addressData);
    }

    public function saveEditAddress(Request $request)
    {
        $postData = $request->all();
        $loggedInUser = Auth::user();
        $addressData = $this->userAddress->find($postData['id']);
        $addressData->first_name = $postData['first_name'];
        $addressData->last_name = $postData['last_name'];
        $addressData->email = $postData['email'];
        $addressData->phone = $postData['phone'];
        $addressData->address = $postData['address'];
        $addressData->street = $postData['street'];
        $addressData->city = $postData['city'];
        $addressData->postal_code = $postData['postal_code'];
        $addressData->state = $postData['state'];

        if($addressData->save())
        {
            return redirect()->route('frontend.account.edit-profile')->withFlashSuccess('Address Updated Successfully.');
        }
        else
        {
            return redirect()->route('frontend.account.edit-profile')->withFlashWarning('Address Updated Successfully.');
        }
    }
}
