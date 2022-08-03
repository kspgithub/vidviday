<div>
    <div>
        <div class="card">
            <div class="card-body">

                <table class="table table-responsive table-striped table-sm" x-data='sortable({
                    url: "{{route('admin.popular-tours.sort')}}"
                })'>
                    <thead>
                    <tr>
                        <th></th>
                        <th>@lang('Tour')</th>
                        <th>@lang('Published')</th>
                        <th style="width: 100px">@lang('Actions') </th>
                    </tr>
                    </thead>
                    <tbody x-ref="sortableRef">
                    @foreach($items as $item)
                        <tr class="draggable" data-id="{{$item->id}}">
                            <td class="handler ps-2"><i class="fa fa-bars cursor-move me-3"></i></td>
                            <td>
                                {{$item->tour->title}}
                            </td>
                            <td>@include('admin.partials.published', ['model'=>$item, 'updateUrl'=>route('admin.popular-tours.update', $item)])</td>
                            <td class="table-action">
                                <x-utils.delete-button
                                    :href="route('admin.popular-tours.destroy', $item)"
                                    text=""/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
