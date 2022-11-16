<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageObserver
{
    /**
     * Handle the Page "updated" event.
     *
     * @param \App\Models\Page $page
     * @return void
     */
    public function updated(Page $page)
    {
        // Update site menu cache
        if ($page->isDirty(['published', 'slug'])) {
            Cache::forget('header-menu');
        }
    }
}
