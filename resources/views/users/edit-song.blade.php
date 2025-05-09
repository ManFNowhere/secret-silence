@extends('layouts.app')

@section('title', 'Secret Silence - Software-Form')

@section('content')
    <x-status />

    <div id="song-modal" class="flex items-center justify-center w-full">
        <div class="bg-white w-full max-w-lg rounded-xl p-6 shadow-xl" id="modal-card">
            <h2 class="text-xl font-bold mb-4">Edit {{ $song->title }}</h2>

            <form action="{{ route('update-song', $song->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                {{-- Title --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Title</label>
                    <input type="text" name="title" value="{{ old('title', $song->title) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5" required>
                </div>

                {{-- Artist --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Artist</label>
                    <input type="text" name="artist" value="{{ old('artist', $song->artist) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5" required>
                </div>

                {{-- Released on --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Released On</label>
                    <input type="date" name="released_at" value="{{ old('released_at', \Carbon\Carbon::parse($song->released_at)->format('Y-m-d')) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5" required>
                </div>

                {{-- Lyrics --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Lyrics</label>
                    <textarea name="lyrics" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5" required>{{ old('lyrics', $song->lyrics) }}</textarea>
                </div>

                {{-- Cover image --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Cover Image (jpg/png, max 10 MB)</label>
                    {{-- Existing Cover Preview --}}
                    @if($song->cover_image)
                    <div class="mb-2">
                        <p class="text-sm text-gray-600">Current cover:</p>
                        <img src="{{ Storage::url($song->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-md border">
                    </div>
                    @endif

                    {{-- File input --}}
                    <input type="file" name="cover_image" accept=".png, .jpeg, .jpg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5">

                    @error('cover_image')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Spotify URL --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Spotify Link</label>
                    <input type="url" name="spotify" value="{{ old('spotify', $song->spotify) }}" placeholder="https://open.spotify.com/..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5">
                </div>

                {{-- Apple Music URL --}}
                <div class="flex flex-col">
                    <label class="block text-sm font-medium">Apple Music Link</label>
                    <input type="url" name="apple_music" value="{{ old('apple_music', $song->apple_music) }}" placeholder="https://music.apple.com/..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5">
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" id="btn-cancel" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-red-500 hover:text-white">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-button text-white rounded-lg hover:bg-button-hover">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
