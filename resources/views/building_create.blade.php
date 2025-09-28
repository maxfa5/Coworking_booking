<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-31</title>
</head>
<body>
    <h2>Добавление строения:</h2>
    <form method="post" action={{url('building')}}>
    <label> Наименование </label>
    <input type="text" name="name" value="{{old('name')}}">
    @error('name')
    <div class="is-invalid">{{$message}}</div>
    @enderror
    <br>
    <select name="city_id" value="{{"sity_id"}}">
    <!-- <option style="..." -->
    @foreach($cities as $city)
        <option value="{{$city->id}}"
                @if(old('city_id') == $city->id) selected
            @endif>{{$city->name}}    
        </option>
    @endforeach
    </select>
    @error('city_id')
    <div class="is-invalid">{{$message}}</div>
    @enderror
    <br>
    <input type="submit">
    </form>
</body>
</html>