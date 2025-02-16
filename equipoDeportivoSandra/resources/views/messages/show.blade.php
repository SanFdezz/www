@extends('layout')

@section('title','Mensaje')

@section('body')

<div class="mensajeCompleto">
    <h2>{{$message->subject}}</h2>
    <h3>{{$message->name}}</h3>
    <div>{{$message->text}}</div>
</div>


<form action="{{ route('messages.destroy', $message) }}" method="POST">
    @csrf
    @method('delete')
    <button type="submit">Eliminar mensaje</button>
</form>

@endsection
