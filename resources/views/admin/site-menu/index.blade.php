@extends('admin.layout.app')

@section('title', __('Site menu'))

@section('content')
    <div x-data='menuEditor(@json($menus))'>
        <div class="d-flex justify-content-between mb-5">
            <h1>@lang('Site menu')</h1>

            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <x-forms.translation-switch/>
            </div>
        </div>

        <div class="row">
            <template x-for="menu in menus">
                <div class="col-12 col-md-6" x-data="menuList(menu)">
                    <h4 class="mb-2">
                        <span x-text="menu.title[trans_locale]"></span>
                        <a x-bind:href="'/admin/site-menu/'+menu.slug+'/create'" class="text-success ms-3"
                           title="{{__('Create Menu Item')}}">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </h4>

                    <ul class="list-group"
                        @drop.prevent="onDrop"
                        @dragover.prevent="$event.dataTransfer.dropEffect = 'move'"
                    >
                        <template x-for="(item, index) in items" x-bind:key="'menu-item-'+item.id">
                            <li class="list-group-item"
                                x-data="menuItem(item)"
                                draggable="true"
                                x-bind:class="{'bg-light': dragging === index}"
                                @dragstart="onDragStart(index)"
                                @dragend="onDragEnd()">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-ellipsis-v cursor-move me-3 drag-handle"></i>
                                    <div>
                                        <span x-text="item.title[trans_locale] || item.title['uk']"></span><br>
                                        <span class="text-muted"
                                              x-text="item.slug[trans_locale] || item.slug['uk']"></span>
                                    </div>

                                    <div class="ms-auto">


                                        <span x-show="children && children.length > 0" x-on:click.prevent="toggle()"
                                              class="badge cursor-pointer bg-success me-3"
                                              title="{{__('Show Children')}}">
                                            <span x-text=" children.length || 0"></span>

                                            <i class="fas"
                                               x-bind:class="{'fa-chevron-down': !opened, 'fa-chevron-up': opened}"></i>
                                        </span>

                                        <a x-bind:href="'/admin/site-menu/'+menu.slug+'/create?parent_id='+item.id"
                                           title="{{__('Create Children Item')}}"
                                           class="text-success me-3">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>

                                        <div class="form-check form-switch form-check-inline me-3">
                                            <input class="form-check-input" type="checkbox"
                                                   x-on:change="changeStatus(item)"
                                                   x-bind:checked="item.published"
                                                   x-bind:id="'active-'+item.id">
                                            <label class="form-check-label" x-bind:for="'active-'+item.id"></label>
                                        </div>

                                        <a x-bind:href="'/admin/site-menu/'+item.id+'/edit'" class="text-primary  me-3"
                                           title="{{__('Edit Record')}}"
                                        >
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <a x-bind:href="'/admin/site-menu/'+item.id+'/delete'"
                                           x-on:click.prevent="deleteItem(item.id)" class="text-danger"
                                           title="{{__('Delete Record')}}"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <template x-if="opened" x-bind:key="'menu-item-child-'+item.id">
                                    <ul class="list-group mt-2" x-transition
                                        @drop.prevent="onDropCh"
                                        @dragover.prevent="$event.dataTransfer.dropEffect = 'move'"
                                    >
                                        <template x-for="(menuChildren, idx) in children"
                                                  x-bind:key="'menu-child-'+menuChildren.id">
                                            <li class="list-group-item"
                                                draggable="true"
                                                x-bind:class="{'bg-light': chDragging === idx}"
                                                @dragstart="childDrag = true; chDragging = idx;"
                                                @dragend="childDrag = false; chDragging = null"
                                            >
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-ellipsis-v cursor-move drag-handle me-3"></i>
                                                    <div>
                                                        <span
                                                            x-text="menuChildren.title[trans_locale] || menuChildren.title['uk']"></span><br>
                                                        <span class="text-muted"
                                                              x-text="menuChildren.slug[trans_locale] || menuChildren.slug['uk']"></span>
                                                    </div>

                                                    <div class="ms-auto">

                                                        <span class="badge bg-secondary me-4"
                                                              x-text="menuChildren.side"></span>

                                                        <div class="form-check form-switch  form-check-inline me-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                   x-on:change="changeStatus(menuChildren)"
                                                                   x-bind:checked="menuChildren.published"
                                                                   x-bind:id="'active-'+menuChildren.id">
                                                            <label class="form-check-label"
                                                                   x-bind:for="'active-'+menuChildren.id"></label>
                                                        </div>

                                                        <a x-bind:href="'/admin/site-menu/'+menuChildren.id+'/edit'"
                                                           class="text-primary me-3">
                                                            <i class="fas fa-pen"></i>
                                                        </a>

                                                        <a x-bind:href="'/admin/site-menu/'+item.id+'/delete'"
                                                           x-on:click.prevent="deleteChildren(menuChildren.id)"
                                                           class="text-danger"
                                                           title="{{__('Delete Record')}}"
                                                        >
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div style="inset: 0; opacity: 0.5; position: absolute"
                                                     x-show.transition="chDragging !== null"
                                                     :class="{'border': chDropping === idx, 'bg-light': chDropping === idx}"
                                                     @dragenter.prevent="onDragEnterCh(idx)"
                                                     @dragleave="onDragLeaveCh(idx)"></div>
                                            </li>
                                        </template>
                                    </ul>
                                </template>

                                <div style="inset: 0; opacity: 0.5; position: absolute"
                                     x-show.transition="dragging !== null"
                                     :class="{'border': dropping === index, 'bg-light': dropping === index}"
                                     @dragenter.prevent="onDragEnter(index)"
                                     @dragleave="onDragLeave(index)"></div>


                            </li>
                        </template>
                    </ul>
                </div>
            </template>

        </div>
    </div>


@endsection
