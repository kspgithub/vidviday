@extends('emails.admin')

@section('content')
    <table style="width: 100%;  margin: 30px 0; padding: 6px 20px; position: relative; border-radius: 5px; background-color: #ffffff; font-size: 14px; line-height: 36px;">
        <thead>
        <tr>
            <th style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-top: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9;">Кількість осіб</th>
            <th style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-top: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9;">П.І.Б.</th>
            <th style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-top: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9;">Телефон</th>
            <th style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-top: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9;">Пошта</th>
            <th style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-top: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9; border-right: 1px solid #E9E9E9;">Спосіб підтвердження</th>
        </tr>
        </thead>
        <tbody>
        <td style="font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9;">
            {{$order->places.' '.plural_form($order->places, ['особа', 'особи', 'осіб'])}}
        </td>
        <td style="text-align: center; font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9;">
            {{$order->last_name}}  {{$order->first_name}}
        </td>
        <td style="text-align: center; font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9;">
            {{$order->phone}}
        </td>
        <td style="text-align: center; font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9;">
            <a href="mailto:{{$order->email}}">{{$order->email}}</a>
        </td>
        <td style="text-align: center; font-family: 'Roboto', sans-serif; color: #626262; border-bottom: 1px solid #E9E9E9; border-left: 1px solid #E9E9E9; border-right: 1px solid #E9E9E9;">
            {{$order->confirmation_title}}
        </td>
        </tbody>
    </table>
@endsection
