@extends('template')
@section('content')
    <h2>Список строений:</h2>

    @if(auth()->check())
            <a href="{{ url('/buildings/create') }}" class="btn btn-success mb-3">Добавить строение</a>
        @endif
        
    <table border="1">
        <thead>
            <td>id</td>
            <td>Наименование</td>
            <td>количество этажей</td>
            <td>Открывается в</td>

            <td>Закрывается в</td>

            <td>адресс</td>

            <td>город</td>
            <td>действия</td>

        </thead>
        @foreach ($buildings as $building)
        <tr>
            <td>{{$building->id}}</td>
            <td>{{$building->name}}</td>
            <td>{{$building->count_floor}}</td>
            <td>{{$building->open_at}}</td>
            <td>{{$building->close_at}}</td>
            <td>{{$building->address}}</td>
            <td>{{ $building->city ? $building->city->name : 'Город не указан' }}</td>
            <td>
                <a href="{{ url('building/destroy/'.$building->id)}}">Удалить </a>
                <a href="{{ url('building/edit/'.$building->id)}}">Редактировать </a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection