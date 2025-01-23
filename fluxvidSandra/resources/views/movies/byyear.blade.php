@section('title', 'Año de la peli')

@extends('layout')

@section('body_page')
    <h1>Listado de películas del año {{$year}}</h1>
    <div class="movies">
        @forelse ($movies as $movie)
            <span>Título:</span>
            @if (is_null($movie->title))
                <span>No tiene título</span>
            @else
               {{ $movie->title }}
            @endif
            <br>
            <span>Año:</span>
            @if (is_null($movie->year))
                <span>Sin información del año.</span>
            @else
                <span> {{ $movie->year }} </span>
            @endif
            <br>
            <span>Puntuación:</span>
            @if (is_null($movie->rating))
                <span>Sin puntuación.</span>
            @else
                <span> {{ $movie->rating }} </span>
            @endif
            <br>
            <span>Sinopsis:</span>
            @if (is_null($movie->plot))
                <span>No hay resumen disponible.</span>
            @else
                <span> {{ $movie->plot }} </span>
            @endif
            <br>
        @empty
            No hay películas para mostrar.
        @endforelse
        {{$movies->links()}}
    </div>
@endsection
