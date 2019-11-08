<?php

namespace App\Repositories\Backend\Subscription;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Subscription\Subscription;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class SubscriptionRepository.
 */
class SubscriptionRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Subscription::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.subscription_table').'.id',
                config('access.subscription_table').'.email',
                config('access.subscription_table').'.created_at',
                config('access.subscription_table').'.updated_at'
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
        if ($this->query()->where('email', $input['email'])->first()) {
            return false;
        }

        DB::transaction(function () use ($input) {
            $Subscriptions = self::MODEL;
            $Subscriptions = new $Subscriptions();
            $Subscriptions->email = $input['email'];

            if ($Subscriptions->save()) {

                return true;
            }
            return false;
        });
        return true;
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
                // event(new SubscriptionDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.Subscriptions.delete_error'));
        });
    }

    public function getSubscriptionBySlug($slug)
    {
        return $this->query()->where('slug', $slug)->first();
    }
}