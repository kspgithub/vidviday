@props([
    'style'=>'width: 100%;  margin: 30px 0; padding: 6px 20px; position: relative; border-radius: 5px; background-color: #ffffff; font-family: "Roboto", sans-serif; font-size: 16px; line-height: 36px;'
])
<table style="{{$style}}">
    {{$slot}}
</table>
