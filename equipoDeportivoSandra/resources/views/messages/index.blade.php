@extends('layout')

@section('title','Mensajes')

@section('body')

<h1>Mensajes:</h1>
<div class="mensajes">
    @foreach ($messages as $message)
        <div class="mensaje">
            <strong>Titulo/Asunto:</strong> <a href="{{route('messages.show',$message)}}">{{ $message->subject }}</a> <br>
            <strong>Autor:</strong> <span>{{ $message->name }}</span> <br>
        </div><br>
    @endforeach
</div>

@endsection
