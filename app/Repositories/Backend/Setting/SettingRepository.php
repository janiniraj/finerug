<?php

namespace App\Repositories\Backend\Setting;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Setting\Setting;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;
use Image, File;

/**
 * Class SettingRepository.
 */
class SettingRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Setting::class;

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        $basePath = public_path("settings");

        $settings = $input['setting'];

        foreach($settings as $singleKey => $singleValue)
        {
            if(isset($singleValue['value']) && is_object($singleValue['value']))
            {
                $imageName = $singleValue['value']->getClientOriginalName();

                $singleValue['value']->move(
                    $basePath, $imageName
                );

                $settings[$singleKey]['value'] = $imageName;
            }
        }

        foreach ($settings as $key => $value) 
        {
            if(isset($value['value']) && $value['value'])
            {
                if(isset($value['id']) && $value['id'])
                {
                    $find           = Setting::find($value['id']);
                    $find->key      = $value['key'];
                    $find->value    = $value['value'];

                    $find->save();
                }
                else
                {
                    $saveData = new Setting();

                    $saveData->key      = $value['key'];
                    $saveData->value    = $value['value'];

                    $saveData->save();
                }
            }      
        }

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
                // event(new SettingDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.Settings.delete_error'));
        });
    }

    public function getSettingBySlug($slug)
    {
        return $this->query()->where('slug', $slug)->first();
    }
}