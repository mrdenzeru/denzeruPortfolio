@php
    $services = [
        [
            'icon' => '🧊',
            'title' => 'Graphic Design',
            'desc' => 'I design thoughtful, user-centered products that balance aesthetics and functionality. Every detail is intentional — creating experiences...'
        ],

        [
            'icon' => '✒️',
            'title' => 'Branding Designer',
            'desc' => "I craft cohesive brand identities that tell your story at a glance. From logo design to full visual systems — including typography, color, and brand..."
        ],

        [
            'icon' => '🎨',
            'title' => 'UX/UI Mockup Designer',
            'desc' => 'I transform ideas and concepts into polished, interactive mockups that bring your vision to life before development begins. Every layout...'
        ],

        [
            'icon' => '</>',
            'title' => 'Web Development',
            'desc' => 'I develop clean, scalable, and high-performing web applications and systems tailored to your needs, with both a developer\'s precision...'
        ],

    ];
@endphp

<section id="services" class="mx-auto max-w-6xl px-6 py-16 text-center">
    <p class="text-sm text-gray-500">What I Offer?</p>
    <h2 class="mt-1 text-3xl font-bold text-gray-900">My Services</h2>
    <p class="mx-auto mt-3 max-w-xl text-sm text-gray-500">
        From crafting beautiful visuals to building reliable systems, here's what I can do to help your
        project succeed.
    </p>

    <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($services as $service)
            <div class="rounded-2xl border border-gray-200 bg-white p-6 text-left">
                <div class="mb-4 grid h-12 w-12 place-items-center rounded-full border-2 border-blue-600 text-xl">
                    {{ $service['icon'] }}
                </div>
                <h3 class="font-semibold text-gray-900">{{ $service['title'] }}</h3>
                <p class="mt-2 text-xs text-gray-500">{{ $service['desc'] }}</p>
                <a href="#"
                   class="mt-4 inline-block rounded-lg bg-yellow-400 px-4 py-2 text-xs font-semibold text-gray-900 hover:bg-yellow-300">
                    Read More
                </a>
            </div>
        @endforeach
    </div>
</section>
