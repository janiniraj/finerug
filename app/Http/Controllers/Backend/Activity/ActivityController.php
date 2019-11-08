<?php

namespace App\Http\Controllers\Backend\Activity;

use App\Models\Activity\Activity;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Activity\ActivityRepository;
use App\Http\Requests\Backend\Activity\StoreRequest;
use App\Http\Requests\Backend\Activity\ManageRequest;
use App\Http\Requests\Backend\Activity\EditRequest;
use App\Http\Requests\Backend\Activity\CreateRequest;
use App\Http\Requests\Backend\Activity\DeleteRequest;
use App\Http\Requests\Backend\Activity\UpdateRequest;

/**
 * Class ActivityController.
 */
class ActivityController extends Controller
{
    /**
     * @var ActivityRepository
     */
    protected $activities;

    /**
     * @param ActivityRepository $activities
     */
    public function __construct(ActivityRepository $activities)
    {
        $this->activities = $activities;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.activities.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.activities.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->activities->create($request->all());

        return redirect()->route('admin.activities.index')->withFlashSuccess(trans('alerts.backend.activities.created'));
    }

    /**
     * @param Activity              $activity
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Activity $activity, EditRequest $request)
    {
        return view('backend.activities.edit')
            ->withActivity($activity);
    }

    /**
     * @param Activity              $activity
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Activity $activity, UpdateRequest $request)
    {
        $this->activities->update($activity, $request->all());

        return redirect()->route('admin.activities.index')->withFlashSuccess(trans('alerts.backend.activities.updated'));
    }

    /**
     * @param Activity              $activity
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Activity $activity, DeleteRequest $request)
    {
        $this->activities->delete($activity);

        return redirect()->route('admin.activities.index')->withFlashSuccess(trans('alerts.backend.activities.deleted'));
    }
}
