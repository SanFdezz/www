@extends('layout')

@section('title','Cuenta')

@section('body')

<h2>{{Auth::user()->name}}</h2>
<h3>{{Auth::user()->email}}</h3>
<span>{{Auth::user()->birthday}}</span><br>
<a href="">Eliminar cuenta</a>

@endsection
