<?php

namespace App\Http\Controllers\Backend\Weave;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Weave\WeaveRepository;
use App\Http\Requests\Backend\Weave\ManageRequest;
use Carbon\Carbon;

/**
 * Class WeaveTableController.
 */
class WeaveTableController extends Controller
{
    /**
     * @var WeaveRepository
     */
    protected $weaves;

    /**
     * @param WeaveRepository $cmspages
     */
    public function __construct(WeaveRepository $weaves)
    {
        $this->weaves = $weaves;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->weaves->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($weaves) {
                if ($weaves->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($weaves) {
                return Carbon::parse($weaves->created_at)->toDateString();
            })
            ->addColumn('actions', function ($weaves) {
                return $weaves->action_buttons;
            })
            ->make(true);
    }
}
