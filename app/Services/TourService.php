<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Tour;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class TourService extends BaseService
{
    /**
     * TourService constructor.
     *
     * @param  Tour  $tour
     */
    public function __construct(Tour $tour)
    {
        $this->model = $tour;
    }

    public function store($params)
    {
        $tour = new Tour();
        $tour->published = 0;

        return $this->update($tour, $params);
    }

    public function update(Tour $tour, array $params = [])
    {
        DB::beginTransaction();

        try {
            $tour->fill($params);
            $tour->save();

            if (array_key_exists('main_image', $params) && empty($params['main_image'])) {
                $tour->clearMediaCollection('main');
            }
            if (array_key_exists('mobile_image', $params) && empty($params['mobile_image'])) {
                $tour->clearMediaCollection('mobile');
            }
            if (isset($params['main_image_upload'])) {
                $tour->storeMedia($params['main_image_upload'], 'main');
            }
            if (isset($params['mobile_image_upload'])) {
                $tour->storeMedia($params['mobile_image_upload'], 'mobile', [
                    'width'=>320,
                    'height'=>320,
                    'fit'=>Manipulations::FIT_CROP,
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating tour.'));
        }
        DB::commit();

        return $tour;
    }
}
