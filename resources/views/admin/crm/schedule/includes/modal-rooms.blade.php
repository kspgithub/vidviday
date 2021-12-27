<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="roomModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Проживання #<span x-text="selectedOrder.id"></span></h5>
                    <button type="button" class="btn-close" @click.prevent="cancelEdit()"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <template x-for="room in roomTypes">
                        <div class="row mb-3">
                            <div class="form-label col-md-3" x-text="room.text"></div>
                            <div class="col-md-9">
                                <input type="number" class="form-control"
                                       x-model="accommodation[room.value]">
                            </div>

                        </div>
                    </template>
                    <div class="row mb-3">
                        <div class="form-label col-md-3">
                            Інше
                            <x-input.switch x-model="accommodation.other" id="rooms-other"/>
                        </div>
                        <div class="col-md-9">
                            <textarea x-model="accommodation['other_text']"
                                      x-bind:disabled="!accommodation.other"
                                      class="form-control form-control-sm"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            @click.prevent="cancelEdit()">Скасувати
                    </button>
                    <button type="button" class="btn btn-primary"
                            data-bs-dismiss="modal"
                            @click.prevent="saveOrder()">
                        Зберегти
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
