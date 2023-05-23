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

                    <template x-if="isCustomerParticipant && !order.is_tour_agent">
                        <tr>
                            <td>
                                <input type="text" :name="`participant_contacts[0][phone]`"
                                        class="form-control form-control-sm"
                                        x-model="order.phone"
                                        >
                            </td>
                            <td>
                                <input type="text" :name="`participant_contacts[0][comment]`"
                                        class="form-control form-control-sm"
                                        value="Замовник"
                                        >
                            </td>
                        </tr>
                    </template>

                    <template x-for="(participant_contact, idx) in participant_contacts">
                        <template x-if="!(idx == 0 && isCustomerParticipant)">
                            <tr>
                                <td>
                                    <input type="text" :name="`participant_contacts[${idx}][phone]`"
                                            class="form-control form-control-sm"
                                            x-model="participant_contact.phone"
                                            placeholder="+38 (___) ___-__-__"
                                            x-mask="+38 (999) 999-99-99"
                                            type="tel">
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
                    </template>


                    <tr>
                        <td class="border-0 pt-4">
                            <button type="submit" @click.prevent="addParticipantContact()" class="btn btn-sm btn-primary">
                                Додати телефон
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div x-show="!order.is_tour_agent">
            <x-forms.switch-group id="cust-part"
                                x-model="isCustomerParticipant"
                                label="Замовник є учасником туру"
                                
            />
        </div>
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
                <template x-if="isCustomerParticipant && !order.is_tour_agent">
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm" x-model="order.last_name"
                                   :name="`participants[items][0][last_name]`" 
                                   >
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" x-model="order.first_name"
                                   :name="`participants[items][0][first_name]`"
                                   >
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" x-model="order.middle_name"
                                   :name="`participants[items][0][middle_name]`"
                                   >
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm" x-model="order.birthday"
                                   :name="`participants[items][0][birthday]`"
                                   x-datepicker
                                   >

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
                        <button type="submit" @click.prevent="addParticipant()" class="btn btn-sm btn-primary">
                            Додати учасника
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <textarea class="form-control" x-model="multiplyParticipants"></textarea>
                    </tr>
                    <tr>
                        <td class="border-0 pt-4">
                            <button type="submit" @click.prevent="addMultiplyParticipant()" class="btn btn-sm btn-primary">
                                Додати учасников
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </x-slot>
</x-bootstrap.card>
