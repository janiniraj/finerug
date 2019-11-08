<?php

namespace App\Http\Controllers\Backend\Visitor;

use App\Models\Visitor\Visitor;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Visitor\VisitorRepository;
use App\Http\Requests\Backend\Visitor\VisitorRequest;
use App\Http\Requests\Backend\Visitor\ManageRequest;
use App\Http\Requests\Backend\Visitor\EditRequest;
use App\Http\Requests\Backend\Visitor\CreateRequest;
use App\Http\Requests\Backend\Visitor\DeleteRequest;
use App\Http\Requests\Backend\Visitor\UpdateRequest;

/**
 * Class VisitorController.
 */
class VisitorController extends Controller
{
    /**
     * @var VisitorRepository
     */ 
    protected $visitors;

    /**
     * @param VisitorRepository $visitors
     */
    public function __construct(VisitorRepository $visitors)
    {
        $this->visitors = $visitors;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.visitors.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.visitors.create');
    }

    /**
     * @param VisitorRequest $request
     *
     * @return mixed
     */
    public function store(VisitorRequest $request)
    {
        $this->visitors->create($request->all());

        return redirect()->route('admin.visitors.index')->withFlashSuccess(trans('alerts.backend.visitors.created'));
    }

    /**
     * @param Visitor              $visitor
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Visitor $visitor, EditRequest $request)
    {
        return view('backend.visitors.edit')
            ->withVisitor($visitor);
    }

    /**
     * @param Visitor              $visitor
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Visitor $visitor, UpdateRequest $request)
    {
        $this->visitors->update($visitor, $request->all());

        return redirect()->route('admin.visitors.index')->withFlashSuccess(trans('alerts.backend.visitors.updated'));
    }

    /**
     * @param Visitor              $visitor
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Visitor $visitor, DeleteRequest $request)
    {
        //$visitor = $this->visitors->find($id);

        $this->visitors->delete($visitor);

        return redirect()->route('admin.visitors.index')->withFlashSuccess(trans('alerts.backend.visitors.deleted'));
    }
}
