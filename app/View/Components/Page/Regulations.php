<?php

namespace App\View\Components\Page;

use App\Models\HtmlBlock;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Regulations extends Component
{
    public Model|null $model;

    public string $seoText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model|null $model = null)
    {
        //
        $this->model = $model;
    }

    protected function injectHtmlBlocks()
    {
        $text = '';

        if($this->model) {
            $text = $this->model instanceof Page ? $this->model->text : $this->model->seo_text;
        }

        preg_match_all("/\{\{([^\}\}]*)\}\}/", $text, $matches);
        if($matches[0] && $matches[1]) {
            foreach ($matches[1] as $i => $slug) {
                $htmlBlock = HtmlBlock::query()->where('slug', $slug)->first();
                $html = '';
                if($htmlBlock) {
                    $html = $htmlBlock->text;
                }
                $text = Str::replace($matches[0][$i], $html, $text);
            }
        }
        $this->seoText = (string) $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->injectHtmlBlocks();

        return view('components.page.regulations');
    }
}
