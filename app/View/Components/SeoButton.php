<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoButton extends Component
{
    public ?int $id;

    public string $tag;

    public string $as;

    public string $key;

    public array $config;

    public function __construct(string $key, ?int $id = null, bool $ssr = false, string $tag = 'button', string $as = 'button', ?string $href = null) {
        $this->key = $key;
        $this->id = $id;
        $this->tag = $ssr ? 'component' : ($href ? 'a' : $tag);
        $this->as = $ssr ? 'seo-button' : $as;
        $this->config = app('seo-buttons')->get($key, []);
        $this->config['id'] = $this->config['id'] ?? $key;
        if($this->id) {
            $this->config['id'] .= '-' . $this->id;
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
