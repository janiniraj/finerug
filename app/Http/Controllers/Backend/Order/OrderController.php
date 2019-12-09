<?php

namespace App\Http\Controllers\Backend\Order;

use App\Models\Order\Order;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Order\OrderRepository;
use App\Http\Requests\Backend\Order\StoreRequest;
use App\Http\Requests\Backend\Order\ManageRequest;
use App\Http\Requests\Backend\Order\EditRequest;
use App\Http\Requests\Backend\Order\CreateRequest;
use App\Http\Requests\Backend\Order\DeleteRequest;
use App\Http\Requests\Backend\Order\UpdateRequest;

/**
 * Class OrderController.
 */
class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $orders;

    /**
     * @param OrderRepository $orders
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
    public function index(ManageRequest $request)
    {
        return view('backend.orders.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.orders.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->orders->create($request->all());

        return redirect()->route('admin.orders.index')->withFlashSuccess(trans('alerts.backend.orders.created'));
    }

    /**
     * @param Order              $order
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Order $order, EditRequest $request)
    {
        return view('backend.orders.edit')
            ->withOrder($order);
    }

    /**
     * @param Order              $order
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Order $order, UpdateRequest $request)
    {
        $this->orders->update($order, $request->all());

        return redirect()->route('admin.orders.index')->withFlashSuccess(trans('alerts.backend.orders.updated'));
    }

    /**
     * @param Order              $order
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Order $order, DeleteRequest $request)
    {
        $this->orders->delete($order);

        return redirect()->route('admin.orders.index')->withFlashSuccess(trans('alerts.backend.orders.deleted'));
    }

    public function show(Order $order, $orderId)
    {
        $orderData = $order->find($orderId);
        return view('backend.orders.show')->with([
            'orderData' => $orderData
        ]);
    }
}
