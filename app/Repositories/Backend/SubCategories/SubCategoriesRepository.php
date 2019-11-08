<?php

namespace App\Repositories\Backend\SubCategories;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\SubCategories\SubCategory;
use Illuminate\Database\Eloquent\Model;
use App\Events\Backend\SubCategories\SubCategoryCreated;
use App\Events\Backend\SubCategories\SubCategoryDeleted;
use App\Events\Backend\SubCategories\SubCategoryUpdated;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class SubCategoriesRepository.
 */
class SubCategoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = SubCategory::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin(config('access.categories_table'),config('access.categories_table').'.id','=',config('access.subcategories_table').'.category_id')
            ->select([
                config('access.subcategories_table').'.id',
                config('access.subcategories_table').'.subcategory',
                config('access.categories_table').'.category',
                config('access.subcategories_table').'.status',
                config('access.subcategories_table').'.created_at',
                config('access.subcategories_table').'.updated_at',
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
        if ($this->query()->where('subcategory', $input['subcategory'])->first()) {
            throw new GeneralException(trans('exceptions.backend.categories.already_exists'));
        }
        $icon = "";
        if(!empty($input['icon']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('subcategory');

            $icon = $fileUpload->upload($input['icon']);
        }
        
        $image = "";
        if(!empty($input['image']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('subcategory');

            $image = $fileUpload->upload($input['image']);
        }


        DB::transaction(function () use ($input, $icon, $image) {
            $subcategories = self::MODEL;
            $subcategories = new $subcategories();
            $subcategories->category_id = $input['category_id'];
            $subcategories->subcategory = $input['subcategory'];
            $subcategories->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

            $subcategories->icon = $icon;
            $subcategories->image = $image;

            if ($subcategories->save()) {

                // event(new CategoryCreated($subcategories));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.subcategories.create_error'));
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
     
    public function update(Model $subcategories, array $input)
    {
        if ($this->query()->where('subcategory', $input['subcategory'])->where('id', '!=', $subcategories->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.subcategories.already_exists'));
        }
        $subcategories->category_id = $input['category_id'];
        $subcategories->subcategory = $input['subcategory'];
        $subcategories->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

        if(!empty($input['icon']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('subcategory');

            $subcategories->icon = $fileUpload->upload($input['icon']);
        }
        
        if(!empty($input['image']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('subcategory');

            $subcategories->image = $fileUpload->upload($input['image']);
        }

        DB::transaction(function () use ($subcategories, $input) {
        	if ($subcategories->save()) {
                // event(new CategoryUpdated($subcategories));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.subcategories.update_error')
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

            throw new GeneralException(trans('exceptions.backend.subcategories.delete_error'));
        });
    }

    public function getSubCategoriesByCategory($categoryId)
    {
        return $this->query()->where('category_id', $categoryId)->get();
    }
}
