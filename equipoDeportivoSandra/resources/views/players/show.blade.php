@extends('layout')

@section('title','Pagina jugador')

@section('body')

<div class="jugador">
    <h2>{{$player->name}}</h2>
    <h3>{{$player->position}}</h3>
    <img src="{{asset($player->avatar)}}" alt="imagen">
    <div>Edad: {{$player->age}}</div>
    <div class="redes">
        <div>Instagram: {{$player->instagram}}</div>
        <div>Twitter: {{$player->twitter}}</div>
        <div>Twitch: {{$player->twitch}}</div>
    </div>
</div>

@endsection
