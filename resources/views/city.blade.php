<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-31</title>
</head>
<body>
<h2>{{$city ? "Список городов: ".$city->name : "Неверный ID брони"  }}</h2>
@if($city)

    <table border="1">
        <thead>
            <td>id</td>
            <td>Наименование</td>
        </thead>
        <tr>
            <td>{{$city->id}}</td>
            <td>{{$city->name}}</td>
        </tr>
    </table>
    @endif

</body>
</html>