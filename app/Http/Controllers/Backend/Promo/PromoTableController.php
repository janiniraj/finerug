<?php

namespace App\Http\Controllers\Backend\Promo;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Promo\PromoRepository;
use App\Http\Requests\Backend\Promo\ManageRequest;
use Carbon\Carbon;

/**
 * Class PromoTableController.
 */
class PromoTableController extends Controller
{
    /**
     * @var PromoRepository
     */
    protected $promos;

    /**
     * @param PromoRepository $cmspages
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
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->promos->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($promos) {
                if ($promos->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($promos) {
                return Carbon::parse($promos->created_at)->toDateString();
            })
            ->addColumn('actions', function ($promos) {
                return $promos->action_buttons;
            })
            ->make(true);
    }
}
