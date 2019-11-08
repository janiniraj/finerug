<?php

namespace App\Http\Controllers\Backend\Store;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Store\StoreRepository;
use App\Http\Requests\Backend\Store\ManageRequest;
use Carbon\Carbon;

/**
 * Class StoreTableController.
 */
class StoreTableController extends Controller
{
    /**
     * @var StoreRepository
     */
    protected $stores;

    /**
     * @param StoreRepository $cmspages
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
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->stores->getForDataTable())
            ->escapeColumns(['name','pobox'])            
            ->addColumn('created_at', function ($stores) {
                return Carbon::parse($stores->created_at)->toDateString();
            })
            ->addColumn('actions', function ($stores) {
                return $stores->action_buttons;
            })
            ->make(true);
    }
}
