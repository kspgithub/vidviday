<?php

namespace App\View\Components;

use App\View\Components\Interfaces\ServerRenderable;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class VueComponent extends Component implements ServerRenderable
{

    /**
     * @var string
     */
    public string $component;

    /**
     * @var array
     */
    public $props = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $component, array $props = [])
    {
        $this->component = $component;
        $this->props = $props;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        $page['component'] = $this->component;
        $page['props'] = $this->props;

        $view = view('components.vue-component', $page);

        try {
            $url = 'http:/localhost:3000/render';

            $html = Http::post($url, $page)->throw()->body();

            return $html;

        } catch (\Exception $e) {

            return $view;
        }
    }
}
