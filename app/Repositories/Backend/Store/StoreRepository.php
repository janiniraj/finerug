<?php

namespace App\Repositories\Backend\Store;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Store\Store;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class StoreRepository.
 */
class StoreRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Store::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.store_table').'.id',
                config('access.store_table').'.name',
                config('access.store_table').'.pobox',
                config('access.store_table').'.created_at',
                config('access.store_table').'.updated_at',
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
            throw new GeneralException(trans('exceptions.backend.stores.already_exists'));
        }

        $basePath = public_path("stores");

        if(isset($input['custom_logo1']) && is_object($input['custom_logo1']))
        {
            $imageName = time().$input['custom_logo1']->getClientOriginalName();

            $input['custom_logo1']->move(
                $basePath, $imageName
            );

            $input['custom_logo1'] = $imageName;
        }

        if(isset($input['custom_logo2']) && is_object($input['custom_logo2']))
        {
            $imageName = time().$input['custom_logo2']->getClientOriginalName();

            $input['custom_logo2']->move(
                $basePath, $imageName
            );

            $input['custom_logo2'] = $imageName;
        }

        if(isset($input['custom_logo3']) && is_object($input['custom_logo3']))
        {
            $imageName = time().$input['custom_logo3']->getClientOriginalName();

            $input['custom_logo3']->move(
                $basePath, $imageName
            );

            $input['custom_logo3'] = $imageName;
        }

        if(isset($input['custom_logo4']) && is_object($input['custom_logo4']))
        {
            $imageName = time().$input['custom_logo4']->getClientOriginalName();

            $input['custom_logo4']->move(
                $basePath, $imageName
            );

            $input['custom_logo4'] = $imageName;
        }

        if(isset($input['custom_logo5']) && is_object($input['custom_logo5']))
        {
            $imageName = time().$input['custom_logo5']->getClientOriginalName();

            $input['custom_logo5']->move(
                $basePath, $imageName
            );

            $input['custom_logo5'] = $imageName;
        }

        $input['shop'] = [
            'amazon_link'   => isset($input['amazon_link']) ? $input['amazon_link'] : '',
            'ebay_link'     => isset($input['ebay_link']) ? $input['ebay_link'] : '',            
            'custom_link1'  => isset($input['custom_link1']) ? $input['custom_link1'] : '',
            'custom_logo1'  => isset($input['custom_logo1']) ? $input['custom_logo1'] : '',
            'custom_link2'  => isset($input['custom_link2']) ? $input['custom_link2'] : '',
            'custom_logo2'  => isset($input['custom_logo2']) ? $input['custom_logo2'] : '',
            'custom_link3'  => isset($input['custom_link3']) ? $input['custom_link3'] : '',
            'custom_logo3'  => isset($input['custom_logo3']) ? $input['custom_logo3'] : '',
            'custom_link4'  => isset($input['custom_link4']) ? $input['custom_link4'] : '',
            'custom_logo4'  => isset($input['custom_logo4']) ? $input['custom_logo4'] : '',
            'custom_link5'  => isset($input['custom_link5']) ? $input['custom_link5'] : '',
            'custom_logo5'  => isset($input['custom_logo5']) ? $input['custom_logo5'] : ''        
        ];

        DB::transaction(function () use ($input) {
            $stores = self::MODEL;
            $stores = new $stores();
            $stores->name = $input['name'];
            $stores->email = $input['email'];
            $stores->address = $input['address'];
            $stores->street = $input['street'];
            $stores->pobox = $input['pobox'];
            $stores->city = $input['city'];
            $stores->state = $input['state'];
            $stores->country = $input['country'];
            $stores->phone = $input['phone'];
            $stores->phone = $input['phone'];
            $stores->shop = json_encode($input['shop']);

            if ($stores->save()) {

                // event(new StoreCreated($stores));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.stores.create_error'));
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
     
    public function update(Model $stores, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $stores->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.stores.already_exists'));
        }

        $shopOriginal = json_decode($stores->shop, true);

        $basePath = public_path("stores");

        if(isset($input['custom_logo1']) && is_object($input['custom_logo1']))
        {
            $imageName = time().$input['custom_logo1']->getClientOriginalName();

            $input['custom_logo1']->move(
                $basePath, $imageName
            );

            $input['custom_logo1'] = $imageName;
        }

        if(isset($input['custom_logo2']) && is_object($input['custom_logo2']))
        {
            $imageName = time().$input['custom_logo2']->getClientOriginalName();

            $input['custom_logo2']->move(
                $basePath, $imageName
            );

            $input['custom_logo2'] = $imageName;
        }

        if(isset($input['custom_logo3']) && is_object($input['custom_logo3']))
        {
            $imageName = time().$input['custom_logo3']->getClientOriginalName();

            $input['custom_logo3']->move(
                $basePath, $imageName
            );

            $input['custom_logo3'] = $imageName;
        }

        if(isset($input['custom_logo4']) && is_object($input['custom_logo4']))
        {
            $imageName = time().$input['custom_logo4']->getClientOriginalName();

            $input['custom_logo4']->move(
                $basePath, $imageName
            );

            $input['custom_logo4'] = $imageName;
        }

        if(isset($input['custom_logo5']) && is_object($input['custom_logo5']))
        {
            $imageName = time().$input['custom_logo5']->getClientOriginalName();

            $input['custom_logo5']->move(
                $basePath, $imageName
            );

            $input['custom_logo5'] = $imageName;
        }

        $input['shop'] = [
            'amazon_link'   => isset($input['amazon_link']) ? $input['amazon_link'] : '',
            'ebay_link'     => isset($input['ebay_link']) ? $input['ebay_link'] : '',
            'custom_link1'  => isset($input['custom_link1']) ? $input['custom_link1'] : (isset($shopOriginal['custom_link1']) ? $shopOriginal['custom_link1'] : ''),
            'custom_logo1'  => isset($input['custom_logo1']) ? $input['custom_logo1'] : (isset($shopOriginal['custom_logo1']) ? $shopOriginal['custom_logo1'] : ''),
            'custom_link2'  => isset($input['custom_link2']) ? $input['custom_link2'] : (isset($shopOriginal['custom_link2']) ? $shopOriginal['custom_link2'] : ''),
            'custom_logo2'  => isset($input['custom_logo2']) ? $input['custom_logo2'] : (isset($shopOriginal['custom_logo2']) ? $shopOriginal['custom_logo2'] : ''),
            'custom_link3'  => isset($input['custom_link3']) ? $input['custom_link3'] : (isset($shopOriginal['custom_link3']) ? $shopOriginal['custom_link3'] :''),
            'custom_logo3'  => isset($input['custom_logo3']) ? $input['custom_logo3'] : (isset($shopOriginal['custom_logo3']) ? $shopOriginal['custom_logo3'] : ''),
            'custom_link4'  => isset($input['custom_link4']) ? $input['custom_link4'] : (isset($shopOriginal['custom_link4']) ? $shopOriginal['custom_link4'] : ''),
            'custom_logo4'  => isset($input['custom_logo4']) ? $input['custom_logo4'] : (isset($shopOriginal['custom_logo4']) ? $shopOriginal['custom_logo4'] : ''),
            'custom_link5'  => isset($input['custom_link5']) ? $input['custom_link5'] : (isset($shopOriginal['custom_link5']) ? $shopOriginal['custom_link5'] : ''),
            'custom_logo5'  => isset($input['custom_logo5']) ? $input['custom_logo5'] : (isset($shopOriginal['custom_logo5']) ? $shopOriginal['custom_logo5'] :'')
        ];
        
        $stores->name = $input['name'];
        $stores->email = $input['email'];
        $stores->address = $input['address'];
        $stores->street = $input['street'];
        $stores->pobox = $input['pobox'];
        $stores->city = $input['city'];
        $stores->state = $input['state'];
        $stores->country = $input['country'];
        $stores->phone = $input['phone'];
        $stores->phone = $input['phone'];
        $stores->shop = json_encode($input['shop']);

        DB::transaction(function () use ($stores, $input) {
        	if ($stores->save()) {
                // event(new StoreUpdated($stores));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.stores.update_error')
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
                // event(new StoreDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.stores.delete_error'));
        });
    }
}