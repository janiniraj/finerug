<?php

namespace App\Repositories\Backend\Activity;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Activity\Activity;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class ActivityRepository.
 */
class ActivityRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Activity::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin('users', 'users.id', '=', 'activities.user_id')
            ->leftJoin('products', 'products.id', '=', 'activities.product_id')
            ->select([
                config('access.activity_table').'.id',
                config('access.activity_table').'.product_id',
                //config('access.activity_table').'.name',
                config('access.activity_table').'.activity',
                config('access.activity_table').'.created_at',
                config('access.activity_table').'.updated_at',
                'users.first_name',
                'products.name',
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
            throw new GeneralException(trans('exceptions.backend.activities.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $activities = self::MODEL;
            $activities = new $activities();
            $activities->name = $input['name'];
            $activities->status = (isset($input['status']) && $input['status'] == 1)
                ? 1 : 0;

            if ($activities->save()) {

                // event(new ActivityCreated($activities));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.activities.create_error'));
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

    public function update(Model $activities, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $activities->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.activities.already_exists'));
        }
        $activities->name = $input['name'];
        $activities->status = (isset($input['status']) && $input['status'] == 1)
            ? 1 : 0;

        DB::transaction(function () use ($activities, $input) {
            if ($activities->save()) {
                // event(new ActivityUpdated($activities));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.activities.update_error')
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
                // event(new ActivityDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.activities.delete_error'));
        });
    }
}