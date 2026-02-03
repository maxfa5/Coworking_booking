@extends('template')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Список коворкингов</h2>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-primary ">
                    <tr>
                        <th>ID</th>
                        <th>Наименование</th>
                        <th>Этаж</th>
                        <th>Открытие</th>
                        <th>Закрытие</th>
                        <th>Вместимость</th>
                        <th>Адрес</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kovorkings as $kovorking)
                    <tr>
                        <td>{{ $kovorking->id }}</td>
                        <td>{{ $kovorking->name }}</td>
                        <td>{{ $kovorking->floor_number }}</td>
                        <td>{{ $kovorking->from_at }}</td>
                        <td>{{ $kovorking->to_at }}</td>
                        <td>{{ $kovorking->capacity }} мест</td>
                        <td>{{ $kovorking->building ? $kovorking->building->address : 'Адрес не указан' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection