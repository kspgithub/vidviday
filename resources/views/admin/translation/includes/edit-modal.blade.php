<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-line-modal">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="post" @submit.prevent="saveItem()">
                <div class="modal-header">
                    <h5 class="modal-title">Редагувати переклад</h5>
                    <button type="button" class="btn-close" @click.prevent="cancelEdit()"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-1">
                        <div class="col-2 col-lg-1 text-bold">Ключ:</div>
                        <div class="col-10 col-lg-11">
                            <input type="text" class="form-control" readonly
                                   :value="selectedItem.group === '*' ? selectedItem.key : selectedItem.group + '.'+selectedItem.key">
                        </div>
                    </div>
                    <template x-for="locale in locales">
                        <div class="row mb-1" :key="'lle-'+selectedItem.id+'-'+locale">
                            <div class="col-2 col-lg-1 text-bold" x-text="locale.toUpperCase()"></div>
                            <div class="col-10 col-lg-11">
                                <input type="text" class="form-control" x-model="selectedItem.text[locale]"
                                       x-bind:required="locale === 'uk'">
                            </div>
                        </div>
                    </template>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="cancelEdit()">
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
