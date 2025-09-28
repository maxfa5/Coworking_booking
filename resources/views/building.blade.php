<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-31</title>
</head>
<body>
<h2>{{$building ? "Список строений: ".$building->name : "Неверный ID брони"  }}</h2>

    @if($building)

    <table border="1">
        <thead>
            <td>id</td>
            <td>Наименование</td>
            <td>количество этажей</td>
            <td>Открывается в</td>

            <td>Закрывается в</td>

            <td>адресс</td>

            <td>город</td>

        </thead>
        <tr>
            <td>{{$building->id}}</td>
            <td>{{$building->name}}</td>
            <td>{{$building->count_floor}}</td>
            <td>{{$building->open_at}}</td>
            <td>{{$building->close_at}}</td>
            <td>{{ $building->city ? $building->city->name : 'Город не указан' }}</td>

        </tr>
    </table>
    @endif
</body>
</html>