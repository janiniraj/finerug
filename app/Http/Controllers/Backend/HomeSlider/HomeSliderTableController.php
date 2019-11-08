<?php

namespace App\Http\Controllers\Backend\HomeSlider;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\HomeSlider\HomeSliderRepository;
use App\Http\Requests\Backend\HomeSlider\ManageRequest;
use Carbon\Carbon;
use URL;

/**
 * Class HomeSliderTableController.
 */
class HomeSliderTableController extends Controller
{
    /**
     * @var HomeSliderRepository
     */
    protected $homeslider;

    /**
     * @param HomeSliderRepository $homeslider
     */
    public function __construct(HomeSliderRepository $homeslider)
    {
        $this->homeslider = $homeslider;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->homeslider->getForDataTable())
            ->escapeColumns([])
            ->addColumn('type', function($homesliders){
                return $homesliders->type == 'youtubevideo' ? 'Video' : 'Image';
            })
            ->addColumn('image', function ($homesliders) {
                if ($homesliders->type == 'youtubevideo') {
                    return '<a target="__blank" href="https://www.youtube.com/watch?v='.$homesliders->youtubevideo_id.'" class="label label-success">Video Link</a>';
                }
                $imageUrl = URL::to('/').'/img/sliders/'.$homesliders->image;
                return '<a target="__blank" href="'.$imageUrl.'" class="label label-danger">Image Link</a>';
            })
            /*->addColumn('image', function ($homesliders) {
                if ($homesliders->type == 'youtubevideo') {
                    return '<a target="_blank" href="https://www.youtube.com/watch?v='.$homesliders->youtubevideo_id.'">Video</a>';
                }
                $imageUrl = URL::to('/').'/img/sliders/'.$homesliders->image;
                return '<a target="_blank" href="'.$imageUrl.'">Image</a>';
            })*/
            ->addColumn('created_at', function ($homesliders) {
                return Carbon::parse($homesliders->created_at)->toDateString();
            })
            ->addColumn('actions', function ($homesliders) {
                return $homesliders->action_buttons;
            })
            ->make(true);
    }
}
