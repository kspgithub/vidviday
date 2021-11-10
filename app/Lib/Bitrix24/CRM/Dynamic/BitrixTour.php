<?php

namespace App\Lib\Bitrix24\CRM\Dynamic;

use App\Models\Tour;
use Illuminate\Support\Facades\Log;

class BitrixTour
{
    public const FIELDS_MAP = [
        BitrixTourFields::FIELD_ID => 'bitrix_id',
        BitrixTourFields::FIELD_MANAGER_ID => 'bitrix_manager_id',
        BitrixTourFields::FIELD_TITLE => 'title',
        BitrixTourFields::FIELD_DURATION => 'duration',
        BitrixTourFields::FIELD_PRICE => 'price',
        BitrixTourFields::FIELD_COMMISSION => 'commission',
    ];


    public static function createFromData($data)
    {
        $fillData = [
            'currency' => 'UAH'
        ];
        foreach (self::FIELDS_MAP as $bitrixKey => $modelKey) {
            $value = $data[$bitrixKey] ?? null;
            switch ($bitrixKey) {
                case BitrixTourFields::FIELD_PRICE:
                case BitrixTourFields::FIELD_COMMISSION:
                    $parts = array_filter(explode('|', $value ?? ''));
                    if (count($parts) > 0) {
                        $fillData[$modelKey] = $parts[0];
                    }
                    break;
                default:
                    $fillData[$modelKey] = $value;
                    break;

            }
        }
        return (object)$fillData;
    }

    public static function getAll()
    {
        $items = [];
        $response = BitrixTourService::list();

        if (!$response->error) {
            if (!empty($response->result['items'])) {
                foreach ($response->result['items'] as $data) {
                    $items[] = self::createFromData($data);
                }
            }
        } else {
            Log::error($response->error_description, (array)$response);
        }
        return $items;
    }

    public static function get($id)
    {
        $response = BitrixTourService::get($id);
        if (!$response->error) {
            if (!empty($response->result['item'])) {
                return self::createFromData($response->result['item']);
            }
        } else {
            Log::error($response->error_description, (array)$response);
        }
        return null;
    }

    public static function createOrUpdate($bitrixID, object $item_data)
    {
        $tour = Tour::whereBitrixId($bitrixID);
        if ($tour === null) {
            $tour = new Tour();
            $tour->bitrix_id = $bitrixID;
            $tour->text = '';
            $tour->short_text = '';
            $tour->published = 0;
        }
        $data = [
            'title' => ['uk' => $item_data->title],
            'duration' => $item_data->duration,
            'nights' => $item_data->duration,
            'price' => $item_data->price ?? 0,
            'currency' => $item_data->currency ?? 'UAH',
            'commission' => $item_data->commission ?? 0,
        ];
        $tour = new Tour();
        $tour->fill($data);
        $tour->save();
        return $tour;
    }
}
