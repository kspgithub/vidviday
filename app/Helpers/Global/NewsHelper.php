<?php

use App\Models\News;


if (!function_exists("latestNews")) {

    function latestNews(int $take = 3)
    {
        return News::published()->latest()->take($take)->get();
    }
}
