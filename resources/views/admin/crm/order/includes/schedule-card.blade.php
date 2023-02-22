@php
    $attributes = [
        ['key' => 'status', 'type' => 'select', 'label' => 'Статус', 'options' => $statuses],
        ['key' => 'tour_id', 'type' => 'select', 'label' => 'Тур', 'options' => $order->tour ? [['value' => $order->tour->id, 'text' => "{$order->tour->title} - {$order->tour->price} {$order->tour->currency}"]] : []],
        ['key' => 'schedule_id', 'type' => 'select', 'label' => 'Дата виїзду', 'options' => $order->schedule ? [['value' => $order->schedule->id, 'text' => $order->schedule->start_title]] : []],
        ['key' => 'places', 'type' => 'number', 'label' => 'Дорослих'],
        ['key' => 'children_young', 'type' => 'text', 'label' => 'З дітьми'],
    ];
@endphp
<div class="card" x-data='crmOrderSchedule({order: @json($order), attributes: @json($attributes)})'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Інформація про виїзд</h3>
        </div>
        <table class="table table-bordered">
            <tbody>
            <template x-for="attribute in attributes">
                <tr>
                    <th style="width: 300px" x-text="attribute.label"></th>
                    <td>
                        <template x-if="!isEditable(attribute.key)">
                            <div>
                                <b x-text="getValue(attribute)"></b>
                                <a href="#" @click.prevent="editAttribute(attribute.key)" class="ms-3 text-success">
                                    <i class="fa fa-pen"></i>
                                </a>
                            </div>
                        </template>
                        <template x-if="isEditable(attribute.key)">
                            <form @submit.prevent="saveAttribute(attribute.key)">
                                <div class="d-flex align-items-center">
                                    <template x-if="['text', 'email', 'tel', 'number'].includes(attribute.type)">
                                        <input x-bind:type="attribute.type || 'text'" x-model="schedule[attribute.key]"
                                               class="form-control form-control-sm me-3"
                                               x-bind="attribute.inputAttrs || {}">
                                    </template>

                                    <template x-if="attribute.type === 'select'">
                                        <select x-model="schedule[attribute.key]"
                                                x-bind:name="attribute.key"
                                                x-bind:id="attribute.id"
                                                class="form-control"
                                                required>
                                            <template x-for="(option, key) in (attribute.options || [])">
                                                <option x-bind:value="option.value"
                                                        x-bind:selected="option.value == schedule[attribute.key]"
                                                        x-text="option.text"></option>
                                            </template>
                                        </select>
                                    </template>

                                    <button type="submit" class="btn btn-sm btn-outline-success me-3">
                                        <i class="fa fa-save"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary me-3"
                                            @click.prevent="cancelAttribute(attribute.key)">
                                        <i class="far fa-times-circle"></i>
                                    </button>
                                </div>

                            </form>
                        </template>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</div>
