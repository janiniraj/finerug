<?php

namespace App\Http\Controllers\Backend\Categories;

use App\Models\Categories\Category;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Categories\CategoriesRepository;
use App\Http\Requests\Backend\Categories\StoreCategoriesRequest;
use App\Http\Requests\Backend\Categories\ManageCategoriesRequest;
use App\Http\Requests\Backend\Categories\EditCategoriesRequest;
use App\Http\Requests\Backend\Categories\CreateCategoriesRequest;
use App\Http\Requests\Backend\Categories\DeleteCategoriesRequest;
use App\Http\Requests\Backend\Categories\UpdateCategoriesRequest;

/**
 * Class CategoriesController.
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoriesRepository
     */
    protected $categories;

    /**
     * @param CategoriesRepository $categories
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
    public function index(ManageCategoriesRequest $request)
    {
        return view('backend.categories.index');
    }

    /**
     * @param CreateCategoriesRequest $request
     *
     * @return mixed
     */
    public function create(CreateCategoriesRequest $request)
    {
        return view('backend.categories.create');
    }

    /**
     * @param StoreCategoriesRequest $request
     *
     * @return mixed
     */
    public function store(StoreCategoriesRequest $request)
    {
        $this->categories->create($request->all());

        return redirect()->route('admin.categories.index')->withFlashSuccess(trans('alerts.backend.categories.created'));
    }

    /**
     * @param Category              $category
     * @param EditCategoriesRequest $request
     *
     * @return mixed
     */
    public function edit(Category $category, EditCategoriesRequest $request)
    {
        return view('backend.categories.edit')
            ->withCategory($category);
    }

    /**
     * @param Category              $category
     * @param UpdateCategoriesRequest $request
     *
     * @return mixed
     */
    public function update(Category $category, UpdateCategoriesRequest $request)
    {
        $this->categories->update($category, $request->all());

        return redirect()->route('admin.categories.index')->withFlashSuccess(trans('alerts.backend.categories.updated'));
    }

    /**
     * @param Category              $category
     * @param DeleteCategoriesRequest $request
     *
     * @return mixed
     */
    public function destroy(Category $category, DeleteCategoriesRequest $request)
    {
        $this->categories->delete($category);

        return redirect()->route('admin.categories.index')->withFlashSuccess(trans('alerts.backend.categories.deleted'));
    }
}
