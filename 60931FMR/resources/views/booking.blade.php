<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-31</title>
</head>
<body>
    <h2>{{$booking ? "Список  бронирований:" : "Неверный ID брони"  }}</h2>
    @if($booking)
    <table border="1">
        <thead>
            <td>id</td>
            <td>start_time</td>
            <td>end_time</td>
            <td>id пользователя</td>
            <td>id коворкинга</td>


        </thead>
        <tr>
            <td>{{$booking->id}}</td>
            <td>{{$booking->start_time}}</td>
            <td>{{$booking->end_time}}</td>
            <td>{{$booking->user->id}}</td>
            <td>{{$booking->Kovorking->id}}</td>
        </tr>
    </table>
    @endif
</body>
</html>