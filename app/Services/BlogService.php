<?php

namespace App\Services;

use App\Exceptions\GeneralException;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class BlogService extends BaseService
{
    /**
     * NewsService constructor.
     *
     * @param Post $blog
     */
    public function __construct(Post $blog)
    {
        $this->model = $blog;
    }

    public function storePost($params)
    {
        $blog = new Post();

        return $this->updatePost($blog, $params);
    }

    public function updatePost(Post $blog, array $params = [])
    {
        DB::beginTransaction();

        try {
            $blog->fill($params);
            $blog->save();

            if (array_key_exists('main_image', $params) && empty($params['main_image'])) {
                $blog->clearMediaCollection('main');
            }
            if (array_key_exists('mobile_image', $params) && empty($params['mobile_image'])) {
                $blog->clearMediaCollection('mobile');
            }
            if (isset($params['main_image_upload'])) {
                $blog->storeMedia($params['main_image_upload'], 'main');
            }
            if (isset($params['mobile_image_upload'])) {
                $blog->storeMedia($params['mobile_image_upload'], 'mobile', [
                    'width' => 320,
                    'height' => 320,
                    'fit' => Manipulations::FIT_CROP,
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating record.'));
        }
        DB::commit();

        return $blog;
    }
}
