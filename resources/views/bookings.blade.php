@extends('template')
@section('content')
    <h2>Список  бронирований:</h2>
    <table border="1">
        <thead>
            <td>id</td>
            <td>start_time</td>
            <td>end_time</td>
            <td>id пользователя</td>
            <td>Название коворкинга</td>
        </thead>
        @foreach ($bookings as $booking)
        <tr>
            <td>{{$booking->id}}</td>
            <td>{{$booking->start_time}}</td>
            <td>{{$booking->end_time}}</td>
            <td>{{$booking->user->id}}</td>
            <td>{{$booking->kovorking->name}}</td>        </tr>
        @endforeach
    </table>
    {{ $bookings->links() }}

@endsection