@extends('layout')

@section('title','Jugadores')

@section('body')

<div class="bloque-mostrar">
    <h1>Lista de Jugadores</h1>
        @if (auth()->check())
            <div class="todos">
                @foreach ($players as $player)
                    <div class="uno">
                        <img src="{{ asset('storage/' . $player->avatar) }}" alt="{{ $player->avatar }}">
                        <div><strong>Nombre:</strong> <a href="{{route('players.show', $player->id)}}">{{ $player->name }}</a></div>
                        @if (Auth::user()->rol == 'admin')
                            <a href="{{route('players.edit', $player)}}">Editar visibilidad</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="todos">
                @foreach ($players as $player)
                    <div class="uno">
                        <strong>Nombre:</strong> {{ $player->name }} <br>
                        <img src="{{ asset('storage/' . $player->avatar) }}" alt="{{ $player->avatar }}" height="120vw">
                    </div>
                @endforeach
            </div>
        @endif
</div>

@endsection
