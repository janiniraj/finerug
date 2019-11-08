<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Page\PageRepository;
use App\Http\Requests\Backend\Page\ManageRequest;
use Carbon\Carbon;

/**
 * Class PageTableController.
 */
class PageTableController extends Controller
{
    /**
     * @var PageRepository
     */
    protected $pages;

    /**
     * @param PageRepository $cmspages
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
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->pages->getForDataTable())
            ->escapeColumns(['name'])
            ->escapeColumns(['slug'])
            ->addColumn('created_at', function ($pages) {
                return Carbon::parse($pages->created_at)->toDateString();
            })
            ->addColumn('actions', function ($pages) {
                return $pages->action_buttons;
            })
            ->make(true);
    }
}
