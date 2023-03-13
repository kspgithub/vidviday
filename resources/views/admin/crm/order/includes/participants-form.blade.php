<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3"><strong>Учасники туру</strong></h3>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Телефон</th>
                        <th>Комментарий</th>
                        <th style="width: 200px">Дії</th>
                    </tr>
                </thead>
                <tbody>

                    <template x-for="(participant_contact, idx) in participant_contacts">
                        <tr>
                            <td>
                                <input type="text" :name="`participant_contacts[${idx}][phone]`"
                                        class="form-control form-control-sm"
                                        x-model="participant_contact.phone">
                            </td>
                            <td>
                                <input type="text" :name="`participant_contacts[${idx}][comment]`"
                                        class="form-control form-control-sm"
                                        x-model="participant_contact.comment">
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-danger"
                                    @click.prevent="removeParticipantContact(idx)">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </template>


                    <tr>
                        <td class="border-0 pt-4">
                            <input type="text" class="form-control form-control-sm" x-model="participant_contactsData.phone"
                                    placeholder="Телефон">
                        </td>
                        <td class="border-0 pt-4">
                            <input type="text" class="form-control form-control-sm" x-model="participant_contactsData.comment"
                                    placeholder="Комментарий">
                        </td>
                        <td class="border-0 pt-4">
                            <button type="submit" @click.prevent="addParticipantContact()" class="btn btn-sm btn-primary">
                                Додати телефон
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-forms.switch-group id="cust-part"
                              x-model="isCustomerParticipant"
                              label="Замовник є учасником туру"
        />
        <input type="hidden" :name="`participants[customer]`" :value="isCustomerParticipant ? 1 : 0">
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>Прізвище</th>
                    <th>Ім'я</th>
                    <th>По батькові</th>
                    <th>Дата народження</th>
                    <th style="width: 200px">Дії</th>
                </tr>
                </thead>
                <tbody>
                <template x-if="isCustomerParticipant">
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm" x-bind:value="order.last_name"
                                   :name="`participants[items][0][last_name]`"
                                   readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" x-bind:value="order.first_name"
                                   :name="`participants[items][0][first_name]`"
                                   readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" x-bind:value="order.middle_name"
                                   :name="`participants[items][0][middle_name]`"
                                   readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" x-bind:value="order.birthday"
                                   :name="`participants[items][0][birthday]`"
                                   x-datepicker
                                   readonly>

                        </td>
                        <td>(замовник)</td>
                    </tr>
                </template>
                <template x-for="(participant, idx) in participants">
                    <template x-if="!(idx == 0 && isCustomerParticipant)">
                        <tr>
                            <td>
                                <input type="text" :name="`participants[items][${idx}][last_name]`"
                                       class="form-control form-control-sm"
                                       x-model="participant.last_name">
                            </td>
                            <td>
                                <input type="text" :name="`participants[items][${idx}][first_name]`"
                                       class="form-control form-control-sm"
                                       x-model="participant.first_name">
                            </td>
                            <td>
                                <input type="text" :name="`participants[items][${idx}][middle_name]`"
                                       class="form-control form-control-sm"
                                       x-model="participant.middle_name">
                            </td>
                            <td>
                                <input type="text" :name="`participants[items][${idx}][birthday]`"
                                       class="form-control form-control-sm"
                                       x-datepicker x-model="participant.birthday">
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-danger"
                                   @click.prevent="removeParticipant(idx)">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </template>
                </template>
                <tr>
                    <td class="border-0 pt-4">
                        <input type="text" class="form-control form-control-sm" x-model="participantData.last_name"
                               placeholder="Прізвище">
                    </td>
                    <td class="border-0 pt-4">
                        <input type="text" class="form-control form-control-sm" x-model="participantData.first_name"
                               placeholder="Ім'я">
                    </td>
                    <td class="border-0 pt-4">
                        <input type="text" class="form-control form-control-sm" x-model="participantData.middle_name"
                               placeholder="По батькові">
                    </td>
                    <td class="border-0 pt-4">
                        <input class="form-control form-control-sm" type="text" x-model="participantData.birthday"
                               x-datepicker autocomplete="off"
                        />

                    </td>
                    <td class="border-0 pt-4">
                        <button type="submit" @click.prevent="addParticipant()" class="btn btn-sm btn-primary">
                            Додати учасника
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


    </x-slot>
</x-bootstrap.card>
