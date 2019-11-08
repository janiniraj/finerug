<?php

namespace App\Http\Controllers\Backend\Review;

use App\Models\Review\Review;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Review\ReviewRepository;
use App\Http\Requests\Backend\Review\StoreRequest;
use App\Http\Requests\Backend\Review\ManageRequest;
use App\Http\Requests\Backend\Review\EditRequest;
use App\Http\Requests\Backend\Review\CreateRequest;
use App\Http\Requests\Backend\Review\DeleteRequest;
use App\Http\Requests\Backend\Review\UpdateRequest;

/**
 * Class ReviewController.
 */
class ReviewController extends Controller
{
    /**
     * @var ReviewRepository
     */
    protected $reviews;

    /**
     * @param ReviewRepository $reviews
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
    public function index(ManageRequest $request)
    {
        return view('backend.reviews.index');
    }

    /**
     * @param Review              $review
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Review $review, DeleteRequest $request)
    {
        //$review = $this->reviews->find($id);

        $this->reviews->delete($review);

        return redirect()->route('admin.reviews.index')->withFlashSuccess(trans('alerts.backend.reviews.deleted'));
    }
}
