<?php

namespace App\Lib\Bitrix24\CRM\Dynamic;

use App\Models\Tour;
use App\Models\TourSchedule;
use Exception;
use Illuminate\Support\Facades\Log;

class BitrixTourSchedule
{
    public const FIELDS_MAP = [
        BitrixTourScheduleFields::FIELD_ID => 'bitrix_id',
        BitrixTourScheduleFields::FIELD_TOUR_ID => 'tour_id',
        BitrixTourScheduleFields::FIELD_START_DATE => 'start_date',
        BitrixTourScheduleFields::FIELD_END_DATE => 'end_date',
        BitrixTourScheduleFields::FIELD_STATUS => 'status',
        BitrixTourScheduleFields::FIELD_PLACES => 'places',
        BitrixTourScheduleFields::FIELD_PLACES_BOOKED => 'places_booked',
        BitrixTourScheduleFields::FIELD_PRICE => 'price',
        BitrixTourScheduleFields::FIELD_COMMISSION => 'commission',
    ];

    public const STATUSES_MAP = [
        'DT168_2:NEW' => TourSchedule::STATUS_PLANNED, // ЗАПЛАНОВАНО
        'DT168_2:PREPARATION' => TourSchedule::STATUS_WAITING, // ПІДГОТОВКА
        'DT168_2:UC_OBZ9T0' => TourSchedule::STATUS_WAITING, // ОЧІКУЄ СТАРТУ
        'DT168_2:CLIENT' => TourSchedule::STATUS_PERFORMED, // ВИКОНУЄТЬСЯ
        'DT168_2:UC_14ME1B' => TourSchedule::STATUS_SUCCESS, // ЗІБРАТИ ДОКУМЕНТИ ТА ЗВІТИ
        'DT168_2:SUCCESS' => TourSchedule::STATUS_SUCCESS, // ВИКОНАНО
        'DT168_2:FAIL' => TourSchedule::STATUS_FAIL, // СКАСОВАНО
    ];

    public static function createFromData($data)
    {
        $fillData = [
            'currency' => 'UAH',
        ];
        foreach (self::FIELDS_MAP as $bitrixKey => $modelKey) {
            $value = $data[$bitrixKey] ?? null;
            switch ($bitrixKey) {
                case BitrixTourScheduleFields::FIELD_PRICE:
                case BitrixTourScheduleFields::FIELD_COMMISSION:
                    $parts = array_filter(explode('|', $value ?? ''));
                    if (count($parts) > 0) {
                        $fillData[$modelKey] = $parts[0];
                    }

                    break;
                case BitrixTourScheduleFields::FIELD_STATUS:
                    if ($value && array_key_exists($value, self::STATUSES_MAP)) {
                        $fillData[$modelKey] = self::STATUSES_MAP[$value];
                    }

                    break;
                default:
                    $fillData[$modelKey] = $value;

                    break;
            }
        }

        return (object) $fillData;
    }

    public static function getAll()
    {
        $items = [];
        $response = BitrixTourScheduleService::list();

        if (! $response->error) {
            if (! empty($response->result['items'])) {
                foreach ($response->result['items'] as $data) {
                    $items[] = self::createFromData($data);
                }
            }
        } else {
            Log::error($response->error_description, (array) $response);
        }

        return $items;
    }

    public static function get($id)
    {
        $response = BitrixTourScheduleService::get($id);
        if (! $response->error) {
            if (! empty($response->result['item'])) {
                return self::createFromData($response->result['item']);
            }
        } else {
            Log::error($response->error_description, (array) $response);
        }

        return null;
    }

    public static function createOrUpdate($bitrixID, $scheduleData)
    {
        $schedule = TourSchedule::whereBitrixId($bitrixID)->first();

        if ($scheduleData->places > 0 && $scheduleData->price > 0) {
            try {
                $tour = Tour::whereBitrixId($scheduleData->tour_id)->select(['id'])->first();

                if ($schedule === null && $tour !== null) {
                    $schedule = new TourSchedule();
                    $schedule->tour_id = $tour->id;
                    $schedule->bitrix_id = $bitrixID;
                }

                if ($schedule !== null && (int) $scheduleData->price > 0 && ! empty($scheduleData->start_date) && ! empty($scheduleData->end_date)) {
                    $data = (array) $scheduleData;
                    $schedule->fill($data);
                    $schedule->saveOrFail();
                }
            } catch (Exception $e) {
                Log::error($e->getMessage(), $e->getTrace());
            }
        }

        return $schedule;
    }
}
