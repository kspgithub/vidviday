@php
    $attributes = [
        ['key' => 'last_name', 'type' => 'text', 'label' => 'Прізвище'],
        ['key' => 'first_name', 'type' => 'text', 'label' => 'Ім\'я'],
        ['key' => 'middle_name', 'type' => 'text', 'label' => 'По батькові'],
        ['key' => 'birthday', 'type' => 'text', 'label' => 'Дата народження', 'inputAttrs' => ['x-datepicker' => 'x-datepicker']],
        ['key' => 'phone', 'type' => 'tel', 'label' => 'Телефон', 'inputAttrs' => ['x-mask' => '+38 (999) 999-99-99']],
        ['key' => 'email', 'type' => 'email', 'label' => 'Email'],
        ['key' => 'viber', 'type' => 'text', 'label' => 'Viber', 'inputAttrs' => ['x-mask' => '+38 (999) 999-99-99']],
        ['key' => 'company', 'type' => 'text', 'label' => 'Компанія'],
    ];
@endphp
<div class="card" x-data='crmOrderCustomer({order: @json($order), attributes: @json($attributes)})'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Інформація про замовника</h3>
        </div>
        <table class="table table-bordered">
            <tbody>
            <template x-for="attribute in attributes">
                <tr>
                    <th style="width: 50%" x-text="attribute.label"></th>
                    <td>
                        <template x-if="!isEditable(attribute.key)">
                            <div>
                                <b x-text="customer[attribute.key]"></b>
                                <a href="#" @click.prevent="editAttribute(attribute.key)" class="ms-3 text-success">
                                    <i class="fa fa-pen"></i>
                                </a>
                            </div>
                        </template>
                        <template x-if="isEditable(attribute.key)">
                            <form @submit.prevent="saveAttribute(attribute.key)">
                                <div class="d-flex align-items-center">
                                    <input x-bind:type="attribute.type || 'text'" x-model="customer[attribute.key]"
                                           class="form-control form-control-sm me-3" x-bind="attribute.inputAttrs || {}">
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
