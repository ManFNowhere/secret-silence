@props(['song'])

@php
    $image = Storage::url($song->cover_image);
    $modalId   = 'modal-'  . $song->id;
    $triggerId = 'cover-'  . $song->id;
    $closeId   = 'close-'  . $song->id;
@endphp

{{-- card --}}
<div class="relative group rounded-lg mt-4" id="{{ $triggerId }}">
    <div class="absolute inset-0 bg-white/10 border border-white/20 backdrop-blur-lg rounded
                opacity-0 group-hover:opacity-100 transition"></div>

    <span class="absolute bottom-2 left-2 text-white font-semibold
                opacity-0 group-hover:opacity-100 transition z-10 text-xl">
        {{ $song->title }}
    </span>

    <img
        src="{{ $image }}"
        alt="{{ $song->title }} cover"
        class="w-64 h-64 object-cover rounded-lg shadow-md cursor-pointer">

</div>

{{-- modal card --}}
<div id="{{ $modalId }}"
    class="fixed inset-0 z-40 flex items-start md:items-center justify-center bg-black/50 overflow-y-auto pt-10 sm:pt-12 ">
    <div class="bg-gray-900 w-full max-w-md md:max-w-4xl mx-4 md:mx-10 rounded-xl p-6 shadow-xl relative">
        <button id="{{ $closeId }}"
                class="absolute top-2 right-6 text-2xl leading-none text-gray-100 hover:bg-red-400 cursor-pointer bg-red-500 px-2 rounded">
            &times;
        </button>

        <div class="flex flex-col md:flex-row w-full">
            <div class="flex flex-col w-1/3 justify-center items-center md:justify-start md:mr-4 mb-4 bg-gray-800 rounded p-4 mx-4 text-white mt-10">
                <img
                    src="{{ $image }}"
                    alt="{{ $song->title }} cover"
                    class="w-fit object-cover rounded-lg shadow-md cursor-pointer mb-2">

                <h2 class="text-xl md:text-2xl font-bold mb-2 text-center">{{ $song->title }}</h2>
                <p class="text-sm text-gray-400 mb-4 text-center">
                    {{ $song->artist }} &bull; {{ Carbon\Carbon::parse($song->release_date)->format('F j, Y') }}
                </p>

                <span class="font-semibold text-lg">Save it now!</span>
                <div class="flex gap-4 mt-2">
                    @isset($song->spotify)
                        <a href="{{ $song->spotify }}" target="_blank"
                        class="px-4 py-2 bg-green-500 text-white rounded text-sm">Spotify</a>
                    @endisset
                    @isset($song->apple_music)
                        <a href="{{ $song->apple_music }}" target="_blank"
                        class="px-4 py-2 bg-rose-500 text-white rounded text-sm">Apple&nbsp;Music</a>
                    @endisset
                </div>
            </div>

            <div class="text-white p-4 rounded flex flex-col overflow-y-auto h-96 md:h-auto md:max-h-[36rem] w-full mt-10">
                <span class="text-lg md:text-xl font-semibold mb-4">Lyrics</span>
                <p class="whitespace-pre-line text-sm">{{ $song->lyrics }}</p>
            </div>
        </div>
    </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('{{ $triggerId }}');
    const modal   = document.getElementById('{{ $modalId }}');
    const close   = document.getElementById('{{ $closeId }}');

    if (!trigger || !modal) {
        console.error('Trigger atau modal tidak ditemukan!');
        return;
    }

    trigger.onclick = (event) => {
        event.preventDefault();
        modal.classList.remove('hidden');
    };
    close.addEventListener('click', () => modal.classList.add('hidden'));
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.add('hidden');
    });
});
</script>
