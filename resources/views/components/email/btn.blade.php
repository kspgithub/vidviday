@props([
    'href'=>'',
    'style'=>'',
])

<a href="{{$href}}" style="font-family: 'Roboto', sans-serif;
            font-size: 12px;
            cursor: pointer;
            font-weight: 700;
            line-height: 24px;
            text-align: center;
            position: relative;
            letter-spacing: .1em;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            background: #7EBD3E;
            color: #fff;
            border-radius: 5px;
            padding: 7px 20px 5px;
            {{$style}}
    ">{{$slot}}</a>
