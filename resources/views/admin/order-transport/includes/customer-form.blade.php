<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3">Інформація про замовника</h3>
        <x-forms.select-group label="Користувач" name="order.user_id" wire:model="order.user_id">
            <option value="">Гість</option>
            @if($order->user)
                <option value="{{$order->user_id}}">
                    {{$order->user->name}}
                </option>
            @endif
        </x-forms.select-group>
        <x-forms.text-group label="Прізвище" name="order.last_name" wire:model="order.last_name" required/>
        <x-forms.text-group label="Ім'я" name="order.first_name" wire:model="order.first_name" required/>
        <x-forms.text-group :label="__('forms.phone')" name="order.phone" wire:model="order.phone" required/>
        <x-forms.text-group label="Email" name="order.email" wire:model="order.email" required/>
        <x-forms.text-group :label="__('forms.viber')" name="order.viber" wire:model="order.viber"/>

    </x-slot>
</x-bootstrap.card>
