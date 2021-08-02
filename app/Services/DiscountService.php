<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Discount;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Manipulations;

class DiscountService extends BaseService
{
    /**
     * TourService constructor.
     *
     * @param  Discount  $discount
     */
    public function __construct(Discount $discount)
    {
        $this->model = $discount;
    }

    public function store($params)
    {

        $discount = new Discount();
        $discount->published = 0;

        return $this->update($discount, $params);
    }

    public function update(Discount $discount, array $params = [])
    {
        DB::beginTransaction();


        try {

            $discount->fill($params);
            $discount->save();


        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating discount.'));
        }
        DB::commit();

        return $discount;
    }
}
