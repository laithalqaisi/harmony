<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Developer;
use App\Models\Game;
use App\Http\Controllers\Controller;
use App\Models\Publisher;
use App\Models\Tag;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('models.games.index', compact('games'));
    }

    public function create()
    {
        $publishers = Publisher::all();
        $developers = Developer::all();
        $tags = Tag::all();
        return view('models.games.create', compact('publishers', 'developers', 'tags'));
    }

    public function store(StoreGameRequest $request)
    {
        $request->validated();
        //dd($request);
        $game_id = Game::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'publisher_id' => $request->publisher_id,
            'release_date' => $request->release_date,
        ])->id;
        Game::findOrFail($game_id)->developers()->attach($request->developers_id);
        Game::findOrFail($game_id)->tags()->attach($request->tags_id);
        return redirect('/games');
    }

    public function show(Game $game)
    {
        return view('models.games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        $publishers = Publisher::all();
        $developers = Developer::all();
        $tags = Tag::all();
        return view('models.games.edit', compact('game', 'publishers', 'developers', 'tags'));
    }

    public function update(UpdateGameRequest $request, Game $game)
    {
        $request->validated();
        //dd($request);
        $game->update([
            'name' => $request->name,
            'rating' => $request->rating,
            'publisher_id' => $request->publisher_id,
            'release_date' => $request->release_date
        ]);
        Game::findOrFail($game->id)->developers()->sync($request->developers_id);
        Game::findOrFail($game->id)->tags()->sync($request->tags_id);
        return redirect('games/');
    }

    public function destroy(Game $game)
    {
        $game->developers()->detach();
        $game->tags()->detach();
        $game->delete();
        return redirect('games/');
    }
}
