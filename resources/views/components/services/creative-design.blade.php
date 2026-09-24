@php
    $creativeServices = [
        ['icon' => 'brand-icon.png', 'title' => 'Branding Design', 'desc' => "I build cohesive brand identities that tell your story — from logo to color palette, every element designed to make your brand unforgettable.", 'style' => 'dark'],
        ['icon' => 'mock-icon.png', 'title' => 'UX/UI Design', 'desc' => 'I design intuitive, user-centered interfaces that are as beautiful as they are functional — turning ideas into seamless digital experiences.', 'style' => 'dark'],
        ['icon' => 'graphic-icon.png', 'title' => 'Other Graphic Design', 'desc' => 'I create visually compelling graphics that communicate your message clearly and leave a lasting impression across any medium.', 'style' => 'light'],
    ];
@endphp

<div class="mx-auto max-w-6xl px-6 py-16 text-center">
    <h2 class="text-4xl font-extrabold text-[#1A1A18]">Creative Design Services</h2>
    <p class="mx-auto mt-3 max-w-2xl text-sm text-gray-600">
        I craft visuals that don't just look good — they communicate. From building brand identities to
        designing seamless digital interfaces, every design decision I make is intentional, creative, and
        tailored to your needs.
    </p>

    <div class="mt-10 grid grid-cols-1 gap-6 text-left md:grid-cols-3">
        @foreach ($creativeServices as $service)
            @php
                $isDark = $service['style'] === 'dark';
            @endphp
            <div class="flex flex-col rounded-2xl p-6 {{ $isDark ? 'bg-[#00224D] text-white' : 'border border-gray-200 bg-white text-[#1A1A18]' }}">
                <div class="mb-4 grid h-14 w-14 place-items-center rounded-full border-2 {{ $isDark ? 'border-white' : 'border-[#00224D]' }}">
                    <img src="{{ asset('images/assets/icons/' . $service['icon']) }}" alt="{{ $service['title'] }}" class="h-6 w-6 object-contain {{ $isDark ? 'invert' : '' }}">
                </div>
                <h3 class="text-xl font-bold">{{ $service['title'] }}</h3>
                <p class="mt-2 text-sm {{ $isDark ? 'text-blue-100' : 'text-gray-600' }}">{{ $service['desc'] }}</p>
                <a href="#" class="mt-6 inline-block self-start rounded-lg {{ $isDark ? 'bg-[#FFC30B] text-[#1A1A18]' : 'bg-[#00224D] text-[#FFC30B]' }} px-5 py-2.5 text-sm font-semibold hover:opacity-90">
                    See More Details
                </a>
            </div>
        @endforeach
    </div>
</div>
