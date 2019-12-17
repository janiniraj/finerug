<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\Contact\SendContact;
use App\Http\Requests\Frontend\Contact\SendContactRequest;
use App\Mail\Frontend\Contact\SendEstimate;

/**
 * Class ContactController.
 */
class ContactController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.contact');
    }

    public function loginPage()
    {
        return view('frontend.login');
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function send(SendContactRequest $request)
    {
        Mail::send(new SendContact($request));

        return redirect()->back()->withFlashSuccess(trans('alerts.frontend.contact.sent'));
    }

    public function getEstimate()
    {
        return view('frontend.get-estimate');
    }

    public function sendEstimate(SendContactRequest $request)
    {
        Mail::send(new SendEstimate($request));

        return redirect()->back()->withFlashSuccess(trans('Estimate Query is submitted, we will get back to you soon.'));
    }
}
