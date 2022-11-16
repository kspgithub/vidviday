<?php

use App\Models\HtmlBlock;

if (!function_exists('activeClass')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function activeClass($condition, string $activeClass = 'active', string $inactiveClass = ''): string
    {
        return $condition ? $activeClass : $inactiveClass;
    }
}

if (!function_exists('routeActive')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param string|array $routeName
     *
     * @return boolean
     */
    function routeActive($routeName)
    {
        $match = false;
        $currentName = request()->route()->getName();
        if (is_array($routeName)) {
            foreach ($routeName as $route) {
                $match = $currentName === $route ||
                    (str_ends_with($route, '*') && str_starts_with($currentName, rtrim($route, "*")));
                if ($match) {
                    return true;
                }
            }
        } else {
            $match = $currentName === $routeName ||
                (str_ends_with($routeName, '*') && str_starts_with($currentName, rtrim($routeName, "*")));
        }
        return $match;
    }
}

if (!function_exists('routeActiveClass')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param string|array $routeName
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function routeActiveClass($routeName, $activeClass = 'active', $inactiveClass = '')
    {
        return routeActive($routeName) ? $activeClass : $inactiveClass;
    }
}

if (!function_exists('htmlLang')) {
    /**
     * Access the htmlLang helper.
     */
    function htmlLang()
    {
        return str_replace('_', '-', app()->getLocale());
    }
}

if (!function_exists('svg')) {
    /**
     * Embed svg icon.
     *
     * @param $icon
     * @param string $class
     * @return string
     */
    function svg($icon, $class = '')
    {
        $svg = new DOMDocument();
        $svg->load(resource_path("svg/$icon.svg"));
        $svg->documentElement->setAttribute("class", $class);
        echo $svg->saveXML($svg->documentElement);
        return '';
    }
}

if (!function_exists('breadcrumbs')) {
    /**
     * @param array $items
     *
     * @return string
     */
    function breadcrumbs($items = [])
    {
        $result = '<nav aria-label="breadcrumb" class="breadcrumbs-wrapper"><ol class="breadcrumb">';
        $lastItemKey = count($items) - 1;
        foreach ($items as $key => $item) {
            if ($item !== null) {
                $activeClass = $key === $lastItemKey ? ' active' : '';
                $result .= '<li class="breadcrumb-item' . $activeClass . '" itemscope itemtype = "http://data-vocabulary.org/Breadcrumb">';
                if ($key < count($items) - 1) {
                    $result .= '<a href="' . $item['url'] . '" itemprop="url"><span itemprop="title">' . $item['title'] . '</span></a>';
                } else {
                    $result .= '<link href="' . $item['url'] . '" itemprop="url" /><span itemprop="title">' . $item['title'] . '</span>';
                }
                $result .= '</li>';
            }

        }
        $result .= '</ol></nav>';

        return $result;
    }
}

if (!function_exists('html_block')) {
    function html_block($slug)
    {
        return HtmlBlock::getCachedBlock($slug);
    }
}

if (!function_exists('youtube_embed')) {
    function youtube_embed($link)
    {
        if (preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $link, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        return '';
    }

}


if (!function_exists('date_title')) {
    function date_title($date)
    {
        if ($date) {
            return $date->translatedFormat('D') . ', ' . $date->format('d.m.Y');
        }
        return '';
    }
}


if (!function_exists('json_prepare')) {
    function json_prepare($string)
    {

        $string = str_replace('(', '&#40;', str_replace(')', '&#41;', $string));
        $string = str_replace('"', '&#34;', str_replace('\'', '&#39;', $string));
        return $string;
    }
}


if (!function_exists('tg_link')) {
    function tg_link($contact)
    {
        if (\Illuminate\Support\Str::startsWith($contact, '+')) {
            $contact = clear_phone($contact);
        }
        return 'https://t.me/' . $contact;
    }
}

if (!function_exists('whatsapp_link')) {
    function whatsapp_link($contact)
    {
        $contact = clear_phone($contact, false);
        return 'https://api.whatsapp.com/send?phone=' . $contact;
    }
}

if (!function_exists('viber_link')) {
    function viber_link($contact)
    {
        $contact = clear_phone($contact, false);
        return 'viber://chat?number=%2B' . $contact;
    }
}

if (!function_exists('messenger_link')) {
    function messenger_link($contact)
    {
        return 'https://m.me/' . $contact;
    }
}


if (!function_exists('skype_link')) {
    function skype_link($contact)
    {
        return 'skype:' . $contact;
    }
}

if (!function_exists('phone_link')) {
    function phone_link($contact)
    {
        $contact = clear_phone($contact);
        return 'tel:' . $contact;
    }
}

if (!function_exists('mail_link')) {
    function mail_link($contact)
    {
        return 'mailto:' . $contact;
    }
}
