<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\EventItem;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class EventItemService extends BaseService
{
    /**
     * TourService constructor.
     *
     * @param  EventItem  $eventItem
     */
    public function __construct(EventItem $eventItem)
    {
        $this->model = $eventItem;
    }

    public function store($params)
    {
        $eventItem = new EventItem();

        return $this->update($eventItem, $params);
    }

    public function update(EventItem $eventItem, array $params = [])
    {
        DB::beginTransaction();

        try {
            $eventItem->fill($params);
            $eventItem->save();

            if (array_key_exists('main_image', $params) && empty($params['main_image'])) {
                $eventItem->clearMediaCollection('main');
            }
            if (array_key_exists('mobile_image', $params) && empty($params['mobile_image'])) {
                $eventItem->clearMediaCollection('mobile');
            }
            if (isset($params['main_image_upload'])) {
                $eventItem->storeMedia($params['main_image_upload'], 'main');
            }
            if (isset($params['mobile_image_upload'])) {
                $eventItem->storeMedia($params['mobile_image_upload'], 'mobile', [
                    'width' => 320,
                    'height' => 320,
                    'fit' => Manipulations::FIT_CROP,
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating Event item.'));
        }
        DB::commit();

        return $eventItem;
    }
}
