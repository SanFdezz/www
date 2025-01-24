@section('title', 'Listado de películas')
@extends('layout')
@section('body')
    <h1>Listado de películas</h1>
    <div>
        @forelse ($movies as $movie)
            <div>Título:</div>
            @if (is_null($movie->title))
                <div>No tiene título</div>
            @else
                <a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a>
            @endif
            <br>
            <div>Año:</div>
                <div> {{ $movie->year ?? 'Sin información del año.'}} </div>
            <br>
            <div>Puntuación:</div>
                <div> {{ $movie->rating ?? 'Sin puntuación.'}} </div>
            <br>
            <div>Sinopsis:</div>
                <div> {{ $movie->plot ?? 'No hay resumen disponible.'}} </div>
            <br>
        @empty
            No hay películas para mostrar.
        @endforelse
        {{$movies->links()}}
    </div>
@endsection
