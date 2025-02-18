@extends('layout')

@section('title','Añadir jugador')

@section('body')

<div class="bloque">
    <h2>Añadir jugador:</h2>
    <form action="{{route('players.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="name">Nombre:</label><br>
        <input type="text" name="name" id="name" value="{{old('name')}}"><br>

        <label for="twitter">Twitter:</label><br>
        <input type="text" name="twitter" id="twitter" value="{{old('twitter')}}"><br>

        <label for="instagram">Instagram:</label><br>
        <input type="text" name="instagram" id="instagram" value="{{old('instagram')}}"><br>

        <label for="twitch">Twitch:</label><br>
        <input type="text" name="twitch" id="twitch" value="{{old('twitch')}}"><br>

        <label for="age">Edad:</label><br>
        <input type="text" name="age" id="age" value="{{old('age')}}"><br>

        <label for="position">Posición:</label><br>
        <input type="text" name="position" id="position" value="{{old('position')}}"><br>

        <label for="avatar">Foto:</label><br>
        <input type="file" name="avatar" accept="image/*" id="avatar" required class="btn"><br>

        <input type="submit" value="Añadir jugador" class="btn">

    </form>


    <div class="errores">
        @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

@endsection

