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

