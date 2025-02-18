@extends('layout')

@section('title','Añadir evento')

@section('body')

<div class="bloque">
    <h2>Añadir evento:</h2>
    <form action="{{route('events.store')}}" method="post">
        @csrf

        <label for="name">Evento:</label><br>
        <input type="text" name="name" id="name" value="{{old('name')}}"><br>

        <label for="description">Descripcion:</label><br>
        <input type="text" name="description" id="description" value="{{old('description')}}"><br>

        <label for="location">Localizacion:</label><br>
        <input type="text" name="location" id="location" value="{{old('location')}}"><br>

        <label for="date">Fecha:</label><br>
        <input type="text" name="date" id="date" value="{{old('date')}}"><br>

        <label for="hour">Hora:</label><br>
        <input type="text" name="hour" id="hour" value="{{old('hour')}}"><br>

        <label for="type">Tipo: (official,exhibition,charity)</label><br>
        <input type="text" name="type" id="type" value="{{old('type')}}"><br>

        <label for="tags">Hashtags:</label><br>
        <input type="text" name="tags" id="tags" value="{{old('tags')}}"><br>

        <input type="submit" value="Crear evento" class="btn">

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

