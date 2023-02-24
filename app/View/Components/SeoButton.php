<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoButton extends Component
{
    public ?int $id;

    public string $tag;

    public string $key;

    public array $config;

    public function __construct(string $key, ?int $id = null, ?string $href = null, string $tag = 'button') {
        $this->key = $key;
        $this->id = $id;
        $this->tag = $tag;
        $this->config = app('seo-buttons')->get($key, []);
        $this->config['id'] = $this->config['id'] ?? $key;
        $id && $this->config['id'] .= '-' . $this->id;

        if($href) {
            $this->config['href'] = $href;
            $this->tag = 'a';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.seo-button');
    }
}
