<?php

namespace App\View\Components;

use App\Models\Contact;
use App\Models\Menu;
use App\Models\Page;
use App\Models\QuestionType;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use Storage;

class SiteFooter extends Component
{

    public Contact $contact;
    public $menu = [];
    public $showOnMapUrl;
    public $complaintsImage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: Кеширование
        $this->contact = Contact::first();
        $this->menu = Menu::whereSlug('footer')->with([
            'items' => fn ($q) => $q->with('model:id,slug,published')->published()->where('parent_id', 0),
            'items.children' => fn ($q) => $q->with('model:id,slug,published')->published()
        ])->first();

        $pageContacts = Page::query()->where('key', 'our-contacts')->first();
        $this->showOnMapUrl = $pageContacts ? ($pageContacts->url . '#map-route') : 'https://www.google.com.ua/maps/place/%D0%B2%D1%83%D0%BB%D0%B8%D1%86%D1%8F+%D0%97%D0%B0%D0%BC%D0%B0%D1%80%D1%81%D1%82%D0%B8%D0%BD%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0,+34,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2,+%D0%9B%D1%8C%D0%B2%D1%96%D0%B2%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C,+79000/@49.85046,24.0264711,19z/data=!3m1!4b1!4m5!3m4!1s0x473add0bf678163d:0xf262ca160f7d2864!8m2!3d49.8504591!4d24.0270183?hl=uk&authuser=0';

        $img = site_option('complaints_image');

        $this->complaintsImage = $img ? Storage::url(site_option('complaints_image')) : null;

        $questionTypes = Cache::rememberForever('question-types', function () {
            return QuestionType::query()->published()->get();
        });

        View::share('questionTypes', $questionTypes);
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layout.includes.footer');
    }
}
