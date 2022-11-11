<?php

namespace App\Lib\Bitrix24\CRM\Deal;

use App\Models\Tour;
use App\Models\TourSchedule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DealSchedule
{
    public const CATEGORY_ID = 7;

    protected const FIELDS_MAP = [
        DealFields::FIELD_ID => 'id',
        DealFields::FIELD_STAGE_ID => 'status',
        DealFields::FIELD_TITLE => 'title',
        DealFields::FIELD_START_DATE => 'start_date',
        DealFields::FIELD_DURATION => 'duration',
        DealFields::FIELD_SCHEDULE_END_DATE => 'end_date',
        DealFields::FIELD_SCHEDULE_PLACES => 'places',
        DealFields::FIELD_PRICE => 'price',
        DealFields::FIELD_COMMISSION => 'commission',
        DealFields::FIELD_SCHEDULE_COMMENT => 'comment',
        DealFields::FIELD_SCHEDULE_TOUR_ID => 'tour_id',
        DealFields::FIELD_PLACES_BOOKED => 'places_booked',
    ];

    protected const STATUSES_MAP = [
        'C7:NEW' => 0, // Нова
        'C7:PREPARATION' => 1, // Підготовка туру
        'C7:PREPAYMENT_INVOICE' => 2, // Очікує старту
        'C7:EXECUTING' => 3, // Виконання туру
        'C7:FINAL_INVOICE' => 4, // Закрити тур
        'C7:WON' => 5, // Тур завершено
        'C7:LOSE' => 6, // Скасовано
        'C7:APOLOGY' => 7, // Аналіз причин
    ];

    public static function createOrUpdate($bitrix_id, $data)
    {
        if ($data[DealFields::FIELD_ID] > 0 && $data[DealFields::FIELD_SCHEDULE_TOUR_ID] > 0) {
            $schedule = TourSchedule::whereBitrixId($bitrix_id)->first();
            $tour = Tour::whereBitrixId($data[DealFields::FIELD_SCHEDULE_TOUR_ID])->first();
            if ($tour === null) {
                Log::error('Tour with bitrix_id = '.$data[DealFields::FIELD_SCHEDULE_TOUR_ID].' not found');

                return;
            }

            if ($schedule === null) {
                $schedule = new TourSchedule();
                $schedule->bitrix_id = $bitrix_id;
                $schedule->tour_id = $tour->id;
            }

            $fillData = [];

            foreach (self::FIELDS_MAP as $bitrixKey => $modelKey) {
                if (isset($data[$bitrixKey])) {
                    switch ($bitrixKey) {
                        case DealFields::FIELD_STAGE_ID:
                            $fillData[$modelKey] = self::STATUSES_MAP[$data[$bitrixKey]];

                            break;
                        case DealFields::FIELD_PRICE:
                        case DealFields::FIELD_COMMISSION:
                            $parts = array_filter(explode('|', $data[$bitrixKey]));
                            if (count($parts) > 0) {
                                $fillData[$modelKey] = $parts[0];
                            }

                            break;
                        case DealFields::FIELD_ID:
                        case DealFields::FIELD_SCHEDULE_TOUR_ID:
                            break;
                        case DealFields::FIELD_SCHEDULE_END_DATE:
                            $fillData[$modelKey] = empty($data[$bitrixKey])
                                ? Carbon::parse($data[DealFields::FIELD_START_DATE])->addDays($tour->duration)
                                : $data[$bitrixKey];

                            break;
                        default:
                            $fillData[$modelKey] = empty($data[$bitrixKey]) ? null : $data[$bitrixKey];

                            break;
                    }
                }
            }

            if (empty($fillData['places'])) {
                $fillData['places'] = 0;
            }

            $schedule->fill($fillData);
            $schedule->save();
        }
    }
}
