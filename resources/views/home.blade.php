@extends('layouts.app')

@section('title', 'Secret Silence')

@section('content')
    {{-- Modal Listen Link --}}
    <div id="listen-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm hidden">
        <div class="bg-white rounded-2xl p-8 w-full max-w-lg shadow-2xl relative">
            <h2 class="text-2xl font-extrabold text-gray-800 mb-6 text-center">Listen on Your Favorite Platform</h2>
            <div class="grid grid-cols-2 gap-4">
                @if (isset($songs[0]))
                <a href="{{ $songs[0]->spotify }}" target="_blank" class="flex items-center justify-center gap-2 py-3 px-4 bg-green-500 text-white rounded-lg hover:bg-green-400 transition font-semibold shadow">
                    <i class="fa-brands fa-spotify text-xl"></i> Spotify
                </a>
                <a href="{{ $songs[0]->apple_music }}" target="_blank" class="flex items-center justify-center gap-2 py-3 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-400 transition font-semibold shadow">
                    <i class="fa-brands fa-apple text-xl"></i> Apple Music
                </a>
                @endif
            </div>
            <button id="close-modal" class="mt-8 w-full bg-gray-800 text-white py-3 rounded-lg hover:bg-gray-700 transition font-bold">
                Close
            </button>
        </div>
    </div>

    {{-- Hero Section --}}
    <div class="flex flex-row bg-black p-10 items-start rounded my-auto">
        <div class="flex flex-row items-center gap-12 max-w-7xl px-6">
        
            @if (isset($songs[0]))
                {{-- Album Cover --}}
                <div class="w-1/2">
                    <img src="{{ asset('storage/' . $songs[0]->cover_image) }}" alt="{{ $songs[0]->title }}" class="rounded-lg shadow-2xl w-full h-auto object-cover">
                </div>

                {{-- Text Content --}}
                <div class="w-1/2 text-white">
                    <h1 class="text-8xl font-extrabold leading-tight">
                        Secret <span class="text-primary">Silence</span>
                    </h1>
                    <p class="text-lg text-gray-300 mt-6 mb-8">
                        {{ $songs[0]->description ?? 'An emotional journey through sound and silence.' }}
                    </p>
                    <button
                        id="listen-button"
                        class="inline-block bg-white text-black hover:text-white font-bold px-6 py-3 rounded-lg shadow-lg hover:bg-primary transition">
                        🎧 Listen Now
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const listenButton = document.getElementById('listen-button');
            const closeModalButton = document.getElementById('close-modal');
            const listenModal = document.getElementById('listen-modal');

            listenButton?.addEventListener('click', () => {
                listenModal?.classList.remove('hidden');
            });

            closeModalButton?.addEventListener('click', () => {
                listenModal?.classList.add('hidden');
            });
        });
    </script>
@endsection
