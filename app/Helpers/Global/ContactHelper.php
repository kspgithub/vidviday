<?php

function social_contacts($contact) {
    return [
        ...($contact?->skype ? ['skype' => [
            'href' => skype_link($contact->skype),
            'icon' => 'icon-skype',
        ]] : []),
        ...($contact?->viber ? ['viber' => [
            'href' => viber_link($contact->viber),
            'icon' => 'icon-viber',
        ]] : []),
        ...($contact?->telegram ? ['telegram' => [
            'href' => tg_link($contact->telegram),
            'icon' => 'icon-telegram',
        ]] : []),
        ...($contact?->whatsapp ? ['whatsapp' => [
            'href' => whatsapp_link($contact->whatsapp),
            'icon' => 'icon-whatsapp',
        ]] : []),
        ...($contact?->messenger ? ['messenger' => [
            'href' => messenger_link($contact->messenger),
            'icon' => 'icon-messenger',
        ]] : []),
    ];
}
