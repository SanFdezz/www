@extends('layout')
@section('title', 'Ficha de la película')
@section('body')
    <h1>Ficha de la película con id: {{ $movieId->id }}</h1>
        <span>Título:</span>
            @if (is_null($movieId->title))
                <span>No tiene título</span>
            @else
               {{ $movieId->title }}
            @endif
            <br>
            <span>Año:</span>
            <span> {{ $movieId->year ?? 'Sin información del año.'}} </span>
            <br>
            <span>Puntuación:</span>
                <span> {{ $movieId->rating ?? 'Sin puntuación.'}} </span>
            <br>
            <span>Sinopsis:</span>
                <span> {{ $movieId->plot ?? 'No hay resumen disponible.'}} </span>
            <br>
            <form action="{{ route('movies.destroy',$movieId->id)}}" method="post">
                {{--el @csrf funciona para conectar--}}
                @csrf
                @method('delete')
                <input type="submit" value="Eliminar">
            </form>
@endsection
