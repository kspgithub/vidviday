<?php

if (!function_exists('social_contacts')) {

    function social_contacts($contact)
    {
        return [
            ...($contact?->skype ? ['skype' => [
                'href' => skype_link($contact->skype),
                'icon' => 'skype.png',
                'svg-icon' => 'icon-skype',
            ]] : []),
            ...($contact?->viber ? ['viber' => [
                'href' => viber_link($contact->viber),
                'icon' => 'viber.png',
                'svg-icon' => 'icon-viber',
            ]] : []),
            ...($contact?->telegram ? ['telegram' => [
                'href' => tg_link($contact->telegram),
                'icon' => 'telegram.png',
                'svg-icon' => 'icon-telegram',
            ]] : []),
            ...($contact?->whatsapp ? ['whatsapp' => [
                'href' => whatsapp_link($contact->whatsapp),
                'icon' => 'whatsapp.png',
                'svg-icon' => 'icon-whatsapp',
            ]] : []),
            ...($contact?->messenger ? ['messenger' => [
                'href' => messenger_link($contact->messenger),
                'icon' => 'messenger.png',
                'svg-icon' => 'icon-messenger',
            ]] : []),
        ];
    }
}
