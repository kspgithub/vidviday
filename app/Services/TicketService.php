<?php

namespace App\Services;

use App\Exceptions\GeneralException;

use App\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TicketService extends BaseService
{
    /**
     * UserService constructor.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->model = $ticket;
    }

    public function store($params)
    {
        $ticket = new Ticket();
        $ticket->published = 0;

        return $this->update($ticket, $params);
    }

    public function update(Ticket $ticket, array $params = [])
    {
        DB::beginTransaction();

        try {
            $ticket->fill($params);
            $ticket->save();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());

            throw new GeneralException(__('There was a problem updating article.'));
        }
        DB::commit();

        return $ticket;
    }
}
