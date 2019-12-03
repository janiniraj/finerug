<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Order\OrderRepository;
use App\Http\Requests\Backend\Order\ManageRequest;
use Carbon\Carbon;
use URL;

/**
 * Class OrderTableController.
 */
class OrderTableController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $orders;

    /**
     * @param OrderRepository $cmspages
     */
    public function __construct(OrderRepository $orders)
    {
        $this->orders = $orders;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->orders->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($orders) {
                if ($orders->status) {
                    return '<span class="label label-success">'.ucfirst($orders->status).'</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($orders) {
                return Carbon::parse($orders->created_at)->toDateString();
            })
            ->addColumn('actions', function ($orders) {
                $viewUrl = URL::to('admin/order/' . $orders->id . '/show');
                $deleteUrl = URL::to('admin/orders/' . $orders->id );
                return '<div class="">
                            <a class="btn btn-flat btn-default" href="'.$viewUrl.'">
                                <i data-toggle="tooltip" data-placement="top" title="View" class="fa fa-pencil"></i>
                            </a>
                            <a class="btn btn-flat btn-default" href="'.$deleteUrl.'" data-method="delete" data-trans-button-cancel="Cancel" data-trans-button-confirm="Delete" data-trans-title="Are you sure you want to do this?">
                                <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                            </a>
                        </div>';
                //return $orders->action_buttons;
            })
            ->make(true);
    }
}
