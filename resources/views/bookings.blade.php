@extends('template')
@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Список бронирований</h2>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-primary ">
                    <tr>
                        <th>ID</th>
                        <th>Начало</th>
                        <th>Окончание</th>
                        <th>ID пользователя</th>
                        <th>Коворкинг</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <td>{{ $booking->user->id }}</td>
                        <td>{{ $booking->kovorking->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection