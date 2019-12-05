<?php

namespace App\Http\Controllers\Backend\Offer;

use App\Models\Offer\Offer;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Offer\OfferRepository;
use App\Http\Requests\Backend\Offer\StoreRequest;
use App\Http\Requests\Backend\Offer\ManageRequest;
use App\Http\Requests\Backend\Offer\EditRequest;
use App\Http\Requests\Backend\Offer\CreateRequest;
use App\Http\Requests\Backend\Offer\DeleteRequest;
use App\Http\Requests\Backend\Offer\UpdateRequest;

/**
 * Class OfferController.
 */
class OfferController extends Controller
{
    /**
     * @var OfferRepository
     */
    protected $offers;

    /**
     * @param OfferRepository $offers
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
    public function index(ManageRequest $request)
    {
        return view('backend.offers.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.offers.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->offers->create($request->all());

        return redirect()->route('admin.offers.index')->withFlashSuccess(trans('alerts.backend.offers.created'));
    }

    /**
     * @param Offer              $offer
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Offer $offer, EditRequest $request)
    {
        return view('backend.offers.edit')
            ->withOffer($offer);
    }

    /**
     * @param Offer              $offer
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Offer $offer, UpdateRequest $request)
    {
        $this->offers->update($offer, $request->all());

        return redirect()->route('admin.offers.index')->withFlashSuccess(trans('alerts.backend.offers.updated'));
    }

    /**
     * @param Offer              $offer
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Offer $offer, DeleteRequest $request)
    {
        $this->offers->delete($offer);

        return redirect()->route('admin.offers.index')->withFlashSuccess(trans('alerts.backend.offers.deleted'));
    }
}
