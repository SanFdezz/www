@extends('layout')

@section('title','Cuenta')

@section('body')

<div class="bloque">
    <h2>{{Auth::user()->name}}</h2>
    <h3>{{Auth::user()->email}}</h3>
    <span>{{Auth::user()->birthday}}</span><br>
    <form action="{{ route('account.destroy', Auth::user()->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn" value="Eliminar cuenta">
    </form>
</div>

@endsection
