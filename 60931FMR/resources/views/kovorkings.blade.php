<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-31</title>
</head>
<body>
    <h2>Список коворкингов:</h2>
    <table border="1">
        <thead>
            <td>id</td>
            <td>Наименование</td>
            <td>количество этажей</td>
            <td>Открывается в</td>

            <td>Закрывается в</td>

            <td>количество мест</td>

            <td>адресс</td>

        </thead>
        @foreach ($kovorkings as $kovorking)
        <tr>
            <td>{{$kovorking->id}}</td>
            <td>{{$kovorking->name}}</td>
            <td>{{$kovorking->floor_number}}</td>
            <td>{{$kovorking->from_at}}</td>
            <td>{{$kovorking->to_at}}</td>
            <td>{{$kovorking->capacity}}</td>
            <td>{{ $kovorking->building ? $kovorking->building->address : 'Адресс не указан' }}</td>

        </tr>
        @endforeach
    </table>
</body>
</html>