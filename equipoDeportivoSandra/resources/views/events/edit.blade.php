@extends('layout')

@section('title','Modificar evento')

@section('body')

<div id="edicionEvento">
    <div id="contenedorEdicion">
        <form id="formEditarEvento" action="" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Nombre del Evento:</label><br>
            <input type="text" name="name" id="name" value="{{ $event->name }}" required><br>


            <label for="date">Fecha:</label><br>
            <input type="date" name="date" id="date" value="{{ $event->date }}" required><br>


            <label for="hour">Hora:</label><br>
            <input type="text" name="hour" id="hour" value="{{ $event->hour }}" required><br>


            <label for="type">Tipo de Evento:</label><br>
            <input type="text" name="type" id="type" value="{{ $event->type }}" required><br>


            <label for="location">Ubicación:</label><br>
            <input type="text" name="location" id="location" value="{{ $event->location }}" required><br>

            <input type="submit" id="btn" value="Guardar Cambios"><br>
        </form>
    </div>
</div>

<script>
    var idEvento = {{$event->id}};
</script>

<script src="{{asset('js/modificarEvento.js')}}"></script>

@endsection
