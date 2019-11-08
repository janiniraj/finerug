<?php

namespace App\Http\Controllers\Backend\Style;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Style\StyleRepository;
use App\Http\Requests\Backend\Style\ManageRequest;
use Carbon\Carbon;

/**
 * Class StyleTableController.
 */
class StyleTableController extends Controller
{
    /**
     * @var StyleRepository
     */
    protected $styles;

    /**
     * @param StyleRepository $cmspages
     */
    public function __construct(StyleRepository $styles)
    {
        $this->styles = $styles;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->styles->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($styles) {
                if ($styles->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($styles) {
                return Carbon::parse($styles->created_at)->toDateString();
            })
            ->addColumn('actions', function ($styles) {
                return $styles->action_buttons;
            })
            ->make(true);
    }
}
