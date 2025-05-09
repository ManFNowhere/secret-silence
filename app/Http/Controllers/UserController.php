<?php

namespace App\Http\Controllers;

use App\Models\Software;
use App\Models\Sosmed;
use App\Models\TextObject;
use App\Models\User;
use App\Models\Songs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = Songs::all();
        $sosmed = Sosmed::all();
        return view('users.index', [
            'songs' => $songs,
            'sosmeds' => $sosmed
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }



    public function aboutForm()
    {
        $data = TextObject::where('type', 1)->first();
        if (!$data) {
            $data = new TextObject();
            $data->type = 1;
            $data->title = '';
            $data->description = '';
            $data->image = '';
            $data->save();
        }
        return view('users.about-form', ['data' => $data]);
    }

    public function aboutFormPost(Request $request, TextObject $textObject)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'dec' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update basic fields
        $textObject->title = $data['title'];
        $textObject->description = $data['dec'];

        // Cek apakah user upload gambar baru
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $textObject->image = $imagePath;
        }

        $textObject->save();

        return redirect()->route('users.index')->with('success', 'About form submitted successfully.');
    }

    public function softwareForm()
    {
        $data = TextObject::where('type', 2)->first();
        if (!$data) {
            $data = new TextObject();
            $data->type = 2;
            $data->title = '';
            $data->description = '';
            $data->image = '';
            $data->save();
        }
        return view('users.software-form', ['data' => $data]);
    }

    public function softwareFormPost(Request $request, TextObject $textObject)
    {
        // dd($request->file('mac'));
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'dec' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'windows' => 'nullable|file|mimes:exe|max:51200', // max 50MB
            'version-windows' => 'nullable|string|max:255',
            'mac' => 'nullable|file|max:51200',
            'version-mac' => 'nullable|string|max:255',

        ]);

        // Update TextObject
        $textObject->title = $data['title'];
        $textObject->description = $data['dec'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $textObject->image = $imagePath;
        }

        $textObject->save();

        // Proses file Windows
        if ($request->hasFile('windows')) {
            $versionWindows = $data['version-windows'] ?? '-';
            $fileWindows = $request->file('windows');
            $filenameWindows = 'windows-' . $versionWindows . '.' . $fileWindows->getClientOriginalExtension();

            $windowsPath = $fileWindows->storeAs('software/windows', $filenameWindows, 'public');

            Software::create([
                'name' => 'software-windows',
                'platform' => 'windows',
                'version' => $versionWindows,
                'path' => $windowsPath,
            ]);
        }

        // Proses file MacOS
        if ($request->hasFile('mac')) {
            $versionMac = $data['version-mac'] ?? '-';
            $fileMac = $request->file('mac');
            $filenameMac = 'mac-' . $versionMac . '.' . $fileMac->getClientOriginalExtension();

            $macPath = $fileMac->storeAs('software/mac', $filenameMac, 'public');

            Software::create([
                'name' => 'software-mac',
                'platform' => 'mac',
                'version' => $versionMac,
                'path' => $macPath,
            ]);
        }


        return redirect()->route('users.index')->with('success', 'Form berhasil disimpan dan software diperbarui.');
    }



    public function sosmedUpdate(Request $request)
    {
        $data = $request->input('sosmeds', []);

        foreach ($data as $item) {
            if (isset($item['id'])) {
                // Update atau hapus
                if (isset($item['_delete'])) {
                    Sosmed::where('id', $item['id'])->delete();
                } else {
                    Sosmed::where('id', $item['id'])->update([
                        'name' => $item['name'],
                        'url' => $item['url'],
                        'icon' => $item['icon'],
                        'color' => $item['color'],
                        'bg_color' => $item['bg_color'],
                        'type' => $item['type'],
                    ]);
                }
            } else {
                // Simpan data baru jika minimal ada nama
                if (!empty($item['name'])) {
                    Sosmed::create([
                        'name' => $item['name'],
                        'url' => $item['url'] ?? '',
                        'icon' => $item['icon'] ?? '',
                        'color' => $item['color'] ?? '',
                        'bg_color' => $item['bg_color'] ?? '',
                        'type' => $item['type'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Semua data sosial media berhasil diperbarui.');
    }

    public function addSong(Request $request){

        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'artist'       => 'required|string|max:255',
            'released_at'   => 'required|date',
            'lyrics'       => 'required|string',
            'cover_image'  => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'spotify'      => 'nullable|url',
            'apple_music'  => 'nullable|url',
        ]);

        $coverPath = $request->file('cover_image')
        ->store('covers', 'public');
        Songs::create([
            'title'        => $data['title'],
            'artist'       => $data['artist'],
            'released_at'   => $data['released_at'],
            'lyrics'       => $data['lyrics'],
            'cover_image'  => $coverPath,
            'spotify'      => $data['spotify'],
            'apple_music'  => $data['apple_music'],
        ]);
        return redirect()
        ->back()
        ->with('success', 'Song added successfully!');
    }

    public function editSong(Songs $song)
    {
        return view('users.edit-song', [
            'song' => $song
        ]);
    }

    public function updateSong(Request $request, Songs $song){
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'released_at' => 'required|date',
            'lyrics' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // 10MB
            'spotify' => 'nullable|url',
            'apple_music' => 'nullable|url',
        ]);
        // Update basic fields
        $song->title = $request->title;
        $song->artist = $request->artist;
        $song->released_at = $request->released_at;
        $song->lyrics = $request->lyrics;
        $song->spotify = $request->spotify;
        $song->apple_music = $request->apple_music;

        // Handle cover image if uploaded
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($song->cover_image && Storage::exists($song->cover_image)) {
                Storage::delete($song->cover_image);
            }

            $path = $request->file('cover_image')->store('public/covers');
            $song->cover_image = $path;
        }

        $song->save();

        return redirect()->route('users.index')->with('status', 'Song updated successfully!');
    }

    public function deleteSong(Songs $song)
{
    // Hapus file fisik (opsional aman)
    Storage::disk('public')->delete([$song->cover_image]);

    $song->delete();

    return redirect()
        ->back()
        ->with('success', 'Song deleted successfully!');
}

}
