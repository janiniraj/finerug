<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Product\ProductRepository;
use App\Http\Requests\Request;

/**
 * Class ProductTableController.
 */
class ProductTableController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @param ProductRepository $products
     */
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return Datatables::of($this->products->getForDataTable())
            ->escapeColumns(['name', 'sku', 'sort'])
            ->addColumn('actions', function ($product) {
                return $product->action_buttons;
            })
            ->make(true);
    }
}
