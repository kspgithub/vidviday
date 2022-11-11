<?php

if (! function_exists('alpineSortLink')) {
    function alpineSortLink($column, $title = '')
    {
        $html = "<a href='#' class='text-nowrap' @click.prevent=\"setSorting(sort === '$column:asc' ? '$column:desc': '$column:asc')\">
$title
<i class='fas fa-sort' x-show=\"sort !== '$column:asc' && sort !== '$column:desc'\"></i>
<i class='fas fa-sort-up' x-show=\"sort === '$column:asc'\"></i>
<i class='fas fa-sort-down' x-show=\"sort === '$column:desc'\"></i>
</a>";

        return $html;
    }
}

if (! function_exists('alpinePagination')) {
    function alpinePagination()
    {
        return '<template x-if="links.length">
        <nav>
            <ul class="pagination">
                <template x-for="link in links">
                    <li class="page-item" x-bind:class="{disabled: !link.url, active: link.active}">
                        <template x-if="link.url">
                            <a class="page-link" x-on:click.prevent="setPage(link.url)" x-bind:href="link.url"
                               x-html="link.label"></a>
                        </template>
                        <template x-if="!link.url">
                            <span class="page-link" x-html="link.label"></span>
                        </template>
                    </li>
                </template>
            </ul>
        </nav>
    </template>';
    }
}
