<?php

namespace App\Repositories\Backend\Promo;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Promo\Promo;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class PromoRepository.
 */
class PromoRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Promo::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.promo_table').'.id',
                config('access.promo_table').'.name',
                config('access.promo_table').'.status',
                config('access.promo_table').'.created_at',
                config('access.promo_table').'.updated_at',
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
            throw new GeneralException(trans('exceptions.backend.promos.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $promos = self::MODEL;
            $promos = new $promos();
            $promos->name = $input['name'];
            $promos->code = $input['code'];
            $promos->type = $input['type'];
            $promos->discount = $input['discount'];
            $promos->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

            if ($promos->save()) {

                // event(new PromoCreated($promos));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.promos.create_error'));
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
     
    public function update(Model $promos, array $input)
    {
        if(!$promos->id)
        {
            $promos = $this->query()->where('id', $input['id'])->first();
        }

        if ($this->query()->where('name', $input['name'])->where('id', '!=', $promos->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.promos.already_exists'));
        }
        $promos->name = $input['name'];
        $promos->code = $input['code'];
        $promos->type = $input['type'];
        $promos->discount = $input['discount'];
        $promos->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

        DB::transaction(function () use ($promos, $input) {
        	if ($promos->save()) {
                // event(new PromoUpdated($promos));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.promos.update_error')
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
                // event(new PromoDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.promos.delete_error'));
        });
    }
}