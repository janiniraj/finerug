<?php

namespace App\Http\Controllers\Backend\Subscription;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Subscription\SubscriptionRepository;
use App\Http\Requests\Backend\Subscription\ManageRequest;
use Carbon\Carbon;

/**
 * Class SubscriptionTableController.
 */
class SubscriptionTableController extends Controller
{
    /**
     * @var SubscriptionRepository
     */
    protected $subscriptions;

    /**
     * @param SubscriptionRepository $cmssubscriptions
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
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->subscriptions->getForDataTable())
            ->escapeColumns(['id','email'])
            ->addColumn('created_at', function ($subscriptions) {
                return Carbon::parse($subscriptions->created_at)->toDateString();
            })
            ->addColumn('actions', function ($subscriptions) {
                return $subscriptions->action_buttons;
            })
            ->make(true);
    }
}
