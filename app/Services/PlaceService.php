<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\City;
use App\Models\Place;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlaceService extends BaseService
{
    /**
     * PlaceService constructor.
     *
     * @param Place  $place
     */
    public function __construct(Place $place)
    {
        $this->model = $place;
    }

    /**
     * @param array  $params
     *
     * @throws GeneralException
     *
     * @return Place
     */
    public function store(array $params = [])
    {
        $place = new Place();
        if (! isset($params['published'])) {
            $place->published = 0;
        }

        return $this->update($place, $params);
    }

    /**
     * @param Place  $place
     * @param array  $params
     *
     * @throws GeneralException
     * @throws \Throwable
     *
     * @return Place
     */
    public function update(Place $place, array $params = [])
    {
        DB::beginTransaction();

        try {
            if ((int) $params['direction_id'] === 0) {
                $params['direction_id'] = null;
            }
            if ((int) $params['country_id'] === 0) {
                $params['country_id'] = null;
            }
            if ((int) $params['region_id'] === 0) {
                $params['region_id'] = null;
            }
            if ((int) $params['district_id'] === 0) {
                $params['district_id'] = null;
            }
            if ((int) $params['city_id'] === 0) {
                $params['city_id'] = null;
            }
            $place->fill($params);
            if (isset($params['city_id']) && $params['city_id'] > 0) {
                $city = City::find($params['city_id']);
                if ($city !== null) {
                    $place->country_id = $city->country_id;
                    $place->region_id = $city->region_id;
                }
            }
            $place->save();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating place.').' '.$e->getMessage());
        }

        DB::commit();

        return $place;
    }

    /**
     * @param Place  $place
     */
    public function destroy(Place $place)
    {
        $place->delete();
    }
}
