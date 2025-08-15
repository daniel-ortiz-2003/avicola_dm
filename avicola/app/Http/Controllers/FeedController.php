<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Http\Requests\StoreFeedRequest;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feeds = Feed::latest()->paginate(10);
        return view('feeds.index', compact('feeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedRequest $request)
    {
        Feed::create($request->validated());
        return redirect()->route('feeds.index')->with('success', 'Alimento registrado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feed $feed)
    {
        // Para este CRUD, redirigimos a editar directamente.
        return redirect()->route('feeds.edit', $feed);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feed $feed)
    {
        return view('feeds.edit', compact('feed'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFeedRequest $request, Feed $feed) // Se puede usar el mismo request si las reglas son iguales
    {
        $feed->update($request->validated());
        return redirect()->route('feeds.index')->with('success', 'Alimento actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feed $feed)
    {
        $feed->delete();
        return redirect()->route('feeds.index')->with('success', 'Alimento eliminado con éxito.');
    }
}
