@extends('layouts.app')

@section('title', 'Secret Silence - Released')

@section('content')

{{-- @dump($songs[0]) --}}

    <div class="w-full  p-4 rounded flex flex-col justify-center items-center">
        <h1 class="text-4xl font-bold text-white">Released Songs</h1>
        <hr class="w-full text-white my-4">

        <div class="flex flex-row flex-wrap w-full justify-around items-center mb-4">
            @foreach ($songs as $song)
                <x-card :song="$song" />
            @endforeach
        </div>

    </div>
@endsection
