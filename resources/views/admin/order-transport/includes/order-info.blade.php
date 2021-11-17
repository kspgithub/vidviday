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
                                    <select name="status" id="status" wire:model="orderStatus"
                                            class="form-control form-control-sm">
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
                    <th style="width: 300px;">@lang('Тривалість')</th>
                    <td>
                        {{$order->duration }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Кількість пасажирів')</th>
                    <td>
                        {{$order->places }}
                    </td>
                </tr>

                <tr>
                    <th style="width: 300px;">@lang('Route')</th>
                    <td>
                        {{$order->route }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Age Group')</th>
                    <td>
                        {{ implode(', ', $order->age_group ?? []) }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px;">@lang('Comment')</th>
                    <td>
                        {{ $order->comment }}
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

            </table>
        </x-slot>
    </x-bootstrap.card>
</div>
