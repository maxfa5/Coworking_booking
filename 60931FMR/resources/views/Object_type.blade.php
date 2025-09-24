<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>609-31</title>
</head>
<body>
    <h2>Список Типов объектов бронирования:</h2>
    <table border="1">
        <thead>
            <td>id</td>
            <td>Наименование</td>
        </thead>
        @foreach ($objects_types as $object_types)
        <tr>
            <td>{{$object_type->id}}</td>
            <td>{{$object_type->name}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>