<?php

namespace App\Http\Controllers\Backend\Categories;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Categories\CategoriesRepository;
use App\Http\Requests\Backend\Categories\ManageCategoriesRequest;
use Carbon\Carbon;

/**
 * Class CategoriesTableController.
 */
class CategoriesTableController extends Controller
{
    /**
     * @var CategoriesRepository
     */
    protected $categories;

    /**
     * @param CategoriesRepository $cmspages
     */
    public function __construct(CategoriesRepository $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param ManageCategoriesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCategoriesRequest $request)
    {
        return Datatables::of($this->categories->getForDataTable())
            ->escapeColumns(['category'])
            ->addColumn('status', function ($categories) {
                if ($categories->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($categories) {
                return Carbon::parse($categories->created_at)->toDateString();
            })
            ->addColumn('actions', function ($categories) {
                return $categories->action_buttons;
            })
            ->make(true);
    }
}
