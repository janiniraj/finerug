<?php

namespace App\Repositories\Backend\Visitor;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Visitor\Visitor;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class VisitorRepository.
 */
class VisitorRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Visitor::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->orderBy('created_at', 'DESC')
            ->select([
                config('access.visitor_table').'.id',
                config('access.visitor_table').'.ip',
                config('access.visitor_table').'.country_code',
                config('access.visitor_table').'.zip_code',
                config('access.visitor_table').'.created_at',
                config('access.visitor_table').'.updated_at',
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
            throw new GeneralException(trans('exceptions.backend.visitors.already_exists'));
        }

        $basePath = public_path("visitors");

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

        $input['shop'] = [
            'amazon_link'   => isset($input['amazon_link']) ? $input['amazon_link'] : '',
            'ebay_link'     => isset($input['ebay_link']) ? $input['ebay_link'] : '',            
            'custom_link1'  => isset($input['custom_link1']) ? $input['custom_link1'] : '',
            'custom_logo1'  => isset($input['custom_logo1']) ? $input['custom_logo1'] : '',
            'custom_link2'  => isset($input['custom_link2']) ? $input['custom_link2'] : '',
            'custom_logo2'  => isset($input['custom_logo2']) ? $input['custom_logo2'] : ''        
        ];

        DB::transaction(function () use ($input) {
            $visitors = self::MODEL;
            $visitors = new $visitors();
            $visitors->name = $input['name'];
            $visitors->email = $input['email'];
            $visitors->address = $input['address'];
            $visitors->street = $input['street'];
            $visitors->pobox = $input['pobox'];
            $visitors->city = $input['city'];
            $visitors->state = $input['state'];
            $visitors->country = $input['country'];
            $visitors->phone = $input['phone'];
            $visitors->phone = $input['phone'];
            $visitors->shop = json_encode($input['shop']);

            if ($visitors->save()) {

                // event(new VisitorCreated($visitors));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.visitors.create_error'));
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
     
    public function update(Model $visitors, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $visitors->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.visitors.already_exists'));
        }

        $shopOriginal = json_decode($visitors->shop, true);

        $basePath = public_path("visitors");

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

        $input['shop'] = [
            'amazon_link'   => isset($input['amazon_link']) ? $input['amazon_link'] : '',
            'ebay_link'     => isset($input['ebay_link']) ? $input['ebay_link'] : '',
            'custom_link1'  => isset($input['custom_link1']) ? $input['custom_link1'] : $shopOriginal['custom_link1'],
            'custom_logo1'  => isset($input['custom_logo1']) ? $input['custom_logo1'] : $shopOriginal['custom_logo1'],
            'custom_link2'  => isset($input['custom_link2']) ? $input['custom_link2'] : $shopOriginal['custom_link2'],
            'custom_logo2'  => isset($input['custom_logo2']) ? $input['custom_logo2'] : $shopOriginal['custom_logo2']
        ];
        
        $visitors->name = $input['name'];
        $visitors->email = $input['email'];
        $visitors->address = $input['address'];
        $visitors->street = $input['street'];
        $visitors->pobox = $input['pobox'];
        $visitors->city = $input['city'];
        $visitors->state = $input['state'];
        $visitors->country = $input['country'];
        $visitors->phone = $input['phone'];
        $visitors->phone = $input['phone'];
        $visitors->shop = json_encode($input['shop']);

        DB::transaction(function () use ($visitors, $input) {
        	if ($visitors->save()) {
                // event(new VisitorUpdated($visitors));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.visitors.update_error')
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
                // event(new VisitorDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.visitors.delete_error'));
        });
    }
}