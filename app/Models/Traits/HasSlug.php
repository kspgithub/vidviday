<?php

namespace App\Models\Traits;

trait HasSlug
{
    use \Spatie\Sluggable\HasSlug;

    protected function generateSlugOnCreate()
    {
        $this->slugOptions = $this->getSlugOptions();

        if (! $this->slugOptions->generateSlugsOnCreate) {
            return;
        }

        if ($this->slugOptions->preventOverwrite) {
            if (!empty($this->{$this->slugOptions->slugField})) {
                return;
            }
        }

        $this->addSlug();
    }
}
