<?php

namespace App\Repositories\Backend\Color;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Color\Color;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class ColorRepository.
 */
class ColorRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Color::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.color_table').'.id',
                config('access.color_table').'.name',
                config('access.color_table').'.display_name',
                config('access.color_table').'.status',
                config('access.color_table').'.created_at',
                config('access.color_table').'.updated_at',
            ])
            ->orderBy(config('access.color_table').'.display_name');
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
            throw new GeneralException(trans('exceptions.backend.colors.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $colors = self::MODEL;
            $colors = new $colors();
            $colors->name = $input['name'];
            $colors->display_name = $input['display_name'];
            $colors->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;
             $colors->is_menu = (isset($input['is_menu']) && $input['is_menu'] == 1)
                 ? 1 : 0;

            if ($colors->save()) {

                // event(new ColorCreated($colors));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.colors.create_error'));
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
     
    public function update(Model $colors, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $colors->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.colors.already_exists'));
        }
        $colors->name = $input['name'];
        $colors->display_name = $input['display_name'];
        $colors->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

        $colors->is_menu = (isset($input['is_menu']) && $input['is_menu'] == 1)
                 ? 1 : 0;

        DB::transaction(function () use ($colors, $input) {
        	if ($colors->save()) {
                // event(new ColorUpdated($colors));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.colors.update_error')
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
                // event(new ColorDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.colors.delete_error'));
        });
    }

    public function getAllActive()
    {
        return $this->query()->where('status', 1)->get();
    }
}