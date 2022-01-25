<template x-teleport="body">

    <div class="modal fade" tabindex="-1" id="editParticipantsModal">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="post" @submit.prevent="saveParticipants()">
                <div class="modal-header">
                    <h5 class="modal-title">Учасники замовлення #<span x-text="selectedOrder.id"></span></h5>
                    <button type="button" class="btn-close" @click.prevent="cancelParticipants()"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <x-forms.text-group label-col="col-md-3" input-col="col-md-9" x-model="selectedOrder.places"
                                        label="Кількість дорослих"/>
                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">З дітьми</div>
                        <div class="col-md-9">
                            <x-input.switch id="children" x-model="selectedOrder.children"/>
                        </div>
                    </div>
                    <template x-if="selectedOrder.children">
                        <div class="row mb-3">
                            <div class="col-md-3 col-form-label">Діти до 6 років</div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" x-model.number="selectedOrder.children_young">
                            </div>
                        </div>
                    </template>
                    <template x-if="selectedOrder.children">
                        <div class="row mb-3">
                            <div class="col-md-3 col-form-label">Діти від 6 до 12 років</div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" x-model.number="selectedOrder.children_older">
                            </div>
                        </div>
                    </template>

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Прізвище</th>
                                <th>Ім'я</th>
                                <th>По батькові</th>
                                <th>Дата народження</th>
                                <th style="width: 80px">Дії</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template x-for="(participant, idx) in participants.items">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control form-control-sm"
                                               x-model="participant.last_name">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm"
                                               x-model="participant.first_name">

                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm"
                                               x-model="participant.middle_name">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control form-control-sm"
                                               x-model="participant.birthday">
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-danger"
                                           @click.prevent="removeParticipant(idx)">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                            <tr>
                                <td class="border-0 pt-4">
                                    <input type="text" class="form-control form-control-sm"
                                           x-model="participantData.last_name"
                                           placeholder="Прізвище">
                                </td>
                                <td class="border-0 pt-4">
                                    <input type="text" class="form-control form-control-sm"
                                           x-model="participantData.first_name"
                                           placeholder="Ім'я">
                                </td>
                                <td class="border-0 pt-4">
                                    <input type="text" class="form-control form-control-sm"
                                           x-model="participantData.middle_name"
                                           placeholder="По батькові">
                                </td>
                                <td class="border-0 pt-4">
                                    <input type="date" class="form-control form-control-sm"
                                           x-model="participantData.birthday"/>

                                </td>
                                <td class="border-0 pt-4">
                                    <button type="submit" @click.prevent="addParticipant()"
                                            class="btn btn-sm btn-primary">
                                        Додати
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancelParticipants()">
                        Скасувати
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Зберегти
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>
