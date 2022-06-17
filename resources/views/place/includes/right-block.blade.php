<div class="col-xl-4 col-12">
    <div class="bordered-box">
        <div class="thumb-price text-center-sm">
            <span
                class="text"><b>Ціна:</b> від <span>{{(int)$price_from}}</span> до <span>{{(int)$price_to}}</span><sup>грн</sup></span>
        </div>
        <hr class="only-desktop only">
        <a href="#" download class="download only-desktop only" v-is="'print-btn'">
            <span class="text-md text-medium">Завантажити для друку</span>
        </a>
        <hr class="only-desktop only">
        <x-sidebar.social-share :share-url="route('place.show', $place)" :share-title="$place->title" class="only-desktop only"/>
    </div>
</div>
