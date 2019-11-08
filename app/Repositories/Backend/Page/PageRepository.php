<?php

namespace App\Repositories\Backend\Page;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Page\Page;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use DB;

/**
 * Class PageRepository.
 */
class PageRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Page::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.Page_table').'.id',
                config('access.Page_table').'.name',
                config('access.Page_table').'.slug',
                config('access.Page_table').'.created_at',
                config('access.Page_table').'.updated_at',
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
            throw new GeneralException(trans('exceptions.backend.Pages.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $Pages = self::MODEL;
            $Pages = new $Pages();
            $Pages->name = $input['name'];
            $Pages->slug = $input['slug'];
            $Pages->content = $input['content'];

            if ($Pages->save()) {

                // event(new PageCreated($Pages));
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.Pages.create_error'));
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
     
    public function update(Model $Pages, array $input)
    {
        if ($this->query()->where('slug', $input['slug'])->where('id', '!=', $Pages->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.Pages.already_exists'));
        }
        $Pages->name = $input['name'];
        $Pages->slug = $input['slug'];
        $Pages->content = $input['content'];

        DB::transaction(function () use ($Pages, $input) {
        	if ($Pages->save()) {
                // event(new PageUpdated($Pages));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.Pages.update_error')
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
                // event(new PageDeleted($category));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.Pages.delete_error'));
        });
    }

    public function getPageBySlug($slug)
    {
        return $this->query()->where('slug', $slug)->first();
    }
}