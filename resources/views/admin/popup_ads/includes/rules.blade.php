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
