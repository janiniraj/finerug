<?php

namespace App\Http\Controllers\Backend\Material;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Material\MaterialRepository;
use App\Http\Requests\Backend\Material\ManageRequest;
use Carbon\Carbon;

/**
 * Class MaterialTableController.
 */
class MaterialTableController extends Controller
{
    /**
     * @var MaterialRepository
     */
    protected $materials;

    /**
     * @param MaterialRepository $cmspages
     */
    public function __construct(MaterialRepository $materials)
    {
        $this->materials = $materials;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->materials->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($materials) {
                if ($materials->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($materials) {
                return Carbon::parse($materials->created_at)->toDateString();
            })
            ->addColumn('actions', function ($materials) {
                return $materials->action_buttons;
            })
            ->make(true);
    }
}
