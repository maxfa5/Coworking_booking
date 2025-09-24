<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-31</title>
</head>
<body>
<h2>{{$object_type ? "Список Типов объектов бронирования: ".$object_type->name : "Неверный ID брони"  }}</h2>
@if($object_type)

    <table border="1">
        <thead>
            <td>id</td>
            <td>Наименование</td>
            <td>min_slot</td>

            <td>max_slot</td>

            <td>slot_step</td>

        </thead>
        <tr>
            <td>{{$object_type->id}}</td>
            <td>{{$object_type->name}}</td>
            <td>{{$object_type->min_slot}}</td>

            <td>{{$object_type->max_slot}}</td>

            <td>{{$object_type->slot_step}}</td>
        </tr>
    </table>
    @endif

</body>
</html>