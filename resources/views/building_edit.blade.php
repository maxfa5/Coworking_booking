<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование здания</title>
</head>
<body>
    <h2>Редактирование здания: {{ $building->name }}</h2>

    <form method="POST" action="{{ url('building/update/' . $building->id) }}" >
        @csrf

        <table border="1">
            <tr>
                <td><label for="name">Название здания</label></td>
                <td>
                    <input type="text" id="name" name="name" value="{{ $building->name }}" required>
                </td>
            </tr>
            <tr>
                <td><label for="city_id">Город</label></td>
                <td>
                    <select id="city_id" name="city_id" required>
                        <option value="">Выберите город</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" 
                                {{ $building->city_id == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="count_floor">Количество этажей</label></td>
                <td>
                    <input type="number" id="count_floor" name="count_floor" 
                           value="{{ $building->count_floor }}" min="1" max="100">
                </td>
            </tr>
            <tr>
                <td><label for="open_at">Открывается в</label></td>
                <td>
                    <input type="time" id="open_at" name="open_at" 
                           value="{{ $building->open_at }}" required>
                </td>
            </tr>
            <tr>
                <td><label for="close_at">Закрывается в</label></td>
                <td>
                    <input type="time" id="close_at" name="close_at" 
                           value="{{ $building->close_at }}" required>
                </td>
            </tr>
            <tr>
                <td><label for="address">Адрес</label></td>
                <td>
                    <textarea id="address" name="address" rows="3" required>{{ $building->address }}</textarea>
                </td>
            </tr>

            <input type="submit">

        </table>
    </form>

    @if($building->kovorkings && $building->kovorkings->count() > 0)
    <h3>Коворкинги в этом здании:</h3>
    <table border="1">
        <thead>
            <tr>
                <td>Название</td>
                <td>Тип</td>
                <td>Вместимость</td>
                <td>Этаж</td>
            </tr>
        </thead>
        <tbody>
            @foreach($building->kovorkings as $kovorking)
            <tr>
                <td>{{ $kovorking->name }}</td>
                <td>{{ $kovorking->type ? $kovorking->type->name : 'Не указан' }}</td>
                <td>{{ $kovorking->capacity }} чел.</td>
                <td>{{ $kovorking->floor_number ?? 'Не указан' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>В этом здании пока нет коворкингов.</p>
    @endif

</body>
</html>