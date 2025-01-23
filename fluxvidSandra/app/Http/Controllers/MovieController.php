<?php

namespace App\Http\Controllers;
//para poder usar el modelo de movie
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //filtramos por visibility indicando que 1 es visible
        //mantenemos 6 por pagina
        $movies = Movie::where('visibility',1)->paginate(6);
        //le pasamos los registros obtenidos a la vista
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movieId = Movie::find($id);
        return view('movies.show',compact('movieId', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('movies.edit',compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Movie::findOrFail($id)->delete();
        return redirect()->route('movies.index');
    }
    public function getMoviesByYear(int $year){
        //filtramos las películas según el año que nos llegue
        //mostramos 6 por página
        $movies = Movie::where('year', $year)->paginate(6);
        //pasamos el resultado a la vista byyear
        return view('movies.byyear',compact('movies','year'));

    }
}
