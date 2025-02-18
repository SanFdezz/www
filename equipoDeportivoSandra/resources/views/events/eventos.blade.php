@extends('layout')

@section('title','Eventos')

@section('body')

<div id="contenedorEventos" >

</div>

@auth
    <script>
        var userRole = @json(Auth::user()->rol);
        var eventRoute = "{{ route('events.show', ':id') }}";
        var editEventRoute = "{{ route('events.edit', ':id') }}";
    </script>
@endauth

<script src="{{asset('/js/eventos.js')}}"></script>

@endsection
