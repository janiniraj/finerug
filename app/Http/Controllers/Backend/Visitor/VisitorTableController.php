<?php

namespace App\Http\Controllers\Backend\Visitor;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Visitor\VisitorRepository;
use App\Http\Requests\Backend\Visitor\ManageRequest;
use Carbon\Carbon;

/**
 * Class VisitorTableController.
 */
class VisitorTableController extends Controller
{
    /**
     * @var VisitorRepository
     */
    protected $visitors;

    /**
     * @param VisitorRepository $cmspages
     */
    public function __construct(VisitorRepository $visitors)
    {
        $this->visitors = $visitors;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->visitors->getForDataTable())
            ->escapeColumns(['name', 'country_code', 'zip_code'])
            ->addColumn('country_code', function ($visitors) {
                return isset(config('constant.countryCodeList')[$visitors->country_code]) ? config('constant.countryCodeList')[$visitors->country_code] : $visitors->country_code;
            })
            ->addColumn('created_at', function ($visitors) {
                return Carbon::parse($visitors->created_at)->toDateString();
            })
            ->make(true);
    }
}
