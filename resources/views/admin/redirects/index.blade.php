@extends('admin.layout.app')
@section('content')
    <div class="dashboard d-flex justify-content-between">
        <h1>@lang('Global settings')</h1>

    </div>

    <div class="card" x-data='siteRedirects({
        redirects: {{json_encode(old('redirects', $redirects))}},
    })'>
        <div class="card-body">
            <form class="form mb-3" action="{{route('admin.redirects.update')}}" method="POST">
                @csrf
                @method('PATCH')


                <div class="table-responsive">

                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Data')}}</th>
                            <th>{{__('Published')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                        <template x-for="(redirect, idx) in redirects">
                            <tr>
                                <td x-text="redirect.id || (idx+1)"></td>
                                <td>

                                    <template x-if="redirect.id">
                                        <input type="hidden" x-bind:name="'redirects['+idx+'][id]'" x-bind:value="redirect.id" />
                                    </template>

                                    <div class="row mb-2">
                                        <div class="col-md-3">
                                            <label class="form-label">{{__('Type')}}</label>
                                            <select x-bind:name="'redirects['+idx+'][type]'"
                                                    class="form-control"
                                            >
                                                @foreach($redirectTypes as $option)
                                                    <option value="{{$option['value']}}" x-bind:selected="redirect.type == '{{$option['value']}}'">{{$option['text']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <x-forms.text-group :label="__('From')" x-bind:name="'redirects['+idx+'][from]'" x-bind:value="redirect.from"/>
                                            <x-forms.text-group :label="__('To')" x-bind:name="'redirects['+idx+'][to]'" x-bind:value="redirect.to" />
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <x-forms.switch-group x-bind:name="'redirects['+idx+'][published]'" x-bind:value="!!redirect.published"/>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm me-2" @click.prevent="remove(idx)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>

                </div>

                <button @click.prevent="add" class="btn btn-primary">@lang('Add')</button>

                <button type="submit" class="btn btn-primary">@lang('Save')</button>
            </form>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        function siteRedirects({ redirects }) {

            const defaultRedirect = {
                type: 'full',
                from: '',
                to: '',
                published: false,
            }

            return {
                redirects,

                init() {

                },
                add() {
                    this.redirects.push(defaultRedirect)
                },
                remove(idx) {
                    this.redirects.splice(idx, 1)
                }
            }
        }
    </script>
@endpush
