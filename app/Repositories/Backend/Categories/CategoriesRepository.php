<?php

namespace App\Repositories\Backend\Categories;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Categories\Category;
use Illuminate\Database\Eloquent\Model;
use App\Events\Backend\Categories\CategoryCreated;
use App\Events\Backend\Categories\CategoryDeleted;
use App\Events\Backend\Categories\CategoryUpdated;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class CategoriesRepository.
 */
class CategoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Category::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.categories_table').'.id',
                config('access.categories_table').'.category',
                config('access.categories_table').'.status',
                config('access.categories_table').'.created_at',
                config('access.categories_table').'.updated_at',
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
        if ($this->query()->where('category', $input['category'])->first()) {
            throw new GeneralException(trans('exceptions.backend.categories.already_exists'));
        }

        $icon = "";
        if(!empty($input['icon']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('category');

            $icon = $fileUpload->upload($input['icon']);
        }
        
        $image = "";
        if(!empty($input['image']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('category');

            $image = $fileUpload->upload($input['image']);
        }
        DB::transaction(function () use ($input, $icon, $image) {
            $categories = self::MODEL;
            $categories = new $categories();
            $categories->category = $input['category'];
            $categories->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

            $categories->icon = $icon;
            $categories->image = $image;

            if ($categories->save()) {

                // event(new CategoryCreated($categories));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.categories.create_error'));
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
     
    public function update(Model $categories, array $input)
    {
        if ($this->query()->where('category', $input['category'])->where('id', '!=', $categories->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.categories.already_exists'));
        }
        $categories->category = $input['category'];
        $categories->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

        if(!empty($input['icon']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('category');

            $categories->icon = $fileUpload->upload($input['icon']);
        }
        
        if(!empty($input['image']))
        {
            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('category');

            $categories->image = $fileUpload->upload($input['image']);
        }

        DB::transaction(function () use ($categories, $input) {
        	if ($categories->save()) {
                // event(new CategoryUpdated($categories));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.categories.update_error')
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
                // event(new CategoryDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.categories.delete_error'));
        });
    }

    /**
     * Get Category Id by Name
     *
     * @param $categoryName
     * @return null
     */
    public function getCategoryIdByName($categoryName)
    {
        $categoryData = $this->query()->where('category', $categoryName)->select('id')->first();

        return $categoryData ? $categoryData->id : null;
    }

    /**
     * Get Category Id by Name
     *
     * @param $categoryName
     * @return null
     */
    public function getCategoryNameById($categoryId)
    {
        $categoryData = $this->query()->where('id', $categoryId)->select('category')->first();
        
        return $categoryData ? $categoryData->category : null;
    }
}
