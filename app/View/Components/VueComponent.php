<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;
use Spatie\Ssr\Facades\Ssr;

class VueComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $component,
        public $props = [],
    ){}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        try {
            $ssrUrl = 'http://127.0.0.1:3333/render';

            $response = Http::post($ssrUrl, [
                'component' => $this->component,
                'props' => $this->props,
            ]);

            $html = $response->body();

            return $html;
        } catch (\Exception) {
            try {
                $ssr = Ssr::entry('assets/ssr/ssr.js')
                    ->context('component', $this->component)
                    ->context('props', $this->props);

                return $ssr->render();
            } catch (\Exception $e) {
                return view('components.vue-component');
            }
        }
    }
}
