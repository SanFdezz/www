@extends('layout')

@section('title','Login')

@section('body')

<div class="bloque">
    <h2>Login:</h2>
    <form action="{{route('loginForm')}}" method="post">
        @csrf

        <label for="email">Email:</label><br>
        <input type="text" name="email" id="email" value="{{old('email')}}"><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" id="password"><br>

        <input type="submit" value="Enviar" class="btn">

    </form>
</div>

@endsection
