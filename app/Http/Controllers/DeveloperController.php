<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeveloperRequest;
use App\Http\Requests\UpdateDeveloperRequest;
use App\Models\Developer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::all();
        return view('models.developers.index', compact('developers'));
    }

    public function create()
    {
        return view('models.developers.create');
    }

    public function store(StoreDeveloperRequest $request)
    {
        $request->validated();
        Developer::create([
            'name' => $request->name,
        ]);
        return redirect('/developers');
    }

    public function show(Developer $developer)
    {
        return view('models.developers.show', compact('developer'));
    }

    public function edit(Developer $developer)
    {
        return view('models.developers.edit', compact('developer'));
    }

    public function update(UpdateDeveloperRequest $request, Developer $developer)
    {
        $request->validated();
        $developer->update([
            'name' => $request->name,
        ]);
        return redirect('developers/');
    }

    public function destroy(Developer $developer)
    {
        $developer->games()->detach();
        $developer->delete();
        return redirect('developers/');
    }
}
