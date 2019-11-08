<?php

namespace App\Repositories\Backend\Weave;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Weave\Weave;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class WeaveRepository.
 */
class WeaveRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Weave::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.weave_table').'.id',
                config('access.weave_table').'.name',
                config('access.weave_table').'.status',
                config('access.weave_table').'.created_at',
                config('access.weave_table').'.updated_at',
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
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.weaves.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $weaves = self::MODEL;
            $weaves = new $weaves();
            $weaves->name = $input['name'];
            $weaves->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

            if ($weaves->save()) {

                // event(new WeaveCreated($weaves));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.weaves.create_error'));
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
     
    public function update(Model $weaves, array $input)
    {
        if(!$weaves->id)
        {
            $weaves = $this->query()->where('id', $input['id'])->first();
        }

        if ($this->query()->where('name', $input['name'])->where('id', '!=', $weaves->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.weaves.already_exists'));
        }
        $weaves->name = $input['name'];
        $weaves->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

        DB::transaction(function () use ($weaves, $input) {
        	if ($weaves->save()) {
                // event(new WeaveUpdated($weaves));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.weaves.update_error')
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
                // event(new WeaveDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.weaves.delete_error'));
        });
    }
}