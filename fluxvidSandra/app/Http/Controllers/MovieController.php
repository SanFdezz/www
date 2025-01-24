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
        $movies = Movie::where('visibility',1)->paginate(6);
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
        return view('movies.show',compact('movieId'));
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
        $movies = Movie::where('year', $year)->paginate(6);
        return view('movies.byyear',compact('movies'));

    }
}
