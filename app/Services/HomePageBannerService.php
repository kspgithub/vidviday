<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\HomePageBanner;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class HomePageBannerService extends BaseService
{
    /**
     * TourService constructor.
     *
     * @param  HomePageBanner  $homePageBanner
     */
    public function __construct(HomePageBanner $homePageBanner)
    {
        $this->model = $homePageBanner;
    }

    public function store($params)
    {
        $homePageBanner = new HomePageBanner();

        return $this->update($homePageBanner, $params);
    }

    public function update(HomePageBanner $homePageBanner, array $params = [])
    {
        DB::beginTransaction();

        try {
            $homePageBanner->fill($params);
            $homePageBanner->save();

            if (array_key_exists('main_image', $params) && empty($params['main_image'])) {
                $homePageBanner->clearMediaCollection('main');
            }
            if (array_key_exists('mobile_image', $params) && empty($params['mobile_image'])) {
                $homePageBanner->clearMediaCollection('mobile');
            }
            if (isset($params['main_image_upload'])) {
                $homePageBanner->storeMedia($params['main_image_upload'], 'main');
            }
            if (isset($params['mobile_image_upload'])) {
                $homePageBanner->storeMedia($params['mobile_image_upload'], 'mobile', [
                    'width'=>320,
                    'height'=>320,
                    'fit'=>Manipulations::FIT_CROP,
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());


            throw new GeneralException(__('There was a problem updating Home page banner.'));
        }
        DB::commit();

        return $homePageBanner;
    }
}
