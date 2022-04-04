<?php

namespace App\Models\Traits\Methods;

trait OrderMethods
{
    public function getParticipantsComment()
    {
        $data = $this->participants;
        $comment = '';
        if (!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $part = trim($item['last_name'] . ' ' . $item['first_name'] . ' ' . $item['middle_name'] . ' ' . $item['birthday']);
                if (!empty($part)) {
                    $comment .= "$part\n";
                }
            }
            $comment .= "\n";
        }

        if (!empty($data['participant_phone'])) {
            $phone = $data['participant_phone'];

            $comment .= "Телефон одного з учасників: $phone\n";
        }
        return trim($comment);
    }

    public function cancel($data)
    {
        $this->abolition = $data;
        $this->status = self::STATUS_PENDING_CANCEL;
        $this->save();
    }

    public function isOverloaded()
    {
        return $this->schedule->places_available < $this->total_places;
    }
}
