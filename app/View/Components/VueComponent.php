<?php

namespace App\View\Components;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class VueComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $component,
        public array $props = [],
        public array $options = [],
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
     */
    public function render()
    {
        $name = $this->guessName();

        $prefix = 'assets/app/';
        $component = $this->component ?: 'test-component';
        $props = $this->props ?: [];

        $chunkPath = $prefix.'js/chunks/'.$name.'-vue';

        if (File::exists(public_path($chunkPath))) {
            return ssr('assets/ssr/ssr.js')
                ->context([
                    'component' => $component,
                    'props' => $props,
                ])
                ->render();
        } else {
            return view('components.vue-component', [
                'component' => $component,
                'props' => $props,
            ]);
        }
    }

    private function guessName()
    {
        $replaces = [];

        $name = Str::replace(array_keys($replaces), array_values($replaces), Str::kebab($this->component));

        return $name;
    }
}
