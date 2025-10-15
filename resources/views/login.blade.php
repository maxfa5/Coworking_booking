<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style> .is-invalid { color: red; }</style>
</head>
<body>
    @if($user)
        <h2>Здраствуйте, {{ $user->name }}</h2>
        <a href="{{ url('logout') }}"> Выйти из системы</a>
    @else
        <h2>Вход в систему</h2>
        <form method="post" action={{ url('auth') }}>
            @csrf
            <label>E-mail</label>
            <input type="text" name="email" value="{{  old('email')}}"/>
            @error('email')
            <div class="is-invalid">{{ $message }}</div>
            @enderror
            <br>
            <label>Пароль</label>
            <input type="password" name="password" value="{{  old('password')}}"/>
            @error('password')
            <div class="is-invalid">{{ $message }}</div>
            @enderror
            <br>
            <input type="submit">
        </form>
        @error('error')
        <div class="is-invalid">{{ $message }}</div>
        @enderror
    @endif

</body>
</html>