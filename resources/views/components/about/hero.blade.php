@php
    $stats = [
        ['label' => 'Placeholder'],
        ['label' => 'Placeholder'],
        ['label' => 'Placeholder'],
        ['label' => 'Placeholder'],
    ];
@endphp

<div class="mx-auto max-w-6xl px-6 py-16">
    <div class="grid grid-cols-1 items-center gap-10 md:grid-cols-2">
        <div class="aspect-square w-full max-w-sm rounded-2xl bg-gray-300"></div>

        <div>
            <h1 class="text-5xl font-extrabold italic text-[#00224D]">about me?</h1>
            <p class="mt-3 text-2xl font-bold text-[#1A1A18]">Name's Denzel Dave</p>
            <p class="mt-1 text-lg font-bold text-[#1A1A18]">
                A designer and developer who loves creating meaningful digital experiences.
            </p>
            <p class="mt-4 text-sm text-gray-600">
                For 3 years now, I've loved taking the complex and making it feel simple, beautiful, and
                easy to use. Outside of design, I find my balance in cooking good food, growing things,
                and moving my body outdoors.
            </p>

            <div class="hero-anim mt-8 flex flex-row justify-left gap-3 opacity-0">
                <a href="#contact" class="flex items-center rounded-lg bg-[#FFC30B] px-[40px] py-1 text-sm font-semibold text-gray-900 hover:bg-[#00224D] hover:text-white">
                    Work with Me
                </a>
                <a href="#resume" class="flex items-center rounded-lg px-5 py-1 text-sm font-semibold text-[#00224D]">
                    Get Resume
                    <span class="grid h-8 w-8 place-items-center rounded-full text-[#00224D]">→</span>
                </a>
            </div>
        </div>
    </div>

    <div class="mt-10 border-t border-[#00224D]"></div>

    <div class="mt-8 grid grid-cols-2 gap-4 md:grid-cols-4">
        @foreach ($stats as $stat)
            <div class="aspect-[4/2] rounded-lg bg-gray-300"></div>
        @endforeach
    </div>
</div>
