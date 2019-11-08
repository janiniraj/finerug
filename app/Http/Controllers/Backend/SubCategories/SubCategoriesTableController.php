<?php

namespace App\Http\Controllers\Backend\SubCategories;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\SubCategories\SubCategoriesRepository;
use App\Http\Requests\Backend\SubCategories\ManageSubCategoriesRequest;
use Carbon\Carbon;

/**
 * Class SubCategoriesTableController.
 */
class SubCategoriesTableController extends Controller
{
    /**
     * @var SubCategoriesRepository
     */
    protected $subcategories;

    /**
     * @param SubCategoriesRepository $subcategories
     */
    public function __construct(SubCategoriesRepository $subcategories)
    {
        $this->subcategories = $subcategories;
    }

    /**
     * @param ManageSubCategoriesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageSubCategoriesRequest $request)
    {
        return Datatables::of($this->subcategories->getForDataTable())
            ->escapeColumns(['subcategory','catagory'])
            ->addColumn('status', function ($subcategories) {
                if ($subcategories->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($subcategories) {
                return Carbon::parse($subcategories->created_at)->toDateString();
            })
            ->addColumn('actions', function ($subcategories) {
                return $subcategories->action_buttons;
            })
            ->make(true);
    }
}
