<div x-data='placeList({
    request: @json(request()->all()),
    regions: @json($regions),
})'>
    <div>
        <div class="row">
            <div class="col-auto mb-3">
                <input type="text" class="form-control" placeholder="Пошук..."
                       x-model.debounce.300ms="q"
                       @change="filterChange()"
                >
            </div>
            <div class="col-auto mb-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">Область</div>
                    <select class="form-control" x-model.number="region_id" @change="regionsChange()">
                        <option value="0">Не вибрано</option>
                        <template x-for="option in regions">
                            <option :value="option.value" x-html="option.text"
                                    :selected="region_id === option.value"></option>
                        </template>
                    </select>
                </div>

            </div>
            <div class="col-auto mb-3">
                <div class="d-flex align-items-center">
                    <div class="me-2">Район</div>
                    <select class="form-control" x-model.number="district_id" @change="filterChange()">
                        <option value="0">Не вибрано</option>
                        <template x-for="option in districts">
                            <option :value="option.value" x-html="option.text"
                                    :selected="district_id === option.value"></option>
                        </template>
                    </select>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped" :class="{loading: request}">
                    <thead>
                    <tr>
                        <th>{!! alpineSortLink('id', 'ID')!!}</th>
                        <th>{!! alpineSortLink('title->uk', 'Назва')!!}</th>
                        <th>Область</th>
                        <th>Район</th>
                        <th>{!! alpineSortLink('published', 'Опубл.')!!}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <template x-for="item in items" :key="'item-'+item.id">
                        <tr>
                            <td><span x-text="item.id"></span></td>
                            <td><span x-text="item.title.uk"></span></td>
                            <td><span x-text="item.region ? item.region.title.uk : ''"></span></td>
                            <td><span x-text="item.district ? item.district.title.uk : ''"></span></td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           :id="'publish-'+item.id"
                                           x-model="item.published"
                                           @change="updateItem(item.id, {published: item.published})"
                                    >
                                    <label class="form-check-label" :for="'publish-'+item.id"></label>
                                </div>
                            </td>
                            <td>
                                <a :href="`/admin/place/${item.id}/edit`"
                                   class="btn btn-sm btn-outline-success my-1 me-2">
                                    <i class="fa fa-pen-alt"></i>
                                </a>
                                <a :href="`/admin/place/${item.id}/delete`"
                                   @click.prevent="deleteItem(item.id)"
                                   class="btn btn-sm btn-outline-danger my-1 me-2">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>
        </div>

        {!! alpinePagination() !!}
    </div>
</div>
