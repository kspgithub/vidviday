<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3"><strong>Учасники туру</strong></h3>

        <x-forms.text-group name="participantPhone" x-model="participantPhone" label="Телефон учасника"/>

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
                <template x-for="(participant, idx) in participants">
                    <tr>
                        <td>
                            <span x-text="participant.last_name"></span>
                            <input type="hidden" :name="`participants[items][${idx}][last_name]`"
                                   x-bind:value="participant.last_name">
                        </td>
                        <td>
                            <span x-text="participant.first_name"></span>
                            <input type="hidden" :name="`participants[items][${idx}][first_name]`"
                                   x-bind:value="participant.first_name">
                        </td>
                        <td>
                            <span x-text="participant.middle_name"></span>
                            <input type="hidden" :name="`participants[items][${idx}][middle_name]`"
                                   x-bind:value="participant.middle_name">
                        </td>
                        <td>
                            <span x-text="participant.birthday"></span>
                            <input type="hidden" :name="`participants[items][${idx}][birthday]`"
                                   x-bind:value="participant.birthday">
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
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                            <input class="form-control form-control-sm"
                                   x-ref="pickerInput"
                                   x-model="participantData.birthday"
                                   autocomplete="off"
                            />
                        </div>

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
