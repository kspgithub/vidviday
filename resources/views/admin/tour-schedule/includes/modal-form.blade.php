<template x-teleport="body">

    <div class="modal fade" tabindex="-1" id="editScheduleModal">
        <div class="modal-dialog">
            <form method="post" @submit.prevent="saveSchedule()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" x-show="scheduleData.id > 0">
                        Редагування виїзду #<span x-text="scheduleData.id"></span>
                    </h5>
                    <h5 class="modal-title" x-show="scheduleData.id === 0">Додавання виїзду</h5>

                    <button type="button" class="btn-close" @click.prevent="cancelSchedule()"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <x-forms.text-group label="Дата виїзду" x-bind:value="scheduleData.start_date" name="start_date"
                                            required x-ref="startDateRef"
                                            autocomplete="off"
                                            label-col="col-md-4" input-col="col-md-8"/>

                        <x-forms.text-group label="Дата повернення" x-bind:value="scheduleData.end_date" name="end_date"
                                            {{--                                            required x-ref="endDateRef"--}}
                                            disabled
                                            autocomplete="off"
                                            label-col="col-md-4" input-col="col-md-8"/>

                        <x-forms.text-group label="Вартість" x-model.number="scheduleData.price" name="price"
                                            required
                                            label-col="col-md-4" input-col="col-md-8"/>

                        <x-forms.text-group label="Комісія" x-model.number="scheduleData.commission" name="commission"
                                            required
                                            label-col="col-md-4" input-col="col-md-8"/>

                        <x-forms.text-group label="Допл. за поселення" x-model.number="scheduleData.accomm_price"
                                            name="accomm_price"
                                            required label-col="col-md-4" input-col="col-md-8"/>

                        <x-forms.text-group label="Ліміт місць" x-model="scheduleData.places" name="places"
                                            required
                                            label-col="col-md-4" input-col="col-md-8"/>


                        <div class="row mb-3">
                            <div class="col-md-4 col-form-label">Автобронь</div>
                            <div class="col-md-8">
                                <x-forms.check switch x-model="scheduleData.auto_booking"/>
                            </div>
                        </div>

                        <div x-show="scheduleData.auto_booking">
                            <x-forms.text-group label="Ліміт автоброні" x-model="scheduleData.auto_limit" name="places"
                                                x-bind:required="scheduleData.auto_booking"
                                                label-col="col-md-4" input-col="col-md-8"/>
                        </div>

                        <template x-if="!scheduleData.id">

                            <div>
                                <div class="form-group row mb-3">
                                    <label for="repeat" class="col-md-4 col-form-label">
                                        Повторення
                                    </label>

                                    <div class="col-md-8">
                                        <select name="repeat" id="repeat" class="form-control"
                                                x-model="scheduleData.repeat">
                                            <option value="">Без повторення</option>
                                            <option value="daily">Щодня</option>
                                            <option value="weekly">Щотижня</option>
                                            <option value="fortnightly">Кожні два тижні</option>
                                            <option value="custom">Індивідуальний графік</option>
                                        </select>
                                    </div>
                                </div>

                                <template x-if="scheduleData.repeat">
                                    <x-forms.text-group label="Кількість записів"
                                                        x-model.number="scheduleData.repeat_count"
                                                        name="repeat_count" required
                                                        label-col="col-md-4" input-col="col-md-8"/>
                                </template>

                                <template x-if="scheduleData.repeat === 'custom'">
                                    <div class="form-group row mb-3">
                                        <div class="col-md-4 col-form-label">
                                            Інтервал
                                        </div>

                                        <div class="col-md-8">
                                            <div class="d-flex align-items-center">
                                                <div class="me-1">
                                                    <select name="repeat_custom_interval" id="repeat_custom_interval"
                                                            class="form-control"
                                                            style="width: 250px"
                                                            x-model="scheduleData.repeat_custom_interval">
                                                        <option value="all">Кожну/кожен</option>
                                                        <option value="1">Кожну першу/кожен перший</option>
                                                        <option value="2">Кожну другу/кожен другий</option>
                                                        <option value="3">Кожну третю/кожен третій</option>
                                                        <option value="4">Кожну четверту/кожен четвертий</option>
                                                    </select>
                                                </div>
                                                <div class="me-2">
                                                    <select name="repeat_day_of_week" id="repeat_day_of_week"
                                                            class="form-control"
                                                            x-model="scheduleData.repeat_day_of_week">
                                                        <option value="monday">Понеділок</option>
                                                        <option value="tuesday">Вівторок</option>
                                                        <option value="wednesday">Середа</option>
                                                        <option value="thursday">Четвер</option>
                                                        <option value="friday">П'ятницю</option>
                                                        <option value="saturday">Суботу</option>
                                                        <option value="sunday">Неділю</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-text"></div>
                                        </div>
                                    </div>

                                </template>
                            </div>
                        </template>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancelSchedule()">Скасувати</button>
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>

</template>

