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
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancelStatus()">Скасувати</button>
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </div>
            </form>
        </div>
    </div>

</template>
