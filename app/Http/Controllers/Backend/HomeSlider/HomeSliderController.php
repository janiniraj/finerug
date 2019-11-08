<?php

namespace App\Http\Controllers\Backend\HomeSlider;

use App\Models\Categories\Category;
use App\Models\HomeSlider\HomeSlider;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\HomeSlider\HomeSliderRepository;
use App\Http\Requests\Backend\HomeSlider\StoreRequest;
use App\Http\Requests\Backend\HomeSlider\ManageRequest;
use App\Http\Requests\Backend\HomeSlider\EditRequest;
use App\Http\Requests\Backend\HomeSlider\CreateRequest;
use App\Http\Requests\Backend\HomeSlider\DeleteRequest;
use App\Http\Requests\Backend\HomeSlider\UpdateRequest;
use App\Repositories\Backend\Page\PageRepository;

/**
 * Class HomeSliderController.
 */
class HomeSliderController extends Controller
{
    /**
     * @var HomeSliderRepository
     */
    protected $homeSlider;

    /**
     * @param HomeSliderRepository $homeSlider
     */
    public function __construct(HomeSliderRepository $homeSlider)
    {
        $this->homeSlider       = $homeSlider;
        $this->pageRepository   = new PageRepository();
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.homeSlider.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        $pages = $this->pageRepository->getAll()->pluck('name', 'slug')->toArray();
        $pages = array_merge(['homepage' => 'Home Page'], $pages);

        return view('backend.homeSlider.create')->with([
            'pages' => $pages
        ]);
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->homeSlider->create($request->all());

        return redirect()->route('admin.home-slider.index')->withFlashSuccess('Record Successfully Created');
    }

    /**
     * @param HomeSlider              $homeslider
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit($id, HomeSlider $homeslider, EditRequest $request)
    {
        $homeslider = $this->homeSlider->find($id);

        $pages = $this->pageRepository->getAll()->pluck('name', 'slug')->toArray();
        $pages = array_merge(['homepage' => 'Home Page'], $pages);
        return view('backend.homeSlider.edit', compact('homeslider'))->with([
            'pages' => $pages
        ]);
    }

    /**
     * @param HomeSlider              $homeslider
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(HomeSlider $homeslider, UpdateRequest $request)
    {
        $this->homeSlider->update($homeslider, $request->all());

        return redirect()->route('admin.home-slider.index')->withFlashSuccess('Record Successfully Updated');
    }

    /**
     * @param HomeSlider              $homeslider
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy($id, HomeSlider $homeslider, DeleteRequest $request)
    { 
        $this->homeSlider->query()->where('id', $id)->delete();

        return redirect()->route('admin.home-slider.index')->withFlashSuccess('Record Successfully Deleted');
    }
}
