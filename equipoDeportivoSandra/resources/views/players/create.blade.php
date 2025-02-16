@extends('layout')

@section('title','Añadir jugador')

@section('body')

<form action="{{route('players.store')}}" method="post">
    @csrf

    <label for="name">Nombre:</label><br>
    <input type="text" name="name" id="name" value="{{old('name')}}"><br>

    <label for="twitter">Twitter:</label><br>
    <input type="text" name="twitter" id="twitter" value="{{old('twitter')}}"><br>

    <label for="instagram">Instagram:</label><br>
    <input type="text" name="instagram" id="instagram" value="{{old('instagram')}}"><br>

    <label for="twitch">Twitch:</label><br>
    <input type="text" name="twitch" id="twitch" value="{{old('twitch')}}"><br>

    <label for="avatar">Ruta de la foto:</label><br>
    <input type="text" name="avatar" id="avatar" value="{{old('avatar')}}"><br>

    <label for="age">Edad:</label><br>
    <input type="text" name="age" id="age" value="{{old('age')}}"><br>

    <label for="position">Posición:</label><br>
    <input type="text" name="position" id="position" value="{{old('position')}}"><br>

    <input type="submit" value="Añadir jugador">

</form>


@if($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

@endsection

