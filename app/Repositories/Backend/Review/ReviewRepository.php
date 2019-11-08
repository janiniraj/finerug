<?php

namespace App\Repositories\Backend\Review;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Review\Review;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class ReviewRepository.
 */
class ReviewRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Review::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->join('products', 'products.id', '=', config('access.Review_table').'product_id')
            ->select([
                config('access.review_table').'.id',
                config('access.review_table').'.title',
                config('access.review_table').'.star',
                config('access.review_table').'.content',
                config('access.review_table').'.created_at',
                config('access.review_table').'.updated_at',
                config('access.review_table').'.product_id',
                'products.name as product_name',
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
        if ($this->query()->where('slug', $input['slug'])->first()) {
            throw new GeneralException(trans('exceptions.backend.Reviews.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $Reviews = self::MODEL;
            $Reviews = new $Reviews();
            $Reviews->name = $input['name'];
            $Reviews->slug = $input['slug'];
            $Reviews->content = $input['content'];

            if ($Reviews->save()) {

                // event(new ReviewCreated($Reviews));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.Reviews.create_error'));
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
     
    public function update(Model $Reviews, array $input)
    {
        if ($this->query()->where('slug', $input['slug'])->where('id', '!=', $Reviews->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.Reviews.already_exists'));
        }
        $Reviews->name = $input['name'];
        $Reviews->slug = $input['slug'];
        $Reviews->content = $input['content'];

        DB::transaction(function () use ($Reviews, $input) {
        	if ($Reviews->save()) {
                // event(new ReviewUpdated($Reviews));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.Reviews.update_error')
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
                // event(new ReviewDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.Reviews.delete_error'));
        });
    }

    public function getReviewBySlug($slug)
    {
        return $this->query()->where('slug', $slug)->first();
    }
}