@extends('template')
@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Список строений</h2>
            @if(auth()->check())
                <a href="{{ url('/buildings/create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> Добавить строение
                </a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-primary ">
                    <tr>
                        <th>ID</th>
                        <th>Наименование</th>
                        <th>Этажи</th>
                        <th>Открытие</th>
                        <th>Закрытие</th>
                        <th>Адрес</th>
                        <th>Город</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buildings as $building)
                    <tr>
                        <td>{{ $building->id }}</td>
                        <td>{{ $building->name }}</td>
                        <td>{{ $building->count_floor }}</td>
                        <td>{{ $building->open_at }}</td>
                        <td>{{ $building->close_at }}</td>
                        <td>{{ $building->address }}</td>
                        <td>{{ $building->city ? $building->city->name : 'Город не указан' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ url('building/edit/'.$building->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Ред.
                                </a>
                                <a href="{{ url('building/destroy/'.$building->id) }}" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Вы уверены, что хотите удалить это здание?')">
                                    <i class="fa fa-trash"></i> Удалить
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection