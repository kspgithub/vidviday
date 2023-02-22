@extends('admin.layout.app')

@section('title', __('News'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.crm.client.index'), 'title'=>__('Clients')],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>@lang('Clients')</h1>
    </div>
    <div x-data='crmClients({
        params: @json(request()->all())
        })'
         x-on:delete-client.window="deleteClient($event.detail)"
         x-on:edit-client.window="editClient($event.detail)"
         x-on:create-client.window="createClient()"
    >
        <a x-on:click.prevent="$dispatch('create-client')" href="#" class="btn btn-success mb-3">
            <i class="fa fa-plus"></i> Додати клієнта
        </a>

        <div x-show="!edit && !create">
            <div class="mb-3">
                <input type="search" class="form-control" x-model.debounce.500ms="search" placeholder="Пошук..."/>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <thead>
                        <tr>
                            <th style="width: 100px">
                                <a href="#"
                                   x-on:click.prevent="setSorting(sort === 'bitrix_id:asc' ? 'bitrix_id:desc': 'bitrix_id:asc')">
                                    ID (bitrix)
                                    <i class="fas fa-sort"
                                       x-show="sort !== 'bitrix_id:asc' && sort !== 'bitrix_id:desc'"></i>
                                    <i class="fas fa-sort-up" x-show="sort === 'bitrix_id:asc'"></i>
                                    <i class="fas fa-sort-down" x-show="sort === 'bitrix_id:desc'"></i>
                                </a>

                            </th>
                            <th style="width: 250px">
                                <a href="#"
                                   x-on:click.prevent="setSorting(sort === 'last_name:asc' ? 'last_name:desc': 'last_name:asc')">
                                    Ім'я
                                    <i class="fas fa-sort"
                                       x-show="sort !== 'last_name:asc' && sort !== 'last_name:desc'"></i>
                                    <i class="fas fa-sort-up" x-show="sort === 'last_name:asc'"></i>
                                    <i class="fas fa-sort-down" x-show="sort === 'last_name:desc'"></i>
                                </a>

                            </th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Замовлення</th>
                            <th style="width: 100px">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="client in clients" :key="client.bitrix_id + client.id">

                            <tr x-data="crmClient(client)">

                                <td>
                                    <span x-text="client.bitrix_id"></span>
                                </td>
                                <td>
                                    <span x-text="client.last_name + ' ' + client.first_name"></span>
                                </td>
                                <td>
                                    <span x-html="clientPhones"></span>
                                </td>
                                <td>
                                    <span x-html="clientEmails"></span>
                                </td>
                                <td>
                                    <a :href="`/admin/crm/clients/${client.id}`" target="_blank">
                                        <span class="badge bg-info" x-text="client.orders_count"></span>
                                    </a>
                                </td>
                                <td>
                                    <a x-on:click.prevent="$dispatch('edit-client', client)" href="#"
                                       class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a x-on:click.prevent="$dispatch('delete-client', client)" href="#"
                                       class="btn btn-sm btn-outline-danger me-2">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </template>
                        <template x-if="!loader && clients.length === 0">
                            <tr>
                                <td colspan="5" style="text-align: center">Записів не знайдено</td>
                            </tr>
                        </template>
                        </tbody>
                    </table>

                </div>
            </div>

            <x-alp.pagination></x-alp.pagination>
        </div>
        <template x-if="edit" key="edit">
            @include('admin.crm.client.form')
        </template>
        <template x-if="create" key="create">
            @include('admin.crm.client.form')
        </template>

    </div>

@endsection
