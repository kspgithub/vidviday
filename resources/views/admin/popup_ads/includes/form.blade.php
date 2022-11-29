<x-bootstrap.card>
    <x-slot name="body">

        <x-forms.translation-switch/>

        <x-forms.textarea-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $advertisement->getTranslations('title'))"
                                    rows="2"
                                    required></x-forms.textarea-loc-group>

        <x-forms.text-loc-group name="url" :label="__('Url')"
                                :value="old('url', $advertisement->getTranslations('url'))"
                                help="Не обов'язково"
        ></x-forms.text-loc-group>

        <x-forms.editor-loc-group name="text" :label="__('Text')"
                                  :value="old('text', $advertisement->getTranslations('text'))"></x-forms.editor-loc-group>

        <x-forms.single-image-upload name="image" :label="__('Image')"
                                     :value="$advertisement->image"
                                     :preview="$advertisement->image ? $advertisement->image_url : ''"
                                     imgstyle="height: 200px;"/>

        <x-forms.datepicker-group name="starts_at" :label="__('Starts at')"
                                  :value="old('starts_at', $advertisement->starts_at)"
        ></x-forms.datepicker-group>

        <x-forms.tag-group name="pages[]"
                           :label="__('Pages')"
                           :value="$advertisement->pages ?: []"
                           :options="$pages">
        </x-forms.tag-group>

        <x-forms.text-group name="timeout"
                            :label="__('Timeout')"
                            :value="$advertisement->timeout ?: 5000"
        />

        <x-forms.switch-group name="published" :label="__('Published')" :active="$advertisement->published"/>

        @if($advertisement->exists)
            <x-bootstrap.card>
                <x-slot name="body">

                    <h2>Rules</h2>

                    <div x-data='{
                        items: @json($advertisement->rules),
                        model_type: "0",
                        model_id: "0",
                        init(){
                            this.$watch("model_type", (type) => {
                                this.model_id = "0"
                            })
                        },
                        add(){
                            axios.patch("{{ route('admin.popup-ads.add-rule', $advertisement) }}", {
                                rule: {
                                    model_type: this.model_type,
                                    model_id: this.model_id,
                                }
                            }).then(response => {
                                location.reload()
                            })
                        },
                        remove(id){
                            axios.delete("{{ route('admin.popup-ads.remove-rule', $advertisement) }}", {
                                params: {id}
                            }).then(response => {
                                location.reload()
                            })
                        },
                    }'>
                        <div>
                            <div>
                                <x-forms.select-group name="model_type" :label="__('Type')"
                                                      x-model="model_type"
                                                      :select2="true"
                                                      :allowClear="true"
                                                      :placeholder="__('Не вибрано')"
                                                      :options="$types">
                                </x-forms.select-group>

                                <x-forms.select-group name="model_id" :label="__('Model')"
                                                      x-model="model_id"
                                                      :select2="true"
                                                      :allowClear="true"
                                                      x-bind:filters="JSON.stringify({type: model_type})"
                                                      x-bind:disabled="model_type == 0"
                                                      autocomplete="/api/page_types?paginate=1"
                                                      :placeholder="__('Всі')">
                                </x-forms.select-group>

                                <button class="btn btn-primary" type="submit" x-on:click.prevent="add()">Додати</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('Type')</th>
                                        <th>@lang('Model')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template x-for="(item, i) in items">
                                        <tr>
                                            <td x-html="i"></td>
                                            <td x-html="item.model_type"></td>
                                            <td x-html="item.model_id == 0 ? 'Всі' : item.model.title.{{app()->getLocale()}}"></td>
                                            <td>
                                                <button class="btn btn-danger" type="submit" x-on:click.prevent="remove(item.id)">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-bootstrap.card>
        @endif

    </x-slot>
</x-bootstrap.card>

