<?php

namespace App\Http\Controllers\Backend\Promo;

use App\Models\Promo\Promo;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Promo\PromoRepository;
use App\Http\Requests\Backend\Promo\StoreRequest;
use App\Http\Requests\Backend\Promo\ManageRequest;
use App\Http\Requests\Backend\Promo\EditRequest;
use App\Http\Requests\Backend\Promo\CreateRequest;
use App\Http\Requests\Backend\Promo\DeleteRequest;
use App\Http\Requests\Backend\Promo\UpdateRequest;
use App\Models\Weave\Weave;

/**
 * Class PromoController.
 */
class PromoController extends Controller
{
    /**
     * @var PromoRepository
     */
    protected $promos;

    /**
     * @param PromoRepository $promos
     */
    public function __construct(PromoRepository $promos)
    {
        $this->promos = $promos;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.promos.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.promos.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->promos->create($request->all());

        return redirect()->route('admin.promos.index')->withFlashSuccess(trans('alerts.backend.promos.created'));
    }

    /**
     * @param Promo              $promo
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit($id)
    {
        $promoData = $this->promos->query()->find($id);
        return view('backend.promos.edit')
            ->withPromo($promoData);
    }

    /**
     * @param Promo              $promo
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Promo $promo, UpdateRequest $request)
    {
        $this->promos->update($promo, $request->all());

        return redirect()->route('admin.promos.index')->withFlashSuccess(trans('alerts.backend.promos.updated'));
    }

    /**
     * @param Promo              $promo
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $promo = $this->promos->find($id);

        $this->promos->delete($promo);

        return redirect()->route('admin.promos.index')->withFlashSuccess(trans('alerts.backend.promos.deleted'));
    }
}
