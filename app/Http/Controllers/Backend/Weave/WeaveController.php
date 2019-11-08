<?php

namespace App\Http\Controllers\Backend\Weave;

use App\Models\Weave\Weave;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Weave\WeaveRepository;
use App\Http\Requests\Backend\Weave\StoreRequest;
use App\Http\Requests\Backend\Weave\ManageRequest;
use App\Http\Requests\Backend\Weave\EditRequest;
use App\Http\Requests\Backend\Weave\CreateRequest;
use App\Http\Requests\Backend\Weave\DeleteRequest;
use App\Http\Requests\Backend\Weave\UpdateRequest;

/**
 * Class WeaveController.
 */
class WeaveController extends Controller
{
    /**
     * @var WeaveRepository
     */
    protected $weaves;

    /**
     * @param WeaveRepository $weaves
     */
    public function __construct(WeaveRepository $weaves)
    {
        $this->weaves = $weaves;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.weaves.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.weaves.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->weaves->create($request->all());

        return redirect()->route('admin.weaves.index')->withFlashSuccess(trans('alerts.backend.weaves.created'));
    }

    /**
     * @param Weave              $weave
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit($id, Weave $weave, EditRequest $request)
    {
        $weaveData = $weave->find($id);
        return view('backend.weaves.edit')
            ->withWeave($weaveData);
    }

    /**
     * @param Weave              $weave
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Weave $weave, UpdateRequest $request)
    {
        $this->weaves->update($weave, $request->all());

        return redirect()->route('admin.weaves.index')->withFlashSuccess(trans('alerts.backend.weaves.updated'));
    }

    /**
     * @param Weave              $weave
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy($id, Weave $weave, DeleteRequest $request)
    {
        $weave = $this->weaves->find($id);

        $this->weaves->delete($weave);

        return redirect()->route('admin.weaves.index')->withFlashSuccess(trans('alerts.backend.weaves.deleted'));
    }
}
