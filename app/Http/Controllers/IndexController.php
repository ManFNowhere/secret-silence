<?php

namespace App\Http\Controllers;

use App\Models\Songs;
use App\Models\Sosmed;
use App\Models\TextObject;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = Songs::all();
        return view('home', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function about()
    {
        $data = TextObject::where('type', 1)->first();
        $sosmeds = Sosmed::where('type', 1)->get();
        // dump($data);

        // dump((asset('storage/' . $data->image)));
        return view('about', compact('data', 'sosmeds'));
    }
}
