<?php

namespace App\Http\Controllers\Backend\Activity;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Activity\ActivityRepository;
use App\Http\Requests\Backend\Activity\ManageRequest;
use Carbon\Carbon;

/**
 * Class ActivityTableController.
 */
class ActivityTableController extends Controller
{
    /**
     * @var ActivityRepository
     */
    protected $activities;

    /**
     * @param ActivityRepository $cmspages
     */
    public function __construct(ActivityRepository $activities)
    {
        $this->activities = $activities;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->activities->getForDataTable())
            ->escapeColumns([])
            ->addColumn('name', function ($activities)
            {
                return "<a target='_blank' href='".route('admin.product.edit', $activities->product_id)."'>".$activities->name."</a>";
            })
            ->addColumn('actvity', function ($activities) {
                if($activities->activity == 'add_wishlist')
                {
                    return $activities->first_name. ' added product '. $activities->name.' into wishlist';
                }
                else
                {
                    return $activities->first_name. ' added product '. $activities->name.' into Cart';
                }
                
            })
            ->addColumn('created_at', function ($activities) {
                return Carbon::parse($activities->created_at)->toDateString();
            })
            ->addColumn('actions', function ($activities) {
                return $activities->action_buttons;
            })
            ->make(true);
    }
}
