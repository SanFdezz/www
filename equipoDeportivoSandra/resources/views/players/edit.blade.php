@extends('layout')

@section('title','Editar jugador')

@section('body')
<h2>Editar visibilidad del jugador {{$player->name}}</h2>
<form action="{{route('players.update',$player)}}" method="post">
    @csrf
    @method('put')

<label for="visible">Visibilidad:</label><br>
<input type="text" name="visible" id="visible" value="{{$player->visible}}">
<input type="submit" value="Enviar">
</form>
@endsection
