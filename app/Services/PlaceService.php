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
     * @param  Place $place
     */
    public function __construct(Place $place)
    {
        $this->model = $place;
    }

    /**
     * @param array $params
     * @return Place
     * @throws GeneralException
     */
    public function store(array $params = [])
    {
        $place = new Place();
        if (!isset($params['published'])) {
            $place->published = 0;
        }
        return $this->update($place, $params);
    }

    /**
     * @param Place $place
     * @param array $params
     * @return Place
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(Place $place, array $params = [])
    {
        DB::beginTransaction();


        try {
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

            throw new GeneralException(__('There was a problem updating place.'));
        }

        DB::commit();
        return $place;
    }

    /**
     * @param Place $place
     */
    public function destroy(Place $place)
    {
        $place->delete();
    }
}
