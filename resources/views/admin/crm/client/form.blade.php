<form class="card">
    <div class="card-body">
        <x-forms.text-group x-model="selectedClient.first_name" name="first_name" label="Ім'я"/>
        <x-forms.text-group x-model="selectedClient.last_name" name="last_name" label="Прізвище"/>
        <div class="form-group row mb-3">
            <div class="col-md-2 col-form-label">
                Email
            </div>
            <div class="col-md-10">
                <template x-for="(email, idx) in selectedClient.email" :key="idx">
                    <div class="d-flex align-items-center mb-2">
                        <input type="email" x-model="selectedClient.email[idx]" class="form-control me-3">
                        <a href="#" class="text-danger" @click.prevent="removeEmail(idx)">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </template>
                <a href="#" class="btn btn-sm btn-outline-primary" @click.prevent="addEmail()">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-md-2 col-form-label">
                Телефон
            </div>
            <div class="col-md-10">
                <template x-for="(phone, idx) in selectedClient.phone" :key="idx">
                    <div class="d-flex align-items-center mb-2">
                        <input class="form-control me-3"
                               x-mask="+38 (099) 999-99-99"
                               placeholder="+38 (___) ___-__-__"
                               x-model="selectedClient.phone[idx]"/>
                        <a href="#" class="text-danger" @click.prevent="removePhone(idx)">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </template>
                <a href="#" class="btn btn-sm btn-outline-primary" @click.prevent="addPhone()">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div x-show="edit" class="card-footer">
        <button type="submit" class="btn btn-primary me-2" @click.prevent="saveClient()">Зберегти</button>
        <button @click.prevent="cancelEdit()" class="btn btn-secondary">Відмінити</button>
    </div>
    <div x-show="create" class="card-footer">
        <button type="submit" class="btn btn-primary me-2" @click.prevent="storeClient()">Зберегти</button>
        <button @click.prevent="cancelCreate()" class="btn btn-secondary">Відмінити</button>
    </div>
</form>
