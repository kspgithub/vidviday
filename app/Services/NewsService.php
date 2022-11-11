<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\News;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class NewsService extends BaseService
{
    /**
     * NewsService constructor.
     *
     * @param  News  $news
     */
    public function __construct(News $news)
    {
        $this->model = $news;
    }

    public function store($params)
    {
        $news = new News();

        return $this->update($news, $params);
    }

    public function update(News $news, array $params = [])
    {
        DB::beginTransaction();

        try {
            $news->fill($params);
            $news->save();

            if (array_key_exists('main_image', $params) && empty($params['main_image'])) {
                $news->clearMediaCollection('main');
            }
            if (array_key_exists('mobile_image', $params) && empty($params['mobile_image'])) {
                $news->clearMediaCollection('mobile');
            }
            if (isset($params['main_image_upload'])) {
                $news->storeMedia($params['main_image_upload'], 'main');
            }
            if (isset($params['mobile_image_upload'])) {
                $news->storeMedia($params['mobile_image_upload'], 'mobile', [
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

        return $news;
    }
}
