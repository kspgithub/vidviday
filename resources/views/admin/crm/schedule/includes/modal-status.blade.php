<template x-teleport="body">

    <div class="modal fade" tabindex="-1" id="editStatusModal">
        <div class="modal-dialog">
            <form method="post" @submit.prevent="saveStatus()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Статус замовлення #<span x-text="selectedOrder.id"></span></h5>
                    <button type="button" class="btn-close" @click.prevent="cancelStatus()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">Статус</div>
                        <div class="col-md-9">
                            <select name="status" id="status" class="form-control" x-model="selectedOrder.status">
                                <template x-for="status in statuses">
                                    <option x-bind:value="status.value"
                                            x-bind:selected="selectedOrder.status === status.value"
                                            x-text="status.text"></option>
                                </template>

                            </select>
                            <template x-if="disabledBookedStatus && selectedOrder.status === 'booked'">
                                <div class="form-text text-danger">
                                    Кількість місць замовлення (<b x-text="selectedOrder.total_places"></b>)
                                    більша ніж кількість вільних місць (<b x-text="schedule.places_available"></b>)
                                </div>
                            </template>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancelStatus()">Скасувати</button>
                    <button type="submit" :disabled="disabledBookedStatus && selectedOrder.status === 'booked'"
                            class="btn btn-primary">Зберегти
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>
