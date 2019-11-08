<?php

namespace App\Http\Controllers\Backend\Mailinglist;

use App\Models\Mailinglist\Mailinglist;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Mailinglist\MailinglistRepository;
use App\Http\Requests\Backend\Mailinglist\MailinglistRequest;
use App\Http\Requests\Backend\Mailinglist\ManageRequest;
use App\Http\Requests\Backend\Mailinglist\EditRequest;
use App\Http\Requests\Backend\Mailinglist\CreateRequest;
use App\Http\Requests\Backend\Mailinglist\DeleteRequest;
use App\Http\Requests\Backend\Mailinglist\UpdateRequest;

/**
 * Class MailinglistController.
 */
class MailinglistController extends Controller
{
    /**
     * @var MailinglistRepository
     */ 
    protected $mailinglists;

    /**
     * @param MailinglistRepository $mailinglists
     */
    public function __construct(MailinglistRepository $mailinglists)
    {
        $this->mailinglists = $mailinglists;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.mailinglists.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        return view('backend.mailinglists.create');
    }

    /**
     * @param MailinglistRequest $request
     *
     * @return mixed
     */
    public function mailinglist(MailinglistRequest $request)
    {
        $this->mailinglists->create($request->all());

        return redirect()->route('admin.mailinglists.index')->withFlashSuccess(trans('alerts.backend.mailinglists.created'));
    }

    /**
     * @param Mailinglist              $mailinglist
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit(Mailinglist $mailinglist, EditRequest $request)
    {
        return view('backend.mailinglists.edit')
            ->withMailinglist($mailinglist);
    }

    /**
     * @param Mailinglist              $mailinglist
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Mailinglist $mailinglist, UpdateRequest $request)
    {
        $this->mailinglists->update($mailinglist, $request->all());

        return redirect()->route('admin.mailinglists.index')->withFlashSuccess(trans('alerts.backend.mailinglists.updated'));
    }

    /**
     * @param Mailinglist              $mailinglist
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy(Mailinglist $mailinglist, DeleteRequest $request)
    {
        //$mailinglist = $this->mailinglists->find($id);

        $this->mailinglists->delete($mailinglist);

        return redirect()->route('admin.mailinglists.index')->withFlashSuccess(trans('alerts.backend.mailinglists.deleted'));
    }
}
