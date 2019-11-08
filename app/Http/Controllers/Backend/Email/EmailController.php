<?php

namespace App\Http\Controllers\Backend\Email;

use App\Models\Email\Email;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Email\EmailRepository;
use App\Http\Requests\Backend\Email\StoreRequest;
use App\Http\Requests\Backend\Email\ManageRequest;
use App\Http\Requests\Backend\Email\EditRequest;
use App\Http\Requests\Backend\Email\CreateRequest;
use App\Http\Requests\Backend\Email\DeleteRequest;
use App\Http\Requests\Backend\Email\UpdateRequest;
use App\Models\Access\User\User;
use App\Models\Mailinglist\Mailinglist;

/**
 * Class EmailController.
 */
class EmailController extends Controller
{
    /**
     * @var EmailRepository
     */
    protected $emails;

    /**
     * @param EmailRepository $emails
     */
    public function __construct(EmailRepository $emails)
    {
        $this->emails = $emails;
        $this->user   = new User();
        $this->mailinglist = new Mailinglist();
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        return view('backend.emails.index');
    }

    /**
     * @param CreateRequest $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        $userList = $this->user->pluck('first_name', 'id');

        $mailingList = $this->mailinglist->pluck('firstname', 'id');

        return view('backend.emails.create')->with(['userList' => $userList, 'mailingList' => $mailingList]);
    }

    /**
     * @param StoreRequest $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->emails->create($request->all());

        return redirect()->route('admin.emails.index')->withFlashSuccess(trans('alerts.backend.emails.created'));
    }

    /**
     * @param Email              $email
     * @param EditRequest $request
     *
     * @return mixed
     */
    public function edit($id, Email $email, EditRequest $request)
    {
        $emailData = $email->find($id);
        return view('backend.emails.edit')
            ->withEmail($emailData);
    }

    /**
     * @param Email              $email
     * @param UpdateRequest $request
     *
     * @return mixed
     */
    public function update(Email $email, UpdateRequest $request)
    {
        $this->emails->update($email, $request->all());

        return redirect()->route('admin.emails.index')->withFlashSuccess(trans('alerts.backend.emails.updated'));
    }

    /**
     * @param Email              $email
     * @param DeleteRequest $request
     *
     * @return mixed
     */
    public function destroy($id, Email $email, DeleteRequest $request)
    {
        $email = $this->emails->find($id);

        $this->emails->delete($email);

        return redirect()->route('admin.emails.index')->withFlashSuccess(trans('alerts.backend.emails.deleted'));
    }
}
