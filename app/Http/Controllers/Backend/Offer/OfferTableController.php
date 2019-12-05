<?php

namespace App\Http\Controllers\Backend\Offer;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Offer\OfferRepository;
use App\Http\Requests\Backend\Offer\ManageRequest;
use Carbon\Carbon;

/**
 * Class OfferTableController.
 */
class OfferTableController extends Controller
{
    /**
     * @var OfferRepository
     */
    protected $offers;

    /**
     * @param OfferRepository $cmspages
     */
    public function __construct(OfferRepository $offers)
    {
        $this->offers = $offers;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->offers->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($offers) {
                if ($offers->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($offers) {
                return Carbon::parse($offers->created_at)->toDateString();
            })
            ->addColumn('actions', function ($offers) {
                return $offers->action_buttons;
            })
            ->make(true);
    }
}
