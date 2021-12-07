@props([
    'id'=>'calendar',
    'filter'=>[],
    'viewChange'=>true,
])

<div class="calendar-wrapper">
    <div id="{{$id}}" data-filter='@json($filter)'></div>
    <div class="calendar-header-center">
        <span class="text-sm">10+ місць</span>
        <span class="text-sm">2 — 10 місць</span>
        <span class="text-sm">Немає місць</span>
        @if($viewChange)
        <span class="text">Вигляд</span>
        <select class="view-change">
            <option value="dayGridMonth" selected>Місяць</option>
            <option value="dayGridDay">День</option>
        </select>
        @endif
    </div>
    <div class="calendar-footer-center">
        <span class="text-sm">10+ місць</span>
        <span class="text-sm">2 — 10 місць</span>
        <span class="text-sm">Немає місць</span>
        @if($viewChange)
        <span class="text">Вигляд</span>
        <select class="view-change">
            <option value="dayGridMonth" selected>Місяць</option>
            <option value="dayGridDay">День</option>
        </select>
        @endif
    </div>
</div>
