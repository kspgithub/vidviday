<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-basic-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="order.id"></span>, загальна інформація</h5>
                    <button type="button" class="btn-close" @click.prevent="resetData()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-forms.text-group x-model="data.first_name" name="first_name" label="Ім'я"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="data.last_name" name="last_name" label="Прізвище"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group type="tel" x-model="data.phone" name="phone" label="Телефон"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group type="email" x-model="data.email" name="email" label="Email"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="data.viber" name="viber" label="Viber"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="data.company" name="viber" label="Компанія"
                                        label-col="col-md-3" input-col="col-md-9"/>

                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">Тур <span class="text-danger">*</span></div>
                        <div class="col-md-9">
                            <select name="tour_id" x-model="data.tour_id" id="tourSelectBox" class="form-control"
                                    required>
                                @if($tour)
                                    <option value="{{$tour->id}}" selected>
                                        {{$tour->title}} - {{$tour->price}} {{$tour->currency}}
                                    </option>
                                @endif
                            </select>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">Дата виїзду <span class="text-danger">*</span></div>
                        <div class="col-md-9">

                            <select name="schedule_id" x-model="data.schedule_id" class="form-control" required>
                                <option value="">оберіть дату виїзду</option>
                                <template x-for="sch in schedules" :key="'shc-'+sch.id">
                                    <option :value="sch.id" x-text="sch.start_title"></option>
                                </template>
                            </select>
                        </div>

                    </div>
                    <x-forms.text-group type="number" x-model.number="data.places" name="places" label="Дорослих"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">З дітьми</div>
                        <div class="col-md-9">
                            <x-input.switch id="children" x-model="data.children"/>
                        </div>
                    </div>
                    <template x-if="data.children">
                        <div class="row mb-3">
                            <div class="col-md-3 col-form-label">Діти до 6 років</div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" x-model.number="data.children_young">
                            </div>
                        </div>
                    </template>
                    <template x-if="data.children">
                        <div class="row mb-3">
                            <div class="col-md-3 col-form-label">Діти від 6 до 12 років</div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" x-model.number="data.children_older">
                            </div>
                        </div>
                    </template>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            @click.prevent="resetData()">Скасувати
                    </button>
                    <button type="button" class="btn btn-primary"
                            data-bs-dismiss="modal"
                            @click.prevent="updateOrder()">
                        Зберегти
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>
