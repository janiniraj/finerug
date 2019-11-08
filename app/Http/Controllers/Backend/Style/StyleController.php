<?php

namespace App\Http\Controllers\Backend\Style;

use App\Models\Style\Style;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Style\StyleRepository;
use App\Http\Requests\Backend\Style\StoreRequest;
use App\Http\Requests\Backend\Style\ManageRequest;
use App\Http\Requests\Backend\Style\EditRequest;
use App\Http\Requests\Backend\Style\CreateRequest;
use App\Http\Requests\Backend\Style\DeleteRequest;
use App\Http\Requests\Backend\Style\UpdateRequest;

/**
 * Class StyleController.
 */
class StyleController extends Controller
{
    /**
     * @var StyleRepository
     */
    protected $styles;

    /**
     * @param StyleRepository $styles
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
    public function index(ManageRequest $request)
    {
        return view('backend.styles.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.styles.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->styles->create($request->all());

        return redirect()->route('admin.styles.index')->withFlashSuccess(trans('alerts.backend.styles.created'));
    }

    /**
     * @param Style              $style
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Style $style, EditRequest $request)
    {
        return view('backend.styles.edit')
            ->withStyle($style);
    }

    /**
     * @param Style              $style
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Style $style, UpdateRequest $request)
    {
        $this->styles->update($style, $request->all());

        return redirect()->route('admin.styles.index')->withFlashSuccess(trans('alerts.backend.styles.updated'));
    }

    /**
     * @param Style              $style
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Style $style, DeleteRequest $request)
    {
        //$style = $this->styles->find($id);

        $this->styles->delete($style);

        return redirect()->route('admin.styles.index')->withFlashSuccess(trans('alerts.backend.styles.deleted'));
    }
}
