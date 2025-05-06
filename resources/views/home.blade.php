@extends('layouts.app')

@section('title', 'Secret Silence')

@section('content')
    <div class="text-white w-1/4">
        <img src="{{ asset('storage/' . $songs[0]->cover_image) }}" alt="{{ $songs[0]->title }}" class="rounded shadow-lg">
    </div>
@endsection
