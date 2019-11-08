<?php

namespace App\Http\Controllers\Backend\Color;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Color\ColorRepository;
use App\Http\Requests\Backend\Color\ManageRequest;
use Carbon\Carbon;

/**
 * Class ColorTableController.
 */
class ColorTableController extends Controller
{
    /**
     * @var ColorRepository
     */
    protected $colors;

    /**
     * @param ColorRepository $cmspages
     */
    public function __construct(ColorRepository $colors)
    {
        $this->colors = $colors;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->colors->getForDataTable())
            ->escapeColumns([])
            ->addColumn('name', function ($colors) {
                return '<span class="color-btn" style="background-color: '.$colors->name.'"> </span>'.$colors->name;
            })
            ->addColumn('status', function ($colors) {
                if ($colors->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($colors) {
                return Carbon::parse($colors->created_at)->toDateString();
            })
            ->addColumn('actions', function ($colors) {
                return $colors->action_buttons;
            })
            ->make(true);
    }
}
