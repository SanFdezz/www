@extends('layout')

@section('title','Registro')

@section('body')

<form action="{{route('signup')}}" method="post">
    @csrf

    <label for="name">Nombre de usuario:</label><br>
    <input type="text" name="name" id="name" value="{{old('name')}}"><br>

    <label for="email">Email:</label><br>
    <input type="text" name="email" id="email" value="{{old('email')}}"><br>

    <label for="password">Contraseña:</label><br>
    <input type="password" name="password" id="password"><br>

    <label for="password_confirmation">Confirma contraseña:</label><br>
    <input type="password" name="password_confirmation" id="password_confirmation"><br>

    <label for="birthday">Cumpleaños (YYYY-MM-DD):</label><br>
    <input type="birthday" name="birthday" id="birthday" value="{{old('birthday')}}"><br>

    <input type="submit" value="Enviar">
</form>

@if($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

@endsection
