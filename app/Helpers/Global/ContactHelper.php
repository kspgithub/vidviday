<?php

if (!function_exists('social_contacts')) {

    function social_contacts($contact)
    {
        return [
            ...($contact?->skype ? ['skype' => [
                'href' => skype_link($contact->skype),
                'icon' => 'skype.png',
            ]] : []),
            ...($contact?->viber ? ['viber' => [
                'href' => viber_link($contact->viber),
                'icon' => 'viber.png',
            ]] : []),
            ...($contact?->telegram ? ['telegram' => [
                'href' => tg_link($contact->telegram),
                'icon' => 'telegram.png',
            ]] : []),
            ...($contact?->whatsapp ? ['whatsapp' => [
                'href' => whatsapp_link($contact->whatsapp),
                'icon' => 'whatsapp.png',
            ]] : []),
            ...($contact?->messenger ? ['messenger' => [
                'href' => messenger_link($contact->messenger),
                'icon' => 'messenger.png',
            ]] : []),
        ];
    }
}
