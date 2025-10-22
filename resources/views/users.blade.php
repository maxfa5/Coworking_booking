@extends('template')
@section('content')
    <h2>Список пользователей:</h2>
    <table border="1">
    <thead>
            <td>id</td>
            <td>first_name</td>
            <td>last_name</td>
            <td>is_super</td>

        </thead>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->is_super}}</td>
        </tr>
        @endforeach
    </table>
@endsection