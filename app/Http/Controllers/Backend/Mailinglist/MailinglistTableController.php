<?php

namespace App\Http\Controllers\Backend\Mailinglist;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Mailinglist\MailinglistRepository;
use App\Http\Requests\Backend\Mailinglist\ManageRequest;
use Carbon\Carbon;

/**
 * Class MailinglistTableController.
 */
class MailinglistTableController extends Controller
{
    /**
     * @var MailinglistRepository
     */
    protected $mailinglists;

    /**
     * @param MailinglistRepository $cmspages
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
    public function __invoke(ManageRequest $request)
    {
        return Datatables::of($this->mailinglists->getForDataTable())
            ->escapeColumns(['firstname','lastname','email','pobox', 'phone'])
            ->addColumn('address', function ($mailinglists) {
                $data = [];
                if(!empty($mailinglists->address))
                {
                    $data[] = $mailinglists->address;
                }
                if(!empty($mailinglists->street))
                {
                    $data[] = $mailinglists->street;
                }
                if(!empty($mailinglists->city))
                {
                    $data[] = $mailinglists->city;
                }
                if(!empty($mailinglists->state))
                {
                    $data[] = $mailinglists->state;
                }
                if(!empty($mailinglists->country))
                {
                    $data[] = $mailinglists->country;
                }

                return implode(" , ", $data);
            })
            ->addColumn('created_at', function ($mailinglists) {
                return Carbon::parse($mailinglists->created_at)->toDateString();
            })
            ->addColumn('actions', function ($mailinglists) {
                return $mailinglists->action_buttons;
            })
            ->make(true);
    }
}
