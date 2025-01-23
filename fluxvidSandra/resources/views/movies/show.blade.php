@extends('layout')

@section('title', 'Ficha de la película')

@section('body_page')
    <h1>Ficha de la película con id: {{ $id }}</h1>
        <span>Título:</span>
            @if (is_null($movieId->title))
                <span>No tiene título</span>
            @else
               {{ $movieId->title }}
            @endif
            <br>
            <span>Año:</span>
            @if (is_null($movieId->year))
                <span>Sin información del año.</span>
            @else
                <span> {{ $movieId->year }} </span>
            @endif
            <br>
            <span>Puntuación:</span>
            @if (is_null($movieId->rating))
                <span>Sin puntuación.</span>
            @else
                <span> {{ $movieId->rating }} </span>
            @endif
            <br>
            <span>Sinopsis:</span>
            @if (is_null($movieId->plot))
                <span>No hay resumen disponible.</span>
            @else
                <span> {{ $movieId->plot }} </span>
            @endif
            <br>
            <form action="{{ route('movies.destroy', $id)}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="Eliminar">
            </form>
@endsection
