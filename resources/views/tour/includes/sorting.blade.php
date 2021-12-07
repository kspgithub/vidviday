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
        <span class="text">Сортувати за</span>
        <select name="sorting">
            <option value="price-asc">Від найдешевшого</option>
            <option value="price-desc">Від найдорожчого</option>
            <option value="created-desc">Від новішого</option>
            <option value="created-asc">Від старішого</option>
        </select>
    </label>
</form>
