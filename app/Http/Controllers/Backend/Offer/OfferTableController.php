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
            ->addColumn('product_link', function ($offers) {
                $productLink = route('frontend.product.show', $offers->product_id);
                return '<a target="_blank" href="'.$productLink.'">'.$offers->product_name.'</a>';
            })
            ->addColumn('created_at', function ($offers) {
                return Carbon::parse($offers->created_at)->toDateString();
            })
            ->addColumn('actions', function ($offers) {
                return '';
                //return $offers->action_buttons;
            })
            ->make(true);
    }
}
