<?php

namespace App\Repositories\Backend\Email;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Email\Email;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB, Mail;
use App\Mail\promotion;
use App\Models\Access\User\User;
use App\Models\Mailinglist\Mailinglist;

/**
 * Class EmailRepository.
 */
class EmailRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Email::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.email_table').'.id',
                config('access.email_table').'.subject',
                config('access.email_table').'.created_at',
                config('access.email_table').'.updated_at',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        DB::transaction(function () use ($input) {
            $emails = self::MODEL;
            $emails = new $emails();
            if($input['type_users'] == 'all_user')
            {
                $emails->users = 'all';
            }
            else if($input['type_users'] == 'all_mailinglist')
            {
                $emails->mailinglist = 'all';
            }
            else if($input['type_users'] == 'specific_user')
            {
                $emails->users = json_encode($input['users']);
            }
            else
            {
                $emails->mailinglist = json_encode($input['mailinglist']);
            }

            $emails->subject = $input['subject'];
            $emails->content = $input['content'];

            $emails->status = 1;

            if ($emails->save()) {

                if($input['type_users'] == 'all_user')
                {
                    $userList = User::all();

                    foreach ($userList as $key => $value) 
                    {
                        Mail::to($value->email)
                        ->queue(new promotion($value, $input['subject'], $input['content']));
                    }
                }
                else if($input['type_users'] == 'all_mailinglist')
                {
                    $mailingList = Mailinglist::all();

                    foreach ($mailingList as $key => $value) 
                    {
                        Mail::to($value->email)
                        ->queue(new promotion($value, $input['subject'], $input['content']));
                    }
                }
                else if($input['type_users'] == 'specific_user')
                {
                    $userList = User::whereIn('id', $input['users'])->get();

                    foreach ($userList as $key => $value) 
                    {
                        Mail::to($value->email)
                        ->queue(new promotion($value, $input['subject'], $input['content']));
                    }
                }
                else
                {
                    $mailingList = Mailinglist::whereIn('id', $input['mailinglist'])->get();

                    foreach ($mailingList as $key => $value) 
                    {
                        Mail::to($value->email)
                        ->queue(new promotion($value, $input['subject'], $input['content']));
                    }
                }

                return true;
            }
            throw new GeneralException(trans('exceptions.backend.emails.create_error'));
        });
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
     
    public function update(Model $emails, array $input)
    {
        if(!$emails->id)
        {
            $emails = $this->query()->where('id', $input['id'])->first();
        }

        if ($this->query()->where('name', $input['name'])->where('id', '!=', $emails->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.emails.already_exists'));
        }
        $emails->name = $input['name'];
        $emails->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

        DB::transaction(function () use ($emails, $input) {
        	if ($emails->save()) {
                // event(new EmailUpdated($emails));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.emails.update_error')
            );
        });
    }

    /**
     * @param Model $category
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $category)
    {
        DB::transaction(function () use ($category) {

            if ($category->delete()) {
                // event(new EmailDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.emails.delete_error'));
        });
    }
}