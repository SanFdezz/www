@extends('layout')

@section('title','añadir mensaje')

@section('body')

<form action="{{route('messages.store')}}" method="post">
    @csrf

    <input type="text" name="name" id="name" value="{{Auth::user()->name}}" hidden>

    <label for="subject">Asunto/Título:</label><br>
    <input type="text" name="subject" id="subject" value="{{old('subject')}}"><br>

    <label for="text">Contenido:</label><br>
    <input type="text" name="text" id="text" value="{{old('text')}}"><br>

    <input type="submit" value="Guardar mensaje">
</form>

@if($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

@endsection
