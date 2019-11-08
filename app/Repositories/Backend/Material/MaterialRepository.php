<?php

namespace App\Repositories\Backend\Material;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Material\Material;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class MaterialRepository.
 */
class MaterialRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Material::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.material_table').'.id',
                config('access.material_table').'.name',
                config('access.material_table').'.status',
                config('access.material_table').'.created_at',
                config('access.material_table').'.updated_at',
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
            throw new GeneralException(trans('exceptions.backend.materials.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $materials = self::MODEL;
            $materials = new $materials();
            $materials->name = $input['name'];
            $materials->status = (isset($input['status']) && $input['status'] == 1)
                ? 1 : 0;

            if ($materials->save()) {

                // event(new MaterialCreated($materials));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.materials.create_error'));
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

    public function update(Model $materials, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $materials->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.materials.already_exists'));
        }
        $materials->name = $input['name'];
        $materials->status = (isset($input['status']) && $input['status'] == 1)
            ? 1 : 0;

        DB::transaction(function () use ($materials, $input) {
            if ($materials->save()) {
                // event(new MaterialUpdated($materials));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.materials.update_error')
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
                // event(new MaterialDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.materials.delete_error'));
        });
    }
}