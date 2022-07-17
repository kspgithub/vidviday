<form action="/" class="filter-result-bar">
    <span class="title h3 only-desktop">Доступно {{$tours->total()}} турів</span>
    <label class="only-desktop">
        <span class="text">Показати тури</span>
        <select name="onPage">
            <option value="12">12</option>
            <option value="24">24</option>
        </select>
    </label>
    <label>
        <span class="text">Сортувати</span>
        <select name="sorting">
            @foreach(App\Services\TourService::filterOptions()['sorting'] as $sorting)
                <option value="{{$sorting['value']}}">{{$sorting['text']}}</option>
            @endforeach
        </select>
    </label>
</form>
