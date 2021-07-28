<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Article;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class ArticleService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param  Article $article
     */
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function store($params)
    {
        //dd($params);
        $article = new Article();
        $article->published = 0;

        return $this->update($article, $params);
    }

    public function update(Article $article, array $params = [])
    {
        DB::beginTransaction();

        try {
            $article->fill($params);
            $article->save();

            if (array_key_exists('main_image', $params) && empty($params['main_image'])) {

                $article->clearMediaCollection('main');
            }
            if (array_key_exists('mobile_image', $params) && empty($params['mobile_image'])) {
                $article->clearMediaCollection('mobile');
            }
            if (isset($params['main_image_upload'])) {
                $article->storeMedia($params['main_image_upload'], 'main');
            }
            if (isset($params['mobile_image_upload'])) {
                $article->storeMedia($params['mobile_image_upload'], 'mobile', [
                    'width'=>320,
                    'height'=>320,
                    'fit'=>Manipulations::FIT_CROP,
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating article.'));
        }
        DB::commit();

        return $article;
    }
}
