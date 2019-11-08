<?php

namespace App\Repositories\Backend\Style;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Style\Style;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class StyleRepository.
 */
class StyleRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Style::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.style_table').'.id',
                config('access.style_table').'.name',
                config('access.style_table').'.status',
                config('access.style_table').'.created_at',
                config('access.style_table').'.updated_at',
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
            throw new GeneralException(trans('exceptions.backend.styles.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $styles = self::MODEL;
            $styles = new $styles();
            $styles->name = $input['name'];
            $styles->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

            if ($styles->save()) {

                // event(new StyleCreated($styles));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.styles.create_error'));
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
     
    public function update(Model $styles, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $styles->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.styles.already_exists'));
        }
        $styles->name = $input['name'];
        $styles->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

        DB::transaction(function () use ($styles, $input) {
        	if ($styles->save()) {
                // event(new StyleUpdated($styles));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.styles.update_error')
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
                // event(new StyleDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.styles.delete_error'));
        });
    }
}