@extends('layouts.app')

@section('title', 'Secret Silence - Sosial Media')

@section('content')
<div class="w-full max-w-6xl mx-auto mt-10">
    <x-status />

    <div class="flex flex-col md:flex-row w-1/2 mx-auto justify-around text-center">
        <a href="{{ route('tools-form') }}" class="bg-primary hover:bg-button-hover p-2 text-white rounded-sm my-4" >Edit Tools Page</a>
        <a href="{{ route('about-form') }}" class="bg-primary hover:bg-button-hover p-2 text-white rounded-sm my-4" >Edit About Page</a>
    </div>



    <!-- Modal add song-->
    <div id="song-modal"
        class="fixed inset-0 z-40 flex items-center justify-center bg-black/50 hidden">
        <div class="bg-white w-full max-w-lg rounded-xl p-6 shadow-xl"
            id="modal-card">
            <h2 class="text-xl font-bold mb-4">Add New Song</h2>

            <form action="{{ route('add-song') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                {{-- Title --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5" required>
                </div>

                {{-- Artist --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Artist</label>
                    <input type="text" name="artist" value="{{ old('artist') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5" required>
                </div>

                {{-- Released on --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Released On</label>
                    <input type="date" name="released_at" value="{{ old('released_at') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block  p-2.5" required>
                </div>

                {{-- Lyrics --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Lyrics</label>
                    <textarea name="lyrics" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5" required>{{ old('lyrics') }}</textarea>
                </div>

                {{-- Cover image --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Cover Image (jpg/png, max 10 MB)</label>
                    <input type="file" name="cover_image"  value="{{ old('cover_image') }}" accept=".png, .jpeg, .jpg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5" required>
                    @error('cover_image') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>


                {{-- Spotify URL --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Spotify Link</label>
                    <input type="url" name="spotify" value="{{ old('spotify') }}" placeholder="https://open.spotify.com/..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5">
                </div>

                {{-- Apple Music URL --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Apple Music Link</label>
                    <input type="url" name="apple_music" value="{{ old(key: 'apple_music') }}" placeholder="https://music.apple.com/..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block  p-2.5">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button"
                            id="btn-cancel"
                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-red-500 hover:text-white">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-button text-white rounded-lg hover:bg-button-hover">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="mt-6 overflow-x-auto bg-gray-700 p-4 rounded ">
        <div class="flex flex-row w-full justify-between">
            <h1 class="text-2xl font-bold mb-4 text-white">Released Songs</h1>
            <button id="btn-add-song"
                class="px-4 py-2 bg-button text-white rounded-lg hover:bg-button-hover mb-4">
                + Add Song
            </button>
        </div>
        <table class="min-w-full bg-gray-700 shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-xs uppercase">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Cover</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Artist</th>
                    <th class="px-4 py-2">Released</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($songs as $index => $song)
                    <tr class="border-t text-white text-center">
                        <td class="px-4 py-2">{{  $index }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ Storage::url($song->cover_image) }}"
                                alt="cover"
                                class="h-10 w-10 rounded object-cover">
                        </td>
                        <td class="px-4 py-2">{{ $song->title }}</td>
                        <td class="px-4 py-2">{{ $song->artist }}</td>
                        <td class="px-4 py-2">{{ $song->released_at}}</td>
                        <td class="px-4 flex flex-row justify-around items-center py-4">
                            <a href="{{ route('edit-song',['song'=>$song]) }}" class="px-3 py-1 bg-gray-500 text-white text-xs rounded hover:bg-gray-400 mr-4 ">Edit</a>
                            <form action="{{ route('delete-song', ['song'=>$song]) }}" method="POST"
                                onsubmit="return confirm('Delete this song?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-400">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-6 text-center">No songs yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>


    {{-- sosial media --}}
    <form action="{{ route('sosmed-update') }}" method="POST" class="bg-gray-800 p-4 mt-4 rounded text-center overflow-x-auto">
        @csrf
        @method('PUT')
        <h1 class="text-2xl font-bold mb-4 text-white">Social Media Management</h1>
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-900 text-white">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">URL</th>
                    <th class="px-4 py-2">Icon</th>
                    <th class="px-4 py-2">Warna</th>
                    <th class="px-4 py-2">Background</th>
                    <th class="px-4 py-2">Tipe</th>
                    <th class="px-4 py-2">Hapus?</th>
                </tr>
            </thead>
            <tbody>
                @php $lastIndex = 0; @endphp
                @forelse ($sosmeds as $index => $sosmed)
                    @php $lastIndex = $index + 1; @endphp
                    <tr class="border-b bg-gray-600 text-white">
                        <td class="px-2 py-2">{{ $index + 1 }}</td>
                        <td class="px-2 py-2">
                            <input type="hidden" name="sosmeds[{{ $index }}][id]" value="{{ $sosmed->id }}">
                            <input type="text" name="sosmeds[{{ $index }}][name]" value="{{ $sosmed->name }}" class="w-full border rounded px-2 py-1" required>
                        </td>
                        <td class="px-2 py-2">
                            <input type="text" name="sosmeds[{{ $index }}][url]" value="{{ $sosmed->url }}" class="w-full border rounded px-2 py-1" required>
                        </td>
                        <td class="px-2 py-2">
                            <input type="text" name="sosmeds[{{ $index }}][icon]" value="{{ $sosmed->icon }}" class="w-full border rounded px-2 py-1" required>
                        </td>
                        <td class="px-2 py-2">
                            <input type="text" name="sosmeds[{{ $index }}][color]" value="{{ $sosmed->color }}" class="w-full border rounded px-2 py-1" required>
                        </td>
                        <td class="px-2 py-2">
                            <input type="text" name="sosmeds[{{ $index }}][bg_color]" value="{{ $sosmed->bg_color }}" class="w-full border rounded px-2 py-1" required>
                        </td>
                        <td class="px-2 py-2">
                            <input type="number" name="sosmeds[{{ $index }}][type]" value="{{ $sosmed->type }}" class="w-full border rounded px-2 py-1" required>
                        </td>
                        <td class="px-2 py-2 text-center">
                            <input type="checkbox" name="sosmeds[{{ $index }}][_delete]">
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center py-4">Belum ada data sosial media.</td></tr>
                @endforelse

                {{-- Tambah satu baris kosong --}}
                <tr class="border-t bg-gray-50">
                    <td class="px-2 py-2 font-semibold text-center">+</td>
                    <td class="px-2 py-2"><input type="text" name="sosmeds[{{ $lastIndex }}][name]" class="w-full border rounded px-2 py-1" placeholder="Nama"></td>
                    <td class="px-2 py-2"><input type="text" name="sosmeds[{{ $lastIndex }}][url]" class="w-full border rounded px-2 py-1" placeholder="https://..."></td>
                    <td class="px-2 py-2"><input type="text" name="sosmeds[{{ $lastIndex }}][icon]" class="w-full border rounded px-2 py-1" placeholder="fa-brand fa-instagram"></td>
                    <td class="px-2 py-2"><input type="text" name="sosmeds[{{ $lastIndex }}][color]" class="w-full border rounded px-2 py-1" placeholder="#ffffff"></td>
                    <td class="px-2 py-2"><input type="text" name="sosmeds[{{ $lastIndex }}][bg_color]" class="w-full border rounded px-2 py-1" placeholder="#ffffff"></td>
                    <td class="px-2 py-2"><input type="number" name="sosmeds[{{ $lastIndex }}][type]" class="w-full border rounded px-2 py-1" placeholder="1"></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                Update
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnAddSong = document.getElementById('btn-add-song');
        const songModal = document.getElementById('song-modal');
        const btnCancel = document.getElementById('btn-cancel');

        btnAddSong.addEventListener('click', function () {
            songModal.classList.remove('hidden');
            console.log('Button clicked');
        });

        btnCancel.addEventListener('click', function () {
            songModal.classList.add('hidden');
        });
    });
</script>
@endsection
