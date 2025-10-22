@extends('template')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h2 class="mb-4">Редактирование строения: {{ $building->name }}</h2>
            <form method="POST" action="{{ url('building/update/' . $building->id) }}" class="mb-4">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Наименование</label>
                    <input type="text" name="name" value="{{ old('name', $building->name) }}" class="form-control" required>
                    @error('name')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Город</label>
                    <select name="city_id" class="form-select" required>
                        <option value="">-- Выберите город --</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" 
                                {{ old('city_id', $building->city_id) == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Количество этажей</label>
                    <input type="number" name="count_floor" value="{{ old('count_floor', $building->count_floor) }}" class="form-control" min="1" max="1000">
                    @error('count_floor')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Время открытия</label>
                    <input type="time" name="open_at" value="{{ old('open_at', $building->open_at) }}" class="form-control" required>
                    @error('open_at')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Время закрытия</label>
                    <input type="time" name="close_at" value="{{ old('close_at', $building->close_at) }}" class="form-control" required>
                    @error('close_at')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Адрес</label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address', $building->address) }}</textarea>
                    @error('address')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary me-2">Сохранить изменения</button>
                    <a href="{{ url('/buildings') }}" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>

    @if($building->kovorkings && $building->kovorkings->count() > 0)
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h3 class="mb-3">Коворкинги в этом здании:</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Название</th>
                            <th>Тип</th>
                            <th>Вместимость</th>
                            <th>Этаж</th>
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
            </div>
        </div>
    </div>
    @else
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="alert alert-info">
                В этом здании пока нет коворкингов.
            </div>
        </div>
    </div>
    @endif
@endsection