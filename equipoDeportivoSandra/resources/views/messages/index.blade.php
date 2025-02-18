@extends('layout')

@section('title','Mensajes')

@section('body')

<div class="bloque-mostrar">
    <h1>Mensajes:</h1>
    <div class="todos">
        @foreach ($messages as $message)
            <div class="uno">
                <div><b>Titulo/Asunto:</b> <a href="{{route('messages.show',$message)}}">{{ $message->subject }}</a></div>
                <div><b>Autor:</b> <span>{{ $message->name }}</span></div>
            </div>
        @endforeach
    </div>
</div>

@endsection
