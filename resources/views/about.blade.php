@extends('layouts.app')

@section('title', 'Secret Silence - About')

@section('content')
    <div class="text-white flex flex-col justify-center mt-4">
        <div class="flex flex-col items-start justify-between gap-8">
            @if (isset($data))
                <h1 class="text-5xl font-bold mb-6">{{ $data->title }}</h1>
                <div class="flex flex-col-reverse md:flex-row w-full">
                    <p class="text-sm leading-relaxed text-white whitespace-pre-line md:w-2/3 md:mr-4 mt-4 md:mt-0">{{ $data->description }}</p>
                    <div class="md:w-1/3">
                        <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}" class="rounded shadow-lg">
                    </div>
                </div>  
            @endif
        </div>

        <div class="mt-16 text-center">
            <h2 class="text-2xl font-semibold mb-4">Follow me!</h2>
            <x-sosmed :sosmeds="$sosmeds" />
        </div>
    </div>
@endsection


