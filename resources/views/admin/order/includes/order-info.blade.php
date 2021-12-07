<div>
    <x-bootstrap.card>
        <x-slot name="body">
            <h3>Основна інформація</h3>
            <table class="table table-hover">
                <tr>
                    <th style="width: 300px;">@lang('Created At')</th>
                    <td>
                        {{$order->created_at ? $order->created_at->format('d.m.Y H:i') : '-'}}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Status')</th>
                    <td>
                        @if(!$editOrderStatus)
                            @include('admin.order.includes.status-badge', ['order'=>$order])
                            <a href="#" wire:click.prevent="changeStatus()" class="text-success ms-3">
                                <i class="fa fa-edit"></i> Змінити статус
                            </a>
                        @else
                            <form wire:submit.prevent="saveStatus()" class="row">
                                <div class="col-auto">
                                    <select name="status" id="status" wire:model="orderStatus" class="form-control form-control-sm">
                                        @foreach($orderStatuses as $status => $text)
                                            <option value="{{$status}}">{{$text}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="orderStatusNotice"
                                               value="1"
                                               id="orderStatusNotice">
                                        <label class="form-check-label" for="orderStatusNotice">
                                            Повідомити замовника
                                        </label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary btn-sm me-2">Зберегти</button>
                                    <a href="#" wire:click.prevent="cancelStatus()" class="btn btn-secondary btn-sm">Скасувати</a>
                                </div>
                            </form>
                        @endif
                    </td>
                </tr>
                @if(!empty($order->offer_date))
                    <tr>
                        <th style="width: 300px;">До якої дати надіслати пропозицію</th>
                        <td>
                            {{$order->offer_date->format('d.m.Y')}}
                        </td>
                    </tr>
                @endif
                @if(!empty($order->confirmation_type > 0))
                    <tr>
                        <th style="width: 300px;">Тип підтвердження</th>
                        <td>
                            {{$confirmationTypes[$order->confirmation_type]['uk']}} -

                            <b> {{$order->confirmation_contact}}</b>
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">Статус підтвердження</th>
                        <td>
                            @if(!$editConfirmationStatus)
                                @switch($order->confirmation_status)
                                    @case(0)
                                    <span class="badge bg-warning">Очікує на підтвердження</span>
                                    @break
                                    @case(1)
                                    <span class="badge bg-success">Підтверджено</span>
                                    @break
                                    @case(2)
                                    <span class="badge bg-danger">Скасовано</span>
                                    @break
                                @endswitch
                                <a href="#" wire:click.prevent="changeConfirmationStatus()" class="text-success ms-3">
                                    <i class="fa fa-edit"></i> Змінити статус
                                </a>
                            @else
                                <form wire:submit.prevent="saveConfirmationStatus()" class="row">
                                    <div class="col-auto">
                                        <select name="confirmation_status" id="confirmationStatus" wire:model="confirmationStatus" class="form-control form-control-sm">
                                            <option value="0">Очікує на підтвердження</option>
                                            <option value="1">Підтверджено</option>
                                            <option value="2">Скасовано</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary btn-sm me-2">Зберегти</button>
                                        <a href="#" wire:click.prevent="cancelConfirmationStatus()" class="btn btn-secondary btn-sm">Скасувати</a>
                                    </div>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endif
                <tr>
                    <th style="width: 300px;">@lang('Departure Date')</th>
                    <td>
                        {{$order->start_date ? $order->start_date->format('d.m.Y') : '-'}}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Return Date')</th>
                    <td>
                        {{$order->end_date ? $order->end_date->format('d.m.Y') : '-'}}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Tour')</th>
                    <td>
                        @if($order->tour)
                            <a href="{{$order->tour->url}}" target="_blank">{{$order->tour->title}}</a> &dash;
                            <b> {{$order->schedule_id ? number_format($order->schedule->price) : number_format($order->tour->price)}} {{$order->tour->currency}}</b>
                        @else
                            -
                        @endif


                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Group Type')</th>
                    <td>
                        {{$order->group_type === 1 ? 'Корпоративна група' : 'Збірна група'}}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Number of participants')</th>
                    <td>
                        {{$order->places }}
                        @if((int)$order->children === 1)
                            + {{$order->total_children}} {{plural_form($order->total_children, ['дитина', 'дитини', 'дітей'])}}
                        @endif

                    </td>
                </tr>


                <tr>
                    <th style="width: 300px;">Ціна туру без знижки</th>
                    <td>
                        {{number_format($order->price)}} {{$order->currency}}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">Комісія агента</th>
                    <td>
                        {{number_format($order->commission)}} {{$order->currency}}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">Знижка</th>
                    <td>
                        @if($order->discount > 0)
                            <div>-{{number_format($order->discount)}} {{$order->currency}}</div>
                        @endif
                        @if(!empty($order->discounts))
                            @foreach($order->discounts as $discount)
                                <small>{{$discount['title']}}
                                    - {{number_format($discount['value'])}}  {{$order->currency}}</small>
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">До сплати</th>
                    <td>
                        <b> {{number_format($order->total_price)}} {{$order->currency}}</b>
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Payment Type')</th>
                    <td>
                        {{array_key_exists($order->payment_type, $paymentTypes) ? $paymentTypes[$order->payment_type] : '-' }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Payment Status')</th>
                    <td>
                        @if(!$editPaymentStatus)
                        <span class="badge bg-{{$order->payment_status === 1 ? 'success' : ($order->payment_status === 2 ? 'danger' : 'warning')}}">
                             {{array_key_exists($order->payment_status, $paymentStatuses) ? $paymentStatuses[$order->payment_status] : '-' }}
                        </span>
                        <a href="#" wire:click.prevent="changePaymentStatus()" class="text-success ms-3">
                            <i class="fa fa-edit"></i> Змінити статус
                        </a>
                        @else
                            <form wire:submit.prevent="savePaymentStatus()" class="row">
                                <div class="col-auto">
                                    <select name="payment_status" id="confirmationStatus" wire:model="paymentStatus" class="form-control form-control-sm">
                                        <option value="0">Очікує на оплату</option>
                                        <option value="1">Оплачено</option>
                                        <option value="2">Повернено</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary btn-sm me-2">Зберегти</button>
                                    <a href="#" wire:click.prevent="cancelPaymentStatus()" class="btn btn-secondary btn-sm">Скасувати</a>
                                </div>
                            </form>
                        @endif

                    </td>
                </tr>

            </table>
        </x-slot>
    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot name="body">
            <h3>Додаткова інформація</h3>
            <table class="table table-hover">
                <tr>
                    <th style="width: 300px;">Тип програми</th>
                    <td>
                        {{$order->program_type === 1 ? 'Кастомний тур' : 'Готовий тур'}}
                    </td>
                </tr>
                @if($order->program_type === 1)
                    <tr>
                        <th style="width: 300px;">План туру</th>
                        <td>
                            {{$order->tour_plan}}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">Місце виїзду</th>
                        <td>
                            {{$order->start_place}}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">@lang('Departure Date')</th>
                        <td>
                            {{$order->start_date ? $order->start_date->format('d.m.Y') : '-'}}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">Місце повернення</th>
                        <td>
                            {{$order->end_place}}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">@lang('Return Date')</th>
                        <td>
                            {{$order->end_date ? $order->end_date->format('d.m.Y') : '-'}}
                        </td>
                    </tr>
                @endif
                @if($order->group_type === \App\Models\Order::GROUP_CORPORATE)

                    <tr>
                        <th style="width: 300px;">Група</th>
                        <td>
                            {{$order->group_comment}}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">Побажання до організації туру</th>
                        <td>
                            {{$order->program_comment}}
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">Включити у вартість</th>
                        <td>
                            @if(!empty($order->price_include))
                                @foreach($order->price_include as $price_item)
                                    {{\App\Models\Order::orderInclude($price_item)}}
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endif
                @if($order->group_type === \App\Models\Order::GROUP_TEAM)
                    <tr>
                        <th style="width: 300px;">Учасники туру</th>
                        <td>
                            @if(!empty($order->participants) && !empty($order->participants['items']))
                                @foreach($order->participants['items'] as $participant)
                                    <div>
                                        {{trim($participant['last_name'].' '.$participant['first_name'].' '.$participant['middle_name'])}}
                                        @if(!empty($participant['birthday']))
                                            ({{$participant['birthday']}})
                                        @endif
                                    </div>
                                @endforeach
                            @endif

                            @if(!empty($order->participants) && !empty($order->participants['participant_phone']))
                                <div>Телефон одного з учасників: {{$order->participants['participant_phone']}}</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 300px;">Розміщення</th>
                        <td>
                            @if(!empty($order->accommodation))
                                @foreach($order->accommodation as $room_type=>$room_count)

                                    @php
                                        $room_type = str_replace('_', '-', html_entity_decode($room_type))
                                    @endphp
                                    @if($room_count > 0)
                                        <div>

                                            <b>
                                                @if(array_key_exists($room_type, $roomTypes))
                                                    {{$roomTypes[$room_type]}}
                                                @else
                                                    {{str_replace('-', ' ', $room_type)}}
                                                @endif
                                            </b>
                                            - {{$room_count}}
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endif
                <tr>
                    <th style="width: 300px;">Коментар</th>
                    <td>
                        {{$order->comment}}
                    </td>
                </tr>
            </table>
        </x-slot>
    </x-bootstrap.card>
    <x-bootstrap.card>
        <x-slot name="body">
            <h3>Інформація про замовника</h3>
            <table class="table table-hover">
                <tr>
                    <th style="width: 300px;">Користувач</th>
                    <td>
                        @if($order->user_id)
                            <a href="{{route('admin.user.show', $order->user_id)}}" target="_blank">
                                {{$order->user->last_name}} {{$order->user->first_name}}
                            </a>
                        @else
                            Гість
                        @endif

                    </td>
                </tr>


                <tr>
                    <th style="width: 300px;">Замовник</th>
                    <td>

                        {{$order->last_name}} {{$order->first_name}}
                    </td>
                </tr>

                <tr>
                    <th style="width: 300px;">Телефон</th>
                    <td>
                        <a href="tel:{{clear_phone($order->phone)}}" target="_blank">{{$order->phone}}</a>
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">Email</th>
                    <td>
                        <a href="mailto:{{$order->email}}" target="_blank">{{$order->email}}</a>
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">Viber</th>
                    <td>
                        {{$order->viber}}
                    </td>
                </tr>
                @if($order->company)
                    <tr>
                        <th style="width: 300px;">Компанія</th>
                        <td>
                            {{$order->company}}
                        </td>
                    </tr>
                @endif


            </table>
        </x-slot>
    </x-bootstrap.card>
    <x-bootstrap.card>
        <x-slot name="body">
            <h3>Примітки</h3>
            <table class="table table-hover mb-5">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Текст</th>
                    <th>Дії</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notes as $order_note)
                    <tr>
                        <td style="width: 300px;">{{$order_note->created_at ? $order_note->created_at->format('d.m.Y H:i') : '-'}}</td>
                        <td>
                            {!! $order_note->text !!}
                        </td>
                        <td>
                            <a href="#" class="text-danger" wire:click.prevent="deleteNote({{$order_note->id}})"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                @if($notes->count() === 0)
                    <tr>
                        <td colspan="3" >Немає записів</td>
                    </tr>
                @endif
                </tbody>
            </table>


            <h4>Додати примітку</h4>

            <form wire:submit.prevent="addNote()">
                <label for="note-text" class="form-label mb-2">Текст примітки</label>
                <textarea name="text" id="note-text" class="form-control mb-3" rows="5" wire:model.defer="noteText" required></textarea>
                <button type="submit" class="btn btn-primary">Додати</button>
            </form>

        </x-slot>
    </x-bootstrap.card>
</div>
