@extends('template')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h2 class="mb-4">Добавление строения:</h2> 
            <form method="post" action="{{ url('/buildings') }}" class="mb-4"> 
                @csrf
                
                <div class="mb-3"> 
                    <label class="form-label">Наименование</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
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
                                {{ old('city_id') == $city->id ? 'selected' : '' }}>
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
                    <input type="number" name="count_floor" value="{{ old('count_floor') }}" class="form-control" min="1" max="1000">
                    @error('count_floor')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3"> 
                    <label class="form-label">Время открытия</label>
                    <input type="time" name="open_at" value="{{ old('open_at') }}" class="form-control" required>
                    @error('open_at')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3"> 
                    <label class="form-label">Время закрытия</label>
                    <input type="time" name="close_at" value="{{ old('close_at') }}" class="form-control" required>
                    @error('close_at')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Адрес</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" required>
                    @error('address')
                    <div class="is-invalid">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3"> 
                    <button type="submit" class="btn btn-primary me-2">Создать</button>
                    <a href="{{ url('/buildings') }}" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection