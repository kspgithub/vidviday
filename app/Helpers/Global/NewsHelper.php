<?php

use App\Models\News;

if (!function_exists("latestNews")){

    function latestNews(int $take = 3){

        return News::wherePublished(true)->latest()->take($take)->get();
    }
}
