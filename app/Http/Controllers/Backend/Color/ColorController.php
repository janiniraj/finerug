<?php

namespace App\Http\Controllers\Backend\Color;

use App\Models\Color\Color;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Color\ColorRepository;
use App\Http\Requests\Backend\Color\StoreRequest;
use App\Http\Requests\Backend\Color\ManageRequest;
use App\Http\Requests\Backend\Color\EditRequest;
use App\Http\Requests\Backend\Color\CreateRequest;
use App\Http\Requests\Backend\Color\DeleteRequest;
use App\Http\Requests\Backend\Color\UpdateRequest;

/**
 * Class ColorController.
 */
class ColorController extends Controller
{
    /**
     * @var ColorRepository
     */
    protected $colors;

    /**
     * @param ColorRepository $colors
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
    public function index(ManageRequest $request)
    {
        return view('backend.colors.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.colors.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->colors->create($request->all());

        return redirect()->route('admin.colors.index')->withFlashSuccess(trans('alerts.backend.colors.created'));
    }

    /**
     * @param Color              $color
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Color $color, EditRequest $request)
    {
        return view('backend.colors.edit')
            ->withColor($color);
    }

    /**
     * @param Color              $color
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Color $color, UpdateRequest $request)
    {
        $this->colors->update($color, $request->all());

        return redirect()->route('admin.colors.index')->withFlashSuccess(trans('alerts.backend.colors.updated'));
    }

    /**
     * @param Color              $color
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Color $color, DeleteRequest $request)
    {
        $this->colors->delete($color);

        return redirect()->route('admin.colors.index')->withFlashSuccess(trans('alerts.backend.colors.deleted'));
    }
}
