<?php

namespace App\Repositories\Backend\Order;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Order::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.order_table').'.id',
                config('access.order_table').'.subtotal',
                config('access.order_table').'.total',
                config('access.order_table').'.status',
                config('access.order_table').'.created_at',
                config('access.order_table').'.updated_at',
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
            throw new GeneralException(trans('exceptions.backend.orders.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $orders = self::MODEL;
            $orders = new $orders();
            $orders->name = $input['name'];
            $orders->status = (isset($input['status']) && $input['status'] == 1)
                ? 1 : 0;

            if ($orders->save()) {

                // event(new OrderCreated($orders));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.orders.create_error'));
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

    public function update(Model $orders, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $orders->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.orders.already_exists'));
        }
        $orders->name = $input['name'];
        $orders->status = (isset($input['status']) && $input['status'] == 1)
            ? 1 : 0;

        DB::transaction(function () use ($orders, $input) {
            if ($orders->save()) {
                // event(new OrderUpdated($orders));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.orders.update_error')
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
                // event(new OrderDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.orders.delete_error'));
        });
    }
}