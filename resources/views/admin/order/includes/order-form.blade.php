<div>


    @include('admin.order.includes.customer-form')

    @include('admin.order.includes.order-info-form')

    @include('admin.order.includes.discounts-form')

    @if((int)$order->group_type === 0)

        @include('admin.order.includes.participants-form')

        @include('admin.order.includes.accommodation-form')

    @else

    @endif

    @include('admin.order.includes.order-additional-form')

    @if($errors->any())
        <ul class="text-danger mb-3">
            @foreach ($errors->all() as $message)
                <li>{{$message}}</li>
            @endforeach
        </ul>

    @endif
    @if (session()->has('success'))
        <div class="toast-container">
            <x-utils.toast type="success">
                {{ session('success') }}
            </x-utils.toast>
        </div>
    @endif
    <button type="submit" wire:click.prevent="save()" class="btn btn-primary">Зберегти</button>
</div>
