@extends('layout')

@section('title','Mensaje')

@section('body')

<div class="bloque">
    <div class="mensajeCompleto">
        <h2>Mensaje de: {{$message->name}}</h2>
        <h3>{{$message->subject}}</h3>
        <div>{{$message->text}}</div>
    </div>


    <form action="{{ route('messages.destroy', $message) }}" method="POST">
        @csrf
        @method('delete')
        <input type="submit" class="btn" value="Eliminar mensaje">
    </form>
</div>

@endsection
