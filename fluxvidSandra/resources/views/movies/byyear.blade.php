@section('title', 'Año de la peli')
@extends('layout')
@section('body')
    <h1>Listado de películas del año {{$movies->first()->year}}</h1>
    <div class="movies">
        @forelse ($movies as $movie)
            <div>Título:</div>
               <div>{{ $movie->title ?? 'No tiene título' }}</div>
            <br>
            <div>Año:</div>
                <div> {{ $movie->year ?? 'Sin información del año.' }} </div>
            <br>
            <div>Puntuación:</div>
                <div> {{ $movie->rating ?? 'Sin puntuación.'}} </div>
            <br>
            <div>Sinopsis:</div>
                <div> {{ $movie->plot ?? 'No hay resumen disponible'}} </div>
            <br>
        @empty
            No hay películas para mostrar.
        @endforelse
        {{$movies->links()}}
    </div>
@endsection
