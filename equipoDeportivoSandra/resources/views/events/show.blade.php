@extends('layout')

@section('title','Evento')

@section('body')

<div id="contenedorEvento" class="bloque">

</div>

@auth
    <script>
        var userRole = @json(Auth::user()->rol);
        var idEvento = {{$event->id}};
        var eventRoute = "{{ route('events.edit', ':id') }}";
        var allEventsRoute = "{{ route('eventos')}}"
    </script>
@endauth

<script src="{{asset('js/evento.js')}}"></script>

@endsection

