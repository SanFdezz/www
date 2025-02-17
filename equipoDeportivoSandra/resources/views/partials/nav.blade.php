
<nav>
    <img src="{{asset('images/escudoVLC.png')}}" height="20em" alt="logo del equipo">
    <span>Valencia CF</span>
    <div class="enlaces-generales">
        <a href="{{route('index')}}">Inicio</a>
        <a href="{{route('players.index')}}">Jugadores</a>
        <a href="{{route('eventos')}}">Eventos</a>
        <a href="{{route('messages.create')}}">Añadir mensaje</a>
        <a href="{{route('location')}}">Dónde estamos</a>
    </div>
    @auth
        @if (Auth::user()->rol == 'admin')
        <div class="enlaces-admin">
            <a href="{{route('players.create')}}">Añadir jugador</a>
            <a href="{{route('events.create')}}">Añadir evento</a>
            <a href="{{route('messages.index')}}">Mensajes</a>
        </div>
    @endif
    @endauth
    <div class="enlaces-registro">
        @if(!Auth::check())
            <a href="{{route('signupForm')}}">Registrarse</a>
            <a href="{{route('loginForm')}}">Iniciar sesión</a>
        @endif

        @auth
            <a href="{{route('account')}}">Cuenta</a>
            <a href="{{route('logout')}}">Cerrar sesión</a>
        @endauth
    </div>
</nav>
