@extends('layouts.app')

@section('title', 'Secret Silence - Softwares')

@section('content')
    <div class="text-white flex flex-col justify-center mt-4">
        <div class="flex flex-col items-start justify-between gap-8">
            @if (isset($data))
                <h1 class="text-5xl font-bold mb-6">{{ $data->title }}</h1>
                <div class="flex flex-col-reverse md:flex-row w-full">
                    <div class="felx flex-col md:w-1/3 mt-4 md:mt-0">
                        <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}" class="rounded shadow-lg">
                        <div class="flex flex-col w-full">
                            <h2 class="text-xl font-bold mt-4">Available on</h2>
                            @if ($actualWin )
                                <a href="{{ asset('storage/' . $actualWin->path) }}"
                                    class="bg-windows hover:bg-windows-hover text-white font-bold py-2 px-4 rounded mt-4"
                                    ><i class="fa-brands fa-windows"></i> {{ $actualWin->platform }} v{{ $actualWin->version }}</a>
                            @endif
                            @if ($actualMac)
                                <a href="{{ asset('storage/' . $actualMac->path) }}"
                                    class="bg-mac hover:bg-mac-hover text-black font-bold py-2 px-4 rounded mt-4"
                                    ><i class="fa-brands fa-apple"></i> {{ $actualMac->platform }} v{{ $actualMac->version }}</a>
                            @endif
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-white whitespace-pre-line md:w-2/3 md:ml-4 mt-4 md:mt-0">{{ $data->description }}</p>
                </div>
            @endif
        </div>
        <div class="mt-8 flex flex-col md:flex-row justify-center items-center">
            <span class="font-bold text-xl md:text-4xl md:mr-4">Any feedback or bugs please contact me on:</span>
            <x-sosmed :sosmeds="$sosmeds" />
        </div>
    </div>
@endsection


