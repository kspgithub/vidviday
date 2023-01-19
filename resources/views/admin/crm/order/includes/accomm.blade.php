<div class="card" x-data='crmOrderAccom({
    order: @json($order),
    tour: @json($tour),
    roomTypes: @json($roomTypes),
})'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Поселення</h3>
        </div>
        <table class="table  table-bordered">
            <tbody>
                <template x-for="roomType of roomTypes">
                    <tr>
                        <th style="width: 300px" x-text="roomType.text"></th>
                        <td>
                            <template x-if="!isEditable(roomType.value)">
                                <div>
                                    <b x-text="order.accommodation ? order.accommodation[roomType.value] || null : null"></b>
                                    <a href="#" @click.prevent="editAccomm(roomType.value)" class="ms-3 text-success">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </div>
                            </template>
                            <template x-if="isEditable(roomType.value)">
                                <form @submit.prevent="saveAccomm(roomType.value)">
                                    <div class="d-flex align-items-center">
                                        <input type="number" x-model="accommodationsForm[roomType.value]"
                                               class="form-control form-control-sm me-3" required>
                                        <button  id="b40" type="submit" class="btn btn-sm btn-outline-success me-3">
                                            <i class="fa fa-save"></i>
                                        </button>
                                        <button  id="b41" class="btn btn-sm btn-outline-secondary me-3"
                                                @click.prevent="cancelAccomm(roomType.value)">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </div>

                                </form>
                            </template>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
