@extends('layout')

@section('title','Modificar evento')

@section('body')


<div id="contenedorEdicion" class="bloque">
    <h2>Modificar evento:</h2>
    <form id="formEditarEvento">
        @csrf
        @method('PUT')

        <label for="name">Nombre del Evento:</label><br>
        <input type="text" name="name" id="name" value="{{ $event->name }}" required><br>

        <label for="description">Descripcion:</label><br>
        <input type="text" name="description" id="description" value="{{$event->description}}" required><br>

        <label for="date">Fecha:</label><br>
        <input type="date" name="date" id="date" value="{{ $event->date }}" required><br>


        <label for="hour">Hora:</label><br>
        <input type="text" name="hour" id="hour" value="{{ $event->hour }}" required><br>


        <label for="type">Tipo de Evento:</label><br>
        <input type="text" name="type" id="type" value="{{ $event->type }}" required><br>


        <label for="location">Ubicación:</label><br>
        <input type="text" name="location" id="location" value="{{ $event->location }}" required><br>

        <label for="tags">Hashtags:</label><br>
        <input type="text" name="tags" id="tags" value="{{$event->tags}}" required><br>

        <input type="submit" id="btn" value="Guardar Cambios" class="btn"><br>
    </form>
</div>


<script>
    var idEvento = {{$event->id}};
</script>

<script src="{{asset('js/modificarEvento.js')}}"></script>

@endsection
