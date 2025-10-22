<nav class="navbar navbar-expand-lg navbar-primary bg-primary">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ url('/bookings') }}">
            <i class="fa fa-building"></i> Аренда коворкингов
        </a>
        
        <button class="navbar-toggler" type="button" " data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class=" navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/buildings') }}">
                        Здания
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/kovorkings') }}">
                        Коворкинги
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/users') }}">
                        Пользователи
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                @if(auth()->check())
                    <li class="nav-item">
                        <span class="navbar-text text-white me-3">
                            <i class="fa fa-user-circle"></i> {{ auth()->user()->name }}
                        </span>
                    </li>
                @else
                    <li class="nav-item">
                        <span class="navbar-text text-white">
                            <i class="fa fa-user"></i> Не авторизован
                        </span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>