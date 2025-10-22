<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> .is-invalid { color: red; }</style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(auth()->check())
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title mb-4">Здравствуйте, {{ auth()->user()->name }}</h2>
                            <a href="{{ url('logout') }}" class="btn btn-link ">Выйти из системы</a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-4">Вход в систему</h2>
                            <form method="post" action="{{ url('auth') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label">E-mail</label>
                                    <input type="text" name="email" value="{{ old('email') }}" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           placeholder="Введите ваш email"/>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Пароль</label>
                                    <input type="password" name="password" value="{{ old('password') }}" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           placeholder="Введите ваш пароль"/>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-link">Войти</button>
                                </div>
                            </form>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>