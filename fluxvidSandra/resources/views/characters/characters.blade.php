<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Characters</title>
    <link rel="stylesheet" href="{{ asset('CSS/style.css') }}">
</head>

<body>
    @forelse ($characters as $character)
        <div class="characters">
            <span>Nombre:</span>
            @if (is_null($character['name']))
                Sin nombre
            @else
                {{ $character['name'] }}
            @endif
            <br>
            <span>Alias:</span>
            @if (is_null($character['alias']))
                Sin alias
            @else
                {{ $character['alias'] }}
            @endif
            <br>
            <span>Película:</span>
            @if (is_null($character['movie']))
                Sin información
            @else
                {{ $character['movie'] }}
            @endif
            <br>
            <span>Año:</span>
            @if (is_null($character['age']))
                Sin registro
            @else
                {{ $character['age'] }}
            @endif
            <br>
            <span>Tipo de personaje:</span>
            @if (is_null($character['species']))
                Desconocida
            @else
                {{ $character['species'] }}
            @endif
            <br>
            <span>Género:</span>
            @if (is_null($character['gender']))
                Desconocido
            @else
                {{ $character['gender'] }}
            @endif
            <br>
            <img src="{{ $character['img'] }}" alt="imagen_personaje"><br>
        </div>
    @empty
        <div>No se han registrado personajes</div>
    @endforelse

</body>

</html>
