<?php


namespace App\Services;


use App\Models\TourSchedule;

class TourScheduleService extends BaseService
{
    /**
     * TourScheduleService constructor.
     *
     * @param TourSchedule $model
     */
    public function __construct(TourSchedule $model)
    {
        $this->model = $model;
    }


    public function update(TourSchedule $model, $params)
    {
        $model->fill($params);
        $model->save();
        return $model;
    }

}
