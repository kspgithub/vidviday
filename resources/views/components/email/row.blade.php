@props([
    'title'=>'',
    'text'=>'',
    'titleStyle'=>"color: #626262; border-bottom: 1px solid #E9E9E9;",
    'textStyle'=>"font-weight: 700; border-bottom: 1px solid #E9E9E9;",
])
<tr>
    <td style="{{$titleStyle}}">
        {{$title}}
    </td>
    <td style="{{$textStyle}}">
        {{$slot ?? $text}}
    </td>
</tr>
