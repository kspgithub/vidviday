<template x-teleport="body">
    <div class="modal fade" tabindex="-1" id="edit-basic-modal">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" @submit.prevent="updateOrder()">
                <div class="modal-header">
                    <h5 class="modal-title">Замовлення #<span x-text="order.id"></span>, загальна інформація</h5>
                    <button type="button" class="btn-close" @click.prevent="resetData()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-forms.text-group x-model="data.first_name" name="first_name" label="Ім'я"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="data.last_name" name="last_name" label="Прізвище"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group type="tel" x-model="data.phone" name="phone" label="Телефон"
                                        required
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group type="email" x-model="data.email" name="email" label="Email"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="data.viber" name="viber" label="Viber"
                                        label-col="col-md-3" input-col="col-md-9"/>
                    <x-forms.text-group x-model="data.company" name="viber" label="Компанія"
                                        label-col="col-md-3" input-col="col-md-9"/>


                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">Тип програми</div>
                        <div class="col-md-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" x-model.number="data.program_type" type="radio"
                                       name="program_type" value="0" id="program_type_0">
                                <label class="form-check-label" for="program_type_0">
                                    Готовий тур
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" x-model.number="data.program_type" type="radio"
                                       name="program_type" value="1" id="program_type_1">
                                <label class="form-check-label" for="program_type_1">
                                    Скласти тур
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3" x-show="data.program_type === 0">
                        <div class="col-md-3 col-form-label">Тур <span class="text-danger">*</span></div>
                        <div class="col-md-9">
                            <select name="tour_id" x-model="data.tour_id" id="tourSelectBox" class="form-control"
                                    :required="data.program_type === 0">
                                @if(isset($tour))
                                    <option value="{{$tour->id}}" selected>
                                        {{$tour->title}} - {{$tour->price}} {{$tour->currency}}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3" x-show="data.program_type === 1">
                        <div class="col-md-3 col-form-label">План туру <span class="text-danger">*</span></div>
                        <div class="col-md-9">
                            <textarea x-model="data.tour_plan" name="tour_plan" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">
                            Дата виїзду <span class="text-danger">*</span>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                        <input name="start_date" x-model="data.start_date" type="text" required
                                               x-ref="startDateRef" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row mb-3">
                                        <div class="col-4 col-form-label">Місце виїзду</div>
                                        <div class="col-8">
                                            <input name="start_place" x-model="data.start_place" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">Дата повернення <span class="text-danger">*</span>
                        </div>
                        <div class="col-md-9">

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                        <input name="end_date" x-model="data.end_date" type="text" required
                                               x-ref="endDateRef" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row mb-3">
                                        <div class="col-4 col-form-label">Місце повернення</div>
                                        <div class="col-8">
                                            <input name="end_place" x-model="data.end_place" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                    <x-forms.text-group type="number" x-model.number="data.places" name="places" label="Кількість осіб"
                                        required label-col="col-md-3" input-col="col-md-9"/>

                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">Особливості групи</div>
                        <div class="col-md-9">
                            <textarea x-model="data.group_comment" name="group_comment" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">Побажання</div>
                        <div class="col-md-9">
                            <textarea x-model="data.program_comment" name="program_comment"
                                      class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 col-form-label">Включити у вартість</div>
                        <div class="col-md-9">
                            <template x-for="inc in includes" :key="'inc-'+inc.value">
                                <div class="form-check form-check-inline me-5 mb-2">
                                    <input class="form-check-input" x-model.number="data.price_include" type="checkbox"
                                           name="price_include[]" :value="inc.value" :id="'inc-'+inc.value">
                                    <label class="form-check-label" :for="'inc-'+inc.value" x-text="inc.text"></label>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            @click.prevent="resetData()">Скасувати
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Зберегти
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>
