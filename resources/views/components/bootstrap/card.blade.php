@php
    $id = isset($collapse) ? $collapse : 'card-'.time();
@endphp
<div class="card">
    @if (isset($header))
        @if(isset($collapse))
            <div class="card-header d-flex align-items-center justify-content-between">
                {{ $header }}
                <button data-bs-toggle="collapse" class="accordion-button collapsed"
                        data-bs-target="#{{$id}}">

                </button>
            </div>

        @else
            <div class="card-header">
                {{ $header }}

                @if (isset($headerActions))
                    <div class="card-header-actions">
                        {{ $headerActions }}
                    </div><!--card-header-actions-->
                @endif
            </div><!--card-header-->

        @endif

    @endif

    @if (isset($body))
        <div class="card-body {{isset($collapse) ? 'collapse' : ''}}"
             id="{{$id}}">
            {{ $body }}
        </div><!--card-body-->
    @endif

    @if (isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div><!--card-footer-->
    @endif
</div><!--card-->
