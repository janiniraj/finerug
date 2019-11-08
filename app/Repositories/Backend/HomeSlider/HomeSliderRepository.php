<?php

namespace App\Repositories\Backend\HomeSlider;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\HomeSlider\HomeSlider;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class HomeSliderRepository.
 */
class HomeSliderRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = HomeSlider::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.homeslider_table').'.id',
                config('access.homeslider_table').'.type',
                config('access.homeslider_table').'.image',
                config('access.homeslider_table').'.youtubevideo_id',
                config('access.homeslider_table').'.created_at',
                config('access.homeslider_table').'.updated_at',
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
        $image = "";
        if(!empty($input['image']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('sliders');

            $image = $fileUpload->upload($input['image']);
        }
        DB::transaction(function () use ($input, $image) {
            $homeSlider = self::MODEL;
            $homeSlider = new $homeSlider();
            $homeSlider->type = $input['type'];
            $homeSlider->image = $image ? $image: "";
            $homeSlider->youtubevideo_id = isset($input['youtubevideo_id']) ? $input['youtubevideo_id'] : "";
            $homeSlider->title = isset($input['title']) ? $input['title'] : "";
            $homeSlider->url = isset($input['url']) ? $input['url'] : "";
            $homeSlider->page_type = $input['page_type'];

            if ($homeSlider->save()) {
                return true;
            }
            throw new GeneralException("Error in Creating Record");
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
     
    public function update(Model $homeSlider, array $input)
    {
        $homeSlider = $this->query()->find($input['id']);
        $homeSlider->type = $input['type'];
        $homeSlider->youtubevideo_id = isset($input['youtubevideo_id']) ? $input['youtubevideo_id'] : "";
        $homeSlider->title = isset($input['title']) ? $input['title'] : "";
        $homeSlider->url = isset($input['url']) ? $input['url'] : "";
        $homeSlider->page_type = isset($input['page_type']) ? $input['page_type'] : "";

        if(!empty($input['image']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('sliders');

            $homeSlider->image = $fileUpload->upload($input['image']);
        }

        DB::transaction(function () use ($homeSlider, $input) {
        	if ($homeSlider->save()) {

                return true;
            }

            throw new GeneralException(
                "Error in updating record"
            );
        });
    }

    /**
     * @param Model $subcategory
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $subcategory)
    {
        DB::transaction(function () use ($subcategory) {

            if ($subcategory->delete()) {
                // event(new CategoryDeleted($subcategory));

                return true;
            }

            throw new GeneralException('Error in deleting record.');
        });
    }
}