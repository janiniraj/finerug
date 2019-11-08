<?php

namespace App\Http\Controllers\Backend\Store;

use App\Models\Store\Store;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Store\StoreRepository;
use App\Http\Requests\Backend\Store\StoreRequest;
use App\Http\Requests\Backend\Store\ManageRequest;
use App\Http\Requests\Backend\Store\EditRequest;
use App\Http\Requests\Backend\Store\CreateRequest;
use App\Http\Requests\Backend\Store\DeleteRequest;
use App\Http\Requests\Backend\Store\UpdateRequest;

/**
 * Class StoreController.
 */
class StoreController extends Controller
{
    /**
     * @var StoreRepository
     */ 
    protected $stores;

    /**
     * @param StoreRepository $stores
     */
    public function __construct(StoreRepository $stores)
    {
        $this->stores = $stores;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.stores.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.stores.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->stores->create($request->all());

        return redirect()->route('admin.stores.index')->withFlashSuccess(trans('alerts.backend.stores.created'));
    }

    /**
     * @param Store              $store
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Store $store, EditRequest $request)
    {
        return view('backend.stores.edit')
            ->withStore($store);
    }

    /**
     * @param Store              $store
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Store $store, UpdateRequest $request)
    {
        $this->stores->update($store, $request->all());

        return redirect()->route('admin.stores.index')->withFlashSuccess(trans('alerts.backend.stores.updated'));
    }

    /**
     * @param Store              $store
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Store $store, DeleteRequest $request)
    {
        //$store = $this->stores->find($id);

        $this->stores->delete($store);

        return redirect()->route('admin.stores.index')->withFlashSuccess(trans('alerts.backend.stores.deleted'));
    }
}
