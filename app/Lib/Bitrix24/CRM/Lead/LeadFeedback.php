<?php

namespace App\Lib\Bitrix24\CRM\Lead;

use App\Lib\Bitrix24\CRM\Contact\ContactService;
use App\Models\BitrixContact;
use App\Models\UserQuestion;

class LeadFeedback
{


    public static function createCrmLead(UserQuestion $question)
    {
        $is_test = config('services.bitrix24.test');

        $data = [];
        $nameParts = array_filter(explode(' ', $question->name));

        if ($is_test) {
            $data[LeadFields::FIELD_TEST] = true;
        }

        $contactData = [];
        if (count($nameParts) > 0) {
            $contactData['name'] = $nameParts[0];
            $data[LeadFields::FIELD_NAME] = $nameParts[0];
        }
        if (count($nameParts) > 1) {
            $contactData['last_name'] = $nameParts[1];
            $data[LeadFields::FIELD_LAST_NAME] = $nameParts[1];
        }

        if (!empty($question->phone)) {
            $contactData['phone'] = $question->phone;
            $data[LeadFields::FIELD_PHONE] = [$question->phone];
        }
        if (!empty($question->email)) {
            $contactData['email'] = $question->email;
            $data[LeadFields::FIELD_EMAIL] = [$question->email];
        }

        $contactId = ContactService::getContactId($contactData);
        $data[LeadFields::FIELD_CONTACT_ID] = $contactId;

        $comment = '';
        switch ($question->type) {
            case UserQuestion::TYPE_CALL:
                $data[LeadFields::FIELD_TITLE] = 'Замовлення дзвінка';
                $date = $question->call_date->format('d.m.Y');
                $comment .= "<div><b>Замовлення дзвінка</b></div>";
                $comment .= "<div><b>Дата:</b> $date</div>";
                $comment .= "<div><b>Час:</b> $question->call_time</div>";
                $comment .= "<div><b>Коментар:</b> $question->comment</div>";
                break;
            case UserQuestion::TYPE_QUESTION:
                $data[LeadFields::FIELD_TITLE] = 'Нове питання';
                $type = UserQuestion::QUESTION_TYPES[$question->question_type ?? 'other'];
                $comment .= "<div><b>Нове питання</b></div>";
                $comment .= "<div><b>Тип:</b> $type</div>";
                $comment .= "<div><b>Питання:</b> $question->comment</div>";
                break;
            default:
                $data[LeadFields::FIELD_TITLE] = 'Нове повідомлення';
                $comment .= "<div><b>Нове повідомлення</b></div>";
                $comment .= "<div><b>Коментар:</b> $question->comment</div>";
                break;
        }
        if ($is_test) {
            $comment .= "<div><b>Тестування</b></div>";
        }
        $data[LeadFields::FIELD_COMMENTS] = $comment;

        $data[LeadFields::FIELD_UTM_SOURCE] = $question->utm_source;
        $data[LeadFields::FIELD_UTM_CAMPAIGN] = $question->utm_campaign;
        $data[LeadFields::FIELD_UTM_MEDIUM] = $question->utm_medium;
        $data[LeadFields::FIELD_UTM_CONTENT] = $question->utm_content;
        $data[LeadFields::FIELD_UTM_TERM] = $question->utm_term;

        $response = LeadService::add($data, ['REGISTER_SONET_EVENT' => $is_test ? 'N' : 'Y']);
        if (!$response->error) {
            $question->bitrix_id = $response->result;
            $question->bitrix_contact_id = $contactId;
            $question->save();
        }
    }
}
