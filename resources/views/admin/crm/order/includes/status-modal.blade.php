<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-status-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="order.id"></span>, зміна статуса</h5>
                    <button type="button" class="btn-close" @click.prevent="resetData()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-3 col-form-label">Статус</div>
                        <div class="col-md-9">
                            <select x-model="status" class="form-control">
                                <template x-for="st in statuses" :key="'st-'+st.value">
                                    <option x-bind:value="st.value" x-text="st.text"
                                            x-bind:selected="st.value === status"></option>
                                </template>
                            </select>
                        </div>

                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-3 col-form-label">Повідомити користувача</div>
                        <div class="col-md-9">
                            <x-input.switch id="notify-email" x-model="notifySend"/>
                        </div>
                    </div>
                    <template x-if="notifySend">
                        <div class="row mb-3">
                            <div class="col-md-3 col-form-label">Email</div>
                            <div class="col-md-9">
                                <input type="email" x-model="notifyEmail" class="form-control">
                            </div>
                        </div>
                    </template>
                    <template x-if="notifySend">
                        <div class="row mb-3">
                            <div class="col-md-3 col-form-label">Текст повідомлення</div>
                            <div class="col-md-9">
                            <textarea x-model="notifyMessage"
                                      id="notify-message"
                                      class="form-control"
                                      rows="10"
                            ></textarea>
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
                            @click.prevent="updateOrderStatus()">
                        Зберегти
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>
