@props([
    'title'=>'',
    'backUrl'=>'',
    'updateUrl'=>'',
    'edit'=>false,
    'expanded'=>false,
    'containerClass'=>''
])
<div>
    <div class="d-flex justify-content-between">
        <h1>{{$title}}</h1>

        <div class="d-flex align-items-center">
            @if(!empty($backUrl))
                <a href="{{$backUrl}}" class="btn btn-sm btn-outline-secondary">@lang('Cancel')</a>
            @endif
        </div>
    </div>
    <div x-data="translatable({expanded: {{$expanded ? 'true': 'false'}}})" class="{{$containerClass}}">
        <x-forms.post :action="$updateUrl" enctype="multipart/form-data" x-ref="form">
            @if($edit)
                @method('PATCH')
            @endif

            {{$slot}}

            <button class="btn btn-primary" type="submit"
                    x-on:click.prevent="submit($event, true)">@lang('Save')</button>
        </x-forms.post>
    </div>
</div>
