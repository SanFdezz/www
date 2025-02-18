@extends('layout')

@section('title','Pagina jugador')

@section('body')

<div class="bloque">
    <h2>{{$player->name}}</h2>
    <h3>{{$player->position}}</h3>
    <img src="{{asset('storage/'. $player->avatar)}}" alt="avatar" class="avatar">
    <div>Edad: {{$player->age}}</div>
    <div class="redes">
        <div>Instagram: {{$player->instagram}}</div>
        <div>Twitter: {{$player->twitter}}</div>
        <div>Twitch: {{$player->twitch}}</div>
    </div>
</div>

@endsection
