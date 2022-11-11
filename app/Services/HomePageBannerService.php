<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\HomePageBanner;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomePageBannerService extends BaseService
{
    /**
     * TourService constructor.
     *
     * @param HomePageBanner  $homePageBanner
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

            if (isset($params['main_image_upload'])) {
                $homePageBanner->storeMedia($params['main_image_upload'], 'main');
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating record.'));
        }
        DB::commit();

        return $homePageBanner;
    }
}
