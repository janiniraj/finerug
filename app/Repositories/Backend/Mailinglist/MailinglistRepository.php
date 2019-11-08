<?php

namespace App\Repositories\Backend\Mailinglist;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Mailinglist\Mailinglist;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class MailinglistRepository.
 */
class MailinglistRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Mailinglist::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.mailinglist_table').'.id',
                config('access.mailinglist_table').'.firstname',
                config('access.mailinglist_table').'.lastname',
                config('access.mailinglist_table').'.email',
                config('access.mailinglist_table').'.pobox',
                config('access.mailinglist_table').'.phone',
                config('access.mailinglist_table').'.address',
                config('access.mailinglist_table').'.street',
                config('access.mailinglist_table').'.city',
                config('access.mailinglist_table').'.state',
                config('access.mailinglist_table').'.country',
                config('access.mailinglist_table').'.created_at',
                config('access.mailinglist_table').'.updated_at',
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
        if ($this->query()->where('slug', $input['slug'])->first()) {
            throw new GeneralException(trans('exceptions.backend.mailinglists.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $Mailinglists = self::MODEL;
            $Mailinglists = new $Mailinglists();
            $Mailinglists->name = $input['name'];
            $Mailinglists->slug = $input['slug'];
            $Mailinglists->content = $input['content'];

            if ($Mailinglists->save()) {

                // event(new MailinglistCreated($Mailinglists));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.mailinglists.create_error'));
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
     
    public function update(Model $Mailinglists, array $input)
    {
        if ($this->query()->where('slug', $input['slug'])->where('id', '!=', $Mailinglists->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.mailinglists.already_exists'));
        }
        $Mailinglists->name = $input['name'];
        $Mailinglists->slug = $input['slug'];
        $Mailinglists->content = $input['content'];

        DB::transaction(function () use ($Mailinglists, $input) {
        	if ($Mailinglists->save()) {
                // event(new MailinglistUpdated($Mailinglists));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.mailinglists.update_error')
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
                // event(new MailinglistDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.mailinglists.delete_error'));
        });
    }

}