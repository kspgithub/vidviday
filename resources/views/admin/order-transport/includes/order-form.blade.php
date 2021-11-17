<div>


    @include('admin.order-transport.includes.customer-form')

    @include('admin.order-transport.includes.order-info-form')




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
