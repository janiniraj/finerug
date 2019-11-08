<?php

namespace App\Http\Controllers\Backend\Subscription;

use App\Models\Subscription\Subscription;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Subscription\SubscriptionRepository;
use App\Http\Requests\Backend\Subscription\StoreRequest;
use App\Http\Requests\Backend\Subscription\ManageRequest;
use App\Http\Requests\Backend\Subscription\EditRequest;
use App\Http\Requests\Backend\Subscription\CreateRequest;
use App\Http\Requests\Backend\Subscription\DeleteRequest;
use App\Http\Requests\Backend\Subscription\UpdateRequest;

/**
 * Class SubscriptionController.
 */
class SubscriptionController extends Controller
{
    /**
     * @var SubscriptionRepository
     */
    protected $subscriptions;

    /**
     * @param SubscriptionRepository $subscriptions
     */
    public function __construct(SubscriptionRepository $subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.subscriptions.index');
    }

    /**
     * @param Subscription              $subscription
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Subscription $subscription, DeleteRequest $request)
    {
        //$subscription = $this->subscriptions->find($id);

        $this->subscriptions->delete($subscription);

        return redirect()->route('admin.subscriptions.index')->withFlashSuccess(trans('alerts.backend.subscriptions.deleted'));
    }
}
