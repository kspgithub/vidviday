<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3">Учасники туру</h3>

        <x-forms.text-group name="participantPhone" wire:model="participantPhone" label="Телефон учасника"/>

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
                @if(!empty($participants))
                    @foreach($participants as $index=>$participant)
                        <tr>
                            <td>{{$participant['last_name']}}</td>
                            <td>{{$participant['first_name']}}</td>
                            <td>{{$participant['middle_name']}}</td>
                            <td>{{$participant['birthday']}}</td>
                            <td>
                                <a href="#" class="ms-3 text-danger"
                                   wire:click.prevent="removeParticipant({{$index}})">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="5">Не вказано</td>
                    </tr>
                @endif
                <tr>
                    <td class="border-0 pt-4">
                        <input type="text" class="form-control form-control-sm" wire:model.defer="participantLastName"
                               placeholder="Прізвище">
                    </td>
                    <td class="border-0 pt-4">
                        <input type="text" class="form-control form-control-sm" wire:model.defer="participantFirstName"
                               placeholder="Ім'я">
                    </td>
                    <td class="border-0 pt-4">
                        <input type="text" class="form-control form-control-sm" wire:model.defer="participantMiddleName"
                               placeholder="По батькові">
                    </td>
                    <td class="border-0 pt-4">

                        <x-input.datepicker wire:model.defer="participantBirthday" class="form-control-sm"
                                            placeholder="Дата народження"/>
                    </td>
                    <td class="border-0 pt-4">
                        <button type="submit" wire:click.prevent="addParticipant()" class="btn btn-sm btn-primary">
                            Додати учасника
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


    </x-slot>
</x-bootstrap.card>
