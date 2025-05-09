<?php

namespace App\Http\Controllers;
use App\Models\Software;
use App\Models\Sosmed;
use App\Models\TextObject;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TextObject::where('type', 2)->first();
        $Softwares = Software::all();
        $actualWin = Software::where('platform', 'Windows')->latest()->get()->first();
        $actualMac = Software::where('platform', 'Mac')->latest()->get()->first();
        $sosmed = Sosmed::where('type', 2)->get();
        // dd(vars: $sosmed);
        return view('software', [
            'data' => $data,
            'Softwares' => $Softwares,
            'actualWin' => $actualWin,
            'actualMac' => $actualMac,
            'sosmeds' => $sosmed,
        ]);
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

    public function download(Software $Software)
    {
        dd($Software);
        return response()->download(public_path($Software->file));
    }
}
