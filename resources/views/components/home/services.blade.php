@php
    $services = [
        [
            'icon' => 'graphic-icon.png',
            'title' => 'Graphic Design',
            'desc' => 'I design thoughtful, user-centered products that balance aesthetics and functionality. Every detail is intentional — creating experiences...'
        ],
        [
            'icon' => 'brand-icon.png',
            'title' => 'Branding Designer',
            'desc' => "I craft cohesive brand identities that tell your story at a glance. From logo design to full visual systems — including typography, color, and brand ...."
        ],
        [
            'icon' => 'mock-icon.png',
            'title' => 'UX/UI Mockup Designer',
            'desc' => 'I transform ideas and concepts into polished, interactive mockups that bring your vision to life before development begins. Every layout...'
        ],
        [
            'icon' => 'dev-icon.png',
            'title' => 'Web Development',
            'desc' => 'I develop clean, scalable, and high-performing web applications and systems tailored to your needs, with both a developer\'s precision...'
        ],
    ];
@endphp

<div id="services" class="w-full px-[300px] py-16 pb-20">
    <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-center">
        <div class="services-anim opacity-0">
            <p class="mb-2 text-medium font-semibold text-[#1A1A18]">
                What I Offer?
            </p>
            <h2 class="mt-1 text-5xl font-extrabold text-[#1A1A18] sm:text-4xl">
                My Services
            </h2>
            <p class="mt-1 max-w-xl text-md text-[#1A1A18]">
                From crafting beautiful visuals to building reliable systems,
                here's what I can do to help your project succeed.
            </p>
        </div>

        <a href="#"
           class="services-anim flex items-center gap-3 rounded-full bg-[#00224D] py-1.5 pl-5 pr-1.5 text-sm font-semibold text-white opacity-0">
            View All Services
            <span class="grid h-8 w-8 place-items-center rounded-full bg-white text-blue-900">→</span>
        </a>
    </div>

    <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($services as $service)
            <div class="services-anim flex flex-col items-center rounded-2xl bg-white p-6 text-center opacity-0 shadow-md">
                <div class="mb-6 grid h-20 w-20 place-items-center">
                    <img src="{{ asset('images/assets/icons/' . $service['icon']) }}" alt="{{ $service['title'] }}" class="h-22 w-22 object-contain">
                </div>
                <h3 class="font-extrabold text-xl text-[#1A1A18]">{{ $service['title'] }}</h3>
                <p class="mt-2 mb-5 text-sm font-medium text-[#1A1A18]">{{ $service['desc'] }}</p>
                <a href="#"
                class="w-full mt-auto inline-block self-center rounded-lg bg-[#FFC30B] px-10 py-3 text-sm font-semibold text-[#1A1A18] hover:bg-[#00224D] hover:text-white">
                    Read More
                </a>
            </div>
        @endforeach
    </div>
</div>
