@section('title', 'Listado de directores')
@extends('layout')
@section('body')
    <h1>Listado de películas</h1>
    <div>
        @forelse ($directors as $director)
            <div>Director:</div>
                <a href="{{ route('directors.show',['director'=>$director->id])}}">{{ $director->name }}</a>
        @empty
            No hay películas para mostrar.
        @endforelse
        {{$directors->links()}}
    </div>
@endsection
