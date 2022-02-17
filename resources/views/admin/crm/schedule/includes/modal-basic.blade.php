<template x-teleport="body">

    <div class="modal fade" tabindex="-1" id="editScheduleModal">
        <div class="modal-dialog">
            <form method="post" @submit.prevent="saveSchedule()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Редагування виїзду #<span x-text="schedule.id"></span></h5>
                    <button type="button" class="btn-close" @click.prevent="cancelSchedule()"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <x-forms.text-group label="Дата виїзду" x-bind:value="scheduleData.start_date" name="start_date"
                                            required x-ref="startDateRef"
                                            label-col="col-md-4" input-col="col-md-8"/>
                        <x-forms.text-group label="Дата повернення" x-bind:value="scheduleData.end_date" name="end_date"
                                            required x-ref="endDateRef"
                                            label-col="col-md-4" input-col="col-md-8"/>
                        <x-forms.text-group label="Вартість" x-model="scheduleData.price" name="price"
                                            required
                                            label-col="col-md-4" input-col="col-md-8"/>

                        <x-forms.text-group label="Комісія" x-model="scheduleData.commission" name="commission"
                                            required
                                            label-col="col-md-4" input-col="col-md-8"/>

                        <x-forms.text-group label="Місць" x-model="scheduleData.places" name="places"
                                            required
                                            label-col="col-md-4" input-col="col-md-8"/>
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
