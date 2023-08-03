<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('models.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('models.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $request->validated();
        Tag::create([
            'name' => $request->name,
        ]);
        return response()->json(['success' => "Tag Created Successfully"]);
    }

    public function show(Tag $tag)
    {
        return view('models.tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('models.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $request->validated();
        $tag->update([
            'name' => $request->name,
        ]);
        return response()->json(['success' => "Tag Updated Successfully"]);
    }

    public function destroy(Tag $tag)
    {
        $tag->games()->detach();
        $tag->delete();
        return response()->json(['success' => "Tag Deleted Successfully"]);
    }
}
