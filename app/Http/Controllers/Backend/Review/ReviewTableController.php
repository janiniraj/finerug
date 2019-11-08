<?php

namespace App\Http\Controllers\Backend\Review;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Review\ReviewRepository;
use App\Http\Requests\Backend\Review\ManageRequest;
use Carbon\Carbon;

/**
 * Class ReviewTableController.
 */
class ReviewTableController extends Controller
{
    /**
     * @var ReviewRepository
     */
    protected $reviews;

    /**
     * @param ReviewRepository $cmsreviews
     */
    public function __construct(ReviewRepository $reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->reviews->getForDataTable())
            ->escapeColumns(['title', 'content'])
            ->addColumn('star', function($reviews){
                $html = '';

                for($i = 0; $i <$reviews->star; $i++)
                {
                    $html .= '<i class="fa fa-star fa-review"></i>';
                }
                return $html;
            })
            ->addColumn('product_name', function($reviews){
                //return '<a target="_blank" href="'.route('frontend.product.show', $reviews->product_id).'">'.$reviews->product_name.'</a>';
                return '<a target="_blank" href="'.env('MAIN_SITE_URL').'/product/'.$reviews->product_id.'">'.$reviews->product_name.'</a>';
            })
            ->addColumn('created_at', function ($reviews) {
                return Carbon::parse($reviews->created_at)->toDateString();
            })
            ->addColumn('actions', function ($reviews) {
                return $reviews->action_buttons;
            })
            ->make(true);
    }
}
