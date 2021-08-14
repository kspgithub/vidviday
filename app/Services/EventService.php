<?php

namespace App\Services;

use App\Exceptions\GeneralException;

use App\Models\Event;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class EventService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param Event $event
     */
    public function __construct(Event $event)
    {
        $this->model = $event;
    }

    public function store($params)
    {
        $event = new Event();

        return $this->update($event, $params);
    }

    public function update(Event $event, array $params = [])
    {
        DB::beginTransaction();

        try {
            $event->fill($params);
            $event->save();

            if (array_key_exists('main_image', $params) && empty($params['main_image'])) {
                $event->clearMediaCollection('main');
            }
            if (array_key_exists('mobile_image', $params) && empty($params['mobile_image'])) {
                $event->clearMediaCollection('mobile');
            }
            if (isset($params['main_image_upload'])) {
                $event->storeMedia($params['main_image_upload'], 'main');
            }
            if (isset($params['mobile_image_upload'])) {
                $event->storeMedia($params['mobile_image_upload'], 'mobile', [
                    'width'=>320,
                    'height'=>320,
                    'fit'=>Manipulations::FIT_CROP,
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating record.'));
        }
        DB::commit();

        return $event;
    }
}
