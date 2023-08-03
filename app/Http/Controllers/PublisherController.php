<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Models\Publisher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::all();
        return view('models.publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('models.publishers.create');
    }

    public function store(StorePublisherRequest $request)
    {
        $request->validated();
        Publisher::create([
            'name' => $request->name,
        ]);
        return response()->json(['success' => "Publisher Created Successfully"]);
    }

    public function show(Publisher $publisher)
    {
        return view('models.publishers.show', compact('publisher'));
    }

    public function edit(Publisher $publisher)
    {
        return view('models.publishers.edit', compact('publisher'));
    }

    public function update(UpdatePublisherRequest $request, Publisher $publisher)
    {
        $request->validated();
        $publisher->update([
            'name' => $request->name,
        ]);
        return response()->json(['success' => "Publisher Updated Successfully"]);
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return response()->json(['success' => "Publisher Deleted Successfully"]);
    }
}
