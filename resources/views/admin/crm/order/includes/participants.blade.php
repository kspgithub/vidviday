<div class="card" x-data='crmOrderParticipants(@json($order))'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Список групи</h3>
        </div>

        <table class="table table-sm table-bordered mb-3">
            <thead>
            <tr class="border-top">
                <th>ПІБ</th>
                <th>Дата народження</th>
                <th>Дії</th>
            </tr>
            </thead>
            <tbody>
            <template x-for="(participant, idx) in participants" x-key="'participant-'+idx">
                <tr>
                    <td>
                        <span x-text="participantFio(participant)"></span>
                    </td>
                    <td>
                        <span x-text="participant.birthday || '-'"></span>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary me-2 mb-2"
                           @click.prevent="editParticipant(idx)"
                        ><i class="fa fa-pen"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-danger me-2 mb-2"
                           @click.prevent="deleteParticipant(idx)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </template>

            </tbody>
        </table>
        <a href="#" class="btn btn-sm btn-outline-primary me-3 mb-3" @click.prevent="editParticipant()">
            <i class="fa fa-plus"></i> Додати учасника
        </a>
        @include('admin.crm.order.includes.participant-modal')
    </div>
</div>
