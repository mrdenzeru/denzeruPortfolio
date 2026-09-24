@php
    $filters = ['All', 'Photography', 'Videography'];
    $media = collect([
        ['size' => 'large'], ['size' => 'large'],
        ['size' => 'small'], ['size' => 'small'], ['size' => 'small'],
    ]);
@endphp

<div class="mx-auto max-w-6xl px-6 py-16 text-center">
    <h2 class="text-5xl font-extrabold italic text-[#00224D]">also part of me</h2>
    <p class="mx-auto mt-3 max-w-2xl text-sm text-gray-600">
        Beyond screens, I capture and edit moments through
        <span class="font-bold text-[#1A1A18]">photography and videography</span>
        — another creative outlet that sharpens my visual eye.
    </p>

    <div class="mt-6 flex flex-wrap justify-center gap-2">
        @foreach ($filters as $i => $filter)
            <button class="rounded-full px-4 py-1.5 text-xs font-medium {{ $i === 0 ? 'bg-[#FFC30B] text-[#1A1A18]' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $filter }}
            </button>
        @endforeach
    </div>

    <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
        @foreach ($media->take(2) as $item)
            <div class="aspect-video w-full rounded-lg bg-gray-300"></div>
        @endforeach
    </div>
    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
        @foreach ($media->skip(2) as $item)
            <div class="aspect-video w-full rounded-lg bg-gray-300"></div>
        @endforeach
    </div>

    <a href="#" class="mt-8 inline-block rounded-lg bg-[#FFC30B] px-6 py-2.5 text-sm font-semibold text-[#1A1A18] hover:bg-[#00224D] hover:text-white">
        View All Works
    </a>
</div>
