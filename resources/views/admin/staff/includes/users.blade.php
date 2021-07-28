@foreach ($users as $user)

  <option value="{{$user->id ?? ''}}"

    @isset($staff->id)
      @foreach ($staff->users as $userStaff)
        @if ($user->id == $userStaff->user_id)
          selected=""
        @endif
      @endforeach
    @endisset

    >
    {!! $delimiter or '' !!}{{$user->first_name ?? ''}}
  </option>

@endforeach
