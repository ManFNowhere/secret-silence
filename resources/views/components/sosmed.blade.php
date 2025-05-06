@props(['sosmeds'])

<div class="flex justify-center gap-4">
    @foreach ($sosmeds as $sosmed)
        <a href="{{ $sosmed->url }}" target="_blank"
           class="w-10 h-10 flex items-center justify-center rounded-full transition-transform transform hover:scale-110"
           style="background-color: {{ $sosmed->bg_color }};">
            <i class="{{ $sosmed->icon }} text-xl" style="color: {{ $sosmed->color }};"></i>
        </a>
    @endforeach
</div>
