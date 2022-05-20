<?php

namespace App\View\Components\Page;

use App\Models\HtmlBlock;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Regulations extends Component
{
    public Page $page;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        //
        $this->page = $page;
    }

    protected function injectHtmlBlocks()
    {
        $text = $this->page->text;
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
        $this->page->text = $text;
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
