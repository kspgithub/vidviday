<?php

namespace App\Services;

use App\Exceptions\GeneralException;

use App\Models\HtmlBlock;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HtmlBlockService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param HtmlBlock $htmlBlock
     */
    public function __construct(HtmlBlock $htmlBlock)
    {
        $this->model = $htmlBlock;
    }

    public function store($params)
    {
        $htmlBlock = new HtmlBlock();


        return $this->update($htmlBlock, $params);
    }

    public function update(HtmlBlock $htmlBlock, array $params = [])
    {
        DB::beginTransaction();

        try {
            $htmlBlock->fill($params);
            $htmlBlock->save();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating article.'));
        }
        DB::commit();

        return $htmlBlock;
    }
}
