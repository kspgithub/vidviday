<?php $link = "" ?>

<div class="breadcrumbs" style="position:relative;top:-20px;left:0px;">
    @for($i = 1; $i <= count(Request::segments()); $i++)
        @php
            if(is_numeric(Request::segment($i)))
                continue;
        @endphp
        @if($i < count(Request::segments()) & $i > 0)
            <?php $link .= "/" . Request::segment($i); ?>
            <a href="<?= $link ?>">{{ ucwords(trans(str_replace('-',' ',Request::segment($i)))) }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
        @else {{ucwords(trans(str_replace('-',' ',Request::segment($i))))}}
        @endif
    @endfor
</div>

