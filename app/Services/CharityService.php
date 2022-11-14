<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Charity;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class CharityService extends BaseService
{
    /**
     * CharityService constructor.
     *
     * @param Charity  $charity
     */
    public function __construct(Charity $charity)
    {
        $this->model = $charity;
    }

    public function store($params)
    {
        $charity = new Charity();

        return $this->update($charity, $params);
    }

    public function update(Charity $charity, array $params = [])
    {
        DB::beginTransaction();

        try {
            $charity->fill($params);
            $charity->save();

            if (array_key_exists('main_image', $params) && empty($params['main_image'])) {
                $charity->clearMediaCollection('main');
            }
            if (array_key_exists('mobile_image', $params) && empty($params['mobile_image'])) {
                $charity->clearMediaCollection('mobile');
            }
            if (isset($params['main_image_upload'])) {
                $charity->storeMedia($params['main_image_upload'], 'main');
            }
            if (isset($params['mobile_image_upload'])) {
                $charity->storeMedia($params['mobile_image_upload'], 'mobile', [
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

        return $charity;
    }
}
