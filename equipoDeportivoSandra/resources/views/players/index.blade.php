@extends('layout')

@section('title','Jugadores')

@section('body')

<h1>Lista de Jugadores</h1>
<ul>
    @if (auth()->check())
        @foreach ($players as $player)
            <li>
                <strong>Nombre:</strong> <a href="{{route('players.show', $player->id)}}">{{ $player->name }}</a> <br>
                <img src="{{$player->avatar}}" alt="foto" height="120vw">
            </li>
            @if (Auth::user()->rol == 'admin')
                <a href="{{route('players.edit', $player)}}">Editar visibilidad</a>
            @endif
        @endforeach
    @else
        @foreach ($players as $player)
            <li>
                <strong>Nombre:</strong> {{ $player->name }} <br>
                <img src="{{$player->avatar}}" alt="foto" height="120vw">
            </li>
        @endforeach
    @endif
</ul>

@endsection
