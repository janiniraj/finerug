<?php

namespace App\Http\Controllers\Backend\Page;

use App\Models\Page\Page;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Page\PageRepository;
use App\Http\Requests\Backend\Page\StoreRequest;
use App\Http\Requests\Backend\Page\ManageRequest;
use App\Http\Requests\Backend\Page\EditRequest;
use App\Http\Requests\Backend\Page\CreateRequest;
use App\Http\Requests\Backend\Page\DeleteRequest;
use App\Http\Requests\Backend\Page\UpdateRequest;

/**
 * Class PageController.
 */
class PageController extends Controller
{
    /**
     * @var PageRepository
     */
    protected $pages;

    /**
     * @param PageRepository $pages
     */
    public function __construct(PageRepository $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.pages.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.pages.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->pages->create($request->all());

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.created'));
    }

    /**
     * @param Page              $page
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Page $page, EditRequest $request)
    {
        return view('backend.pages.edit')
            ->withPage($page);
    }

    /**
     * @param Page              $page
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Page $page, UpdateRequest $request)
    {
        $this->pages->update($page, $request->all());

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.updated'));
    }

    /**
     * @param Page              $page
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Page $page, DeleteRequest $request)
    {
        //$page = $this->pages->find($id);

        $this->pages->delete($page);

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.deleted'));
    }
}
