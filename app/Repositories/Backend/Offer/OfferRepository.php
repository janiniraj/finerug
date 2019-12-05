<?php

namespace App\Repositories\Backend\Offer;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Offer\Offer;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class OfferRepository.
 */
class OfferRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Offer::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin(config('access.product_table'),config('access.product_table').'.id','=',config('access.offer_table').'.product_id')
            ->select([
                config('access.offer_table').'.id',
                config('access.offer_table').'.first_name',
                config('access.offer_table').'.last_name',
                config('access.offer_table').'.product_id',
                config('access.offer_table').'.email',
                config('access.offer_table').'.phone',
                config('access.offer_table').'.offer_price',
                config('access.offer_table').'.created_at',
                config('access.offer_table').'.updated_at',
                config('access.product_table').'.name as product_name'
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
            throw new GeneralException(trans('exceptions.backend.offers.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $offers = self::MODEL;
            $offers = new $offers();
            $offers->first_name = $input['first_name'];
            $offers->last_name = $input['last_name'];
            $offers->email = $input['email'];
            $offers->phone = $input['phone'];
            $offers->offer_price = $input['offer_price'];
            $offers->product_id = $input['product_id'];

            if ($offers->save()) {

                // event(new OfferCreated($offers));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.offers.create_error'));
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

    public function update(Model $offers, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $offers->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.offers.already_exists'));
        }
        $offers->name = $input['name'];
        $offers->status = (isset($input['status']) && $input['status'] == 1)
            ? 1 : 0;

        DB::transaction(function () use ($offers, $input) {
            if ($offers->save()) {
                // event(new OfferUpdated($offers));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.offers.update_error')
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
                // event(new OfferDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.offers.delete_error'));
        });
    }
}