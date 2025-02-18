<nav class="navbar navbar-expand-lg navbar-light bg-dark px-3 sticky-top">
    <a class="navbar-brand d-flex align-items-center" href="{{route('index')}}">
        <img src="{{asset('images/escudoVLC.png')}}" height="40" alt="logo del equipo" class="me-2 logo">
        <span class="fw-bold text-light">Valencia CF</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list text-light"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav text-light me-auto">
            <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('index')}}">Inicio</a></li>
            <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('players.index')}}">Jugadores</a></li>
            <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('eventos')}}">Eventos</a></li>
            <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('messages.create')}}">Añadir mensaje</a></li>
            <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('location')}}">Dónde estamos</a></li>
        </ul>

        @auth
            @if (Auth::user()->rol == 'admin')
                <ul class="navbar-nav text-light me-auto">
                    <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('players.create')}}">Añadir jugador</a></li>
                    <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('events.create')}}">Añadir evento</a></li>
                    <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('messages.index')}}">Mensajes</a></li>
                </ul>
            @endif
        @endauth

        <ul class="navbar-nav text-light">
            @if(!Auth::check())
                <li class="nav-item p-2 text-light"><a class="nav-link text-light" href="{{route('signupForm')}}">Registrarse</a></li>
                <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('loginForm')}}">Iniciar sesión</a></li>
            @endif
            @auth
                <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('account')}}">Cuenta</a></li>
                <li class="nav-item p-2"><a class="nav-link text-light" href="{{route('logout')}}">Cerrar sesión</a></li>
            @endauth
        </ul>
    </div>
</nav>
