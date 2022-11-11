<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\EventItem;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param  EventItem  $event
     */
    public function __construct(EventItem $event)
    {
        $this->model = $event;
    }

    public function store($params)
    {
        $event = new EventItem();

        return $this->update($event, $params);
    }

    public function update(EventItem $event, array $params = [])
    {
        DB::beginTransaction();

        try {
            $event->fill($params);
            $event->save();

            if (array_key_exists('groups', $params)) {
                $groups = array_filter($params['groups']);
                $event->groups()->sync($groups);
            }
            if (array_key_exists('tours', $params)) {
                $tours = array_filter($params['tours']);
                $event->tours()->sync($tours);
            }
            if (array_key_exists('directions', $params)) {
                $directions = array_filter($params['directions']);
                $event->directions()->sync($directions);
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
