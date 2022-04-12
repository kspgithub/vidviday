<?php

namespace App\Models\Traits\Methods;

use App\Models\BitrixContact;

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


    public function syncContact()
    {
        $emails = array_filter([$this->email]);

        $phones = array_filter(array_unique([$this->phone, clear_phone($this->phone, false), clear_phone($this->phone, true)]));
        if (!empty($emails) || !empty($phones)) {
            $query = BitrixContact::query();
            $first = true;
            foreach ($phones as $phone) {
                if ($first) {
                    $query->whereJsonContains('phone', $phone);
                    $first = false;
                } else {
                    $query->orWhereJsonContains('phone', $phone);
                }
            }
            foreach ($emails as $email) {
                if ($first) {
                    $query->whereJsonContains('email', $email);
                    $first = false;
                } else {
                    $query->orWhereJsonContains('email', $email);
                }
            }
            $contact = $query->first();
            if (empty($contact)) {
                $contact = new BitrixContact();
                $contact->phone = $phones;
                $contact->email = $emails;
                $contact->first_name = $this->first_name;
                $contact->last_name = $this->last_name;
                $contact->save();
                return true;
            }
            if (!empty($contact)) {
                $this->contact_id = $contact->id;
                $this->save();
            }

        }

        return false;
    }
}
