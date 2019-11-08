<?php

namespace App\Http\Controllers\Backend\Email;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Email\EmailRepository;
use App\Http\Requests\Backend\Email\ManageRequest;
use Carbon\Carbon;

/**
 * Class EmailTableController.
 */
class EmailTableController extends Controller
{
    /**
     * @var EmailRepository
     */
    protected $emails;

    /**
     * @param EmailRepository $cmspages
     */
    public function __construct(EmailRepository $emails)
    {
        $this->emails = $emails;
    }

    /**
     * @param ManageRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->emails->getForDataTable())
            ->escapeColumns(['subject'])
            ->addColumn('status', function ($emails) {
                if ($emails->status) {
                    return '<span class="label label-success">Sent</span>';
                }
                return '<span class="label label-danger">In Progress</span>';
            })
            ->addColumn('created_at', function ($emails) {
                return Carbon::parse($emails->created_at)->toDateString();
            })
            ->addColumn('actions', function ($emails) {
                return $emails->action_buttons;
            })
            ->make(true);
    }
}
