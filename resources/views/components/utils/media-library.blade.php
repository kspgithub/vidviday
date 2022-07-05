<div x-data='mediaLibrary({
        items: @json($items),
        collection: "{{$collection}}",
        storeUrl: "{{$storeUrl}}",
        updateUrl: "{{$updateUrl}}",
        destroyUrl: "{{$destroyUrl}}",
        orderUrl: "{{$orderUrl}}",
     })'>
    <div class="form-group row my-3">
        <div class="col-form-label col-md-2">
            @lang('Translations')
        </div>

        <div class="col-md-10">
            <div class="d-flex align-items-center">
                @foreach(siteLocales() as $lang)
                    <a href="#" x-on:click.prevent="locale = '{{ $lang }}'"
                       :class="{['btn-primary']: locale === '{{ $lang }}'}"
                       :disabled="locale === '{{ $lang }}'"
                       class="btn btn-md btn-default">{{strtoupper($lang)}}</a>
                @endforeach
            </div>
        </div>
    </div>
    <hr>


    <div class="media-library">

        <div class="media-sortable draggable-container" x-ref="sortableRef">
            <template x-for="(item, idx) in items">

                <div class="media-item img-thumbnail" x-bind:id="'media-item-'+idx" x-bind:data-id="item.id"
                     x-bind:class="{error: !!item.error}">
                    <img x-bind:src="item.thumb" x-bind:alt="item.alt[locale] || ''"
                         x-bind:title="item.title[locale] || ''">
                    <div x-show="item.loader" class="spinner-border text-warning" role="status"></div>
                    <template x-if="item.id">
                        <div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" :id="'item_'+item.id+'_published'"
                                       x-model="item.published" @change="toggleMediaItem(item)">
                                <label class="form-check-label" :for="'item_'+item.id+'_published'"></label>
                            </div>

                            <a href="#" @click.prevent="deleteMediaItem(item)" class="delete-media-item">
                                <i class="fas fa-times"></i>
                            </a>
                            <a x-bind:href="item.url" class="show-media-item" target="_blank"
                               x-bind:data-fancybox="collection">
                                <i class="fas fa-eye"></i>
                            </a>
                            <span class="handler fas fa-bars"></span>

                            <input class="edit-media-title" x-model="item.title[locale]"
                                   @change="updateMediaTitle(item)"
                                   @focus="$event.target.placeholder = ''"
                                   @blur="$event.target.placeholder = '{{__('Change image title')}}'"
                                   placeholder="{{__('Change image title')}}"/>

                            <input class="edit-media-alt" x-model="item.alt[locale]"
                                   @focus="$event.target.placeholder = ''"
                                   @blur="$event.target.placeholder = '{{__('Change image alt')}}'"
                                   @change="updateMediaAlt(item)"
                                   placeholder="{{__('Change image alt')}}"/>
                        </div>
                    </template>

                    <span class="error" x-show="item.error" x-text="item.error || ''"></span>
                </div>
            </template>
        </div>

        <label class="img-thumbnail add-media">
            <input type="file" multiple accept="{{$accept}}" @change="onFileChange()" x-ref="fileRef">
            <i class="fas fa-plus"></i>
        </label>
    </div>

</div>
