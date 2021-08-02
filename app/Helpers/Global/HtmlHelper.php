<?php

if (! function_exists('activeClass')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function activeClass($condition, string $activeClass = 'active', string $inactiveClass = '') : string
    {
        return $condition ? $activeClass : $inactiveClass;
    }
}

if (! function_exists('routeActiveClass')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function routeActiveClass($routeName, $activeClass = 'active', $inactiveClass = '')
    {
        $match = false;
        $currentName = request()->route()->getName();
        if (is_array($routeName)) {
            foreach ($routeName as $route) {
                $match = $currentName === $route || (str_ends_with($route, '*') && str_starts_with($currentName, rtrim($route, "*")));
                if ($match) {
                    return $activeClass;
                }
            }
        } else {
            $match = $currentName === $routeName || (str_ends_with($routeName, '*') && str_starts_with($currentName, rtrim($routeName, "*")));
        }
        return $match ? $activeClass : $inactiveClass;
    }
}

if (! function_exists('htmlLang')) {
    /**
     * Access the htmlLang helper.
     */
    function htmlLang()
    {
        return str_replace('_', '-', app()->getLocale());
    }
}

if (! function_exists('svg')) {
    /**
     * Embed svg icon.
     *
     * @param $icon
     * @param string $class
     */
    function svg($icon, $class = '')
    {
        $svg = new \DOMDocument();
        $svg->load(resource_path("svg/$icon.svg"));
        $svg->documentElement->setAttribute("class", $class);
        echo $svg->saveXML($svg->documentElement);
    }
}

if (! function_exists('breadcrumbs')) {
    /**
     * @param array $items
     *
     * @return string
     */
    function breadcrumbs($items = [])
    {
        $result = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
        $lastItemKey = count($items) - 1;
        foreach ($items as $key=>$item) {
            $activeClass = $key === $lastItemKey ? ' active' : '';
            $result .= '<li class="breadcrumb-item'.$activeClass.'" itemscope itemtype = "http://data-vocabulary.org/Breadcrumb">';
            if ($key < count($items) - 1) {
                $result .= '<a href="'.$item['url'].'" itemprop="url"><span itemprop="title">'.$item['title'].'</span></a>';
            } else {
                $result .= '<link href="'.$item['url'].'" itemprop="url" /><span itemprop="title">'.$item['title'].'</span>';
            }
            $result .= '</li>';
        }
        $result .= '</ol></nav>';

        return $result;
    }
}

if (! function_exists('html_block')) {
    function html_block($slug)
    {
        return \App\Models\HtmlBlock::getCachedBlock($slug);
    }
}
