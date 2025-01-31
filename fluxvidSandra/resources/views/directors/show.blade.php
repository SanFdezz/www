@extends('layout')
@section('title', 'Ficha de la director')
@section('body')
    <h1>Ficha del director: {{$director->name}} </h1>
        <span>Título:</span>
            <span>Cumpleaños:</span>
            <span> {{ $director->birthday ?? 'Sin cumpleaños conocido.'}} </span>
            <br>
            <span>Nacionalidad:</span>
                <span> {{ $director->nationality ?? 'Sin nacionalidad conocida.'}} </span>
            <br>
            <br>
            <ul>
                @foreach ($director->movies as $movie)
                    <li>
                        <a href="{{ route('movies.show', $movie)}}">Título:{{$movie->title}} || Año: {{$movie->year}}</a>
                    </li>
                @endforeach
            </ul>

@endsection
