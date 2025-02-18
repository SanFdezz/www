<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::where('visible', true)->get();
        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('players.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayerRequest $request)
    {
        $generateName = $request->hasFile('avatar') ? $request->file('avatar')->store('avatars','public'):null;
        $player = new Player();
        $player->name = $request->input('name');
        $player->twitter = $request->input('twitter');
        $player->instagram = $request->input('instagram');
        $player->twitch = $request->input('twitch');
        $player->avatar = $generateName;
        $player->age = $request->input('age');
        $player->position = $request->input('position');
        $player->visible = 1;
        $player->save();

        return redirect()->route('players.show',$player->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        return view('players.show',compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        return view('players.edit',compact('player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        $player->visible= $request->input('visible');
        $player->save();
        return redirect()->route('players.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
