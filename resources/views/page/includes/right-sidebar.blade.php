<div class="right-sidebar">
    <div class="right-sidebar-inner">
        @if(in_array('share', $pageContent->sidebar_items))
            <div class="bordered-box only-desktop-pad">
                <x-sidebar.download-print/>
                <hr>
                <x-sidebar.social-share/>
            </div>
        @endif
        @if(in_array('contacts', $pageContent->sidebar_items))
            <x-sidebar.contact/>
        @endif
        @if(in_array('testimonials', $pageContent->sidebar_items))
            <x-sidebar.testimonials/>
        @endif
    </div>
</div>

