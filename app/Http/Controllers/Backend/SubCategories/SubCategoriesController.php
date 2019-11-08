<?php

namespace App\Http\Controllers\Backend\SubCategories;

use App\Models\Categories\Category;
use App\Models\SubCategories\SubCategory;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\SubCategories\SubCategoriesRepository;
use App\Http\Requests\Backend\SubCategories\StoreSubCategoriesRequest;
use App\Http\Requests\Backend\SubCategories\ManageSubCategoriesRequest;
use App\Http\Requests\Backend\SubCategories\EditSubCategoriesRequest;
use App\Http\Requests\Backend\SubCategories\CreateSubCategoriesRequest;
use App\Http\Requests\Backend\SubCategories\DeleteSubCategoriesRequest;
use App\Http\Requests\Backend\SubCategories\UpdateSubCategoriesRequest;

/**
 * Class SubCategoriesController.
 */
class SubCategoriesController extends Controller
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
    public function index(ManageSubCategoriesRequest $request)
    {
        return view('backend.subcategories.index');
    }

    /**
     * @param CreateSubCategoriesRequest $request
     *
     * @return mixed
     */
    public function create(CreateSubCategoriesRequest $request)
    {
        $categoryName = Category::where('status', 1)->pluck('category', 'id');
        return view('backend.subcategories.create',compact('categoryName'));
    }

    /**
     * @param StoreSubCategoriesRequest $request
     *
     * @return mixed
     */
    public function store(StoreSubCategoriesRequest $request)
    {
        $this->subcategories->create($request->all());

        return redirect()->route('admin.subcategories.index')->withFlashSuccess(trans('alerts.backend.subcategories.created'));
    }

    /**
     * @param SubCategory              $subcategory
     * @param EditSubCategoriesRequest $request
     *
     * @return mixed
     */
    public function edit(SubCategory $subcategory, EditSubCategoriesRequest $request)
    {
        $categoryName = Category::where('status', 1)->pluck('category', 'id');
        return view('backend.subcategories.edit', compact('categoryName'))
            ->withSubcategory($subcategory);
    }

    /**
     * @param SubCategory              $subcategory
     * @param UpdateSubCategoriesRequest $request
     *
     * @return mixed
     */
    public function update(SubCategory $subcategory, UpdateSubCategoriesRequest $request)
    {
        $this->subcategories->update($subcategory, $request->all());

        return redirect()->route('admin.subcategories.index')->withFlashSuccess(trans('alerts.backend.subcategories.updated'));
    }

    /**
     * @param SubCategory              $subcategory
     * @param DeleteSubCategoriesRequest $request
     *
     * @return mixed
     */
    public function destroy(SubCategory $subcategory, DeleteSubCategoriesRequest $request)
    {
        $this->subcategories->delete($subcategory);

        return redirect()->route('admin.subcategories.index')->withFlashSuccess(trans('alerts.backend.subcategories.deleted'));
    }

    public function getByCategory($categoryId)
    {
        $data = $this->subcategories->query()->where('category_id', $categoryId)->orderBy('subcategory', 'ASC')->get();

        if(empty($data))
        {
            $data = [];
        }

        return response()->json($data);
    }
}
