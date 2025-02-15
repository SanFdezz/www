@extends('layout')

@section('title','Main')

@section('body')

<h1>Lista de Jugadores</h1>
<ul>
    @foreach ($players as $player)
        <li>
            <strong>Nombre:</strong> {{ $player->name }} <br>
            <img src="{{$player->avatar}}" alt="foto">
        </li>
    @endforeach
</ul>

@endsection
