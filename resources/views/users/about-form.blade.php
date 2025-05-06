@extends('layouts.app')

@section('title', 'Secret Silence - About-Form')

@section('content')
    <x-status />

    <form action="{{ route('about-form-post', ['textObject' => $data]) }}" method="POST" enctype="multipart/form-data" class="w-2/3 flex flex-col bg-white items-center rounded p-4 mx-auto">
        @csrf
        <h1 class="font-bold text-xl">Form About</h1>

        <div class="flex flex-col md:flex-row items-center justify-center w-full mt-4">
            <label for="title" class="block mb-2 text-sm  text-gray-900 font-semibold md:mr-4 md:w-1/4">Title</label>
            <input name="title" type="text" id="title" value="{{ old('title', $data->title) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-3/4 p-2.5"
            required />
        </div>

        <div class="flex flex-col md:flex-row items-center justify-center w-full mt-4">
            <label for="dec" class="block mb-2 text-sm  text-gray-900 font-semibold md:mr-4 md:w-1/4">Description</label>
            <textarea name="dec" id="dec"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-3/4 p-2.5 min-h-70"
                required>{{ old('dec', $data->description) }}</textarea>
        </div>


        {{-- Image Upload --}}
        <div class="flex flex-col md:flex-row items-center justify-center w-full mt-4">
            <label for="image" class="block mb-2 text-sm  text-gray-900 font-semibold md:mr-4 md:w-1/4">Upload Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-3/4 p-2.5"  />
        </div>

        <div class="mt-4 flex w-full justify-center align-between gap-2">
            <button type="button" class="text-white bg-red-500 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-secondary font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
            onclick="window.location.href='{{ route('users.index') }}'">Back</button>

            <button type="submit" class="text-white bg-button hover:bg-button-hover focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </div>
    </form>

@endsection
