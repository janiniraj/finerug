<?php

namespace App\Http\Controllers\Backend\Material;

use App\Models\Material\Material;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Material\MaterialRepository;
use App\Http\Requests\Backend\Material\StoreRequest;
use App\Http\Requests\Backend\Material\ManageRequest;
use App\Http\Requests\Backend\Material\EditRequest;
use App\Http\Requests\Backend\Material\CreateRequest;
use App\Http\Requests\Backend\Material\DeleteRequest;
use App\Http\Requests\Backend\Material\UpdateRequest;

/**
 * Class MaterialController.
 */
class MaterialController extends Controller
{
    /**
     * @var MaterialRepository
     */
    protected $materials;

    /**
     * @param MaterialRepository $materials
     */
    public function __construct(MaterialRepository $materials)
    {
        $this->materials = $materials;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.materials.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.materials.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->materials->create($request->all());

        return redirect()->route('admin.materials.index')->withFlashSuccess(trans('alerts.backend.materials.created'));
    }

    /**
     * @param Material              $material
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Material $material, EditRequest $request)
    {
        return view('backend.materials.edit')
            ->withMaterial($material);
    }

    /**
     * @param Material              $material
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Material $material, UpdateRequest $request)
    {
        $this->materials->update($material, $request->all());

        return redirect()->route('admin.materials.index')->withFlashSuccess(trans('alerts.backend.materials.updated'));
    }

    /**
     * @param Material              $material
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Material $material, DeleteRequest $request)
    {
        $this->materials->delete($material);

        return redirect()->route('admin.materials.index')->withFlashSuccess(trans('alerts.backend.materials.deleted'));
    }
}
