@php
    $education = [
        [
            'level' => 'Tertiary (2020 - 2024)',
            'school' => 'MLG College of Learning, Inc.',
            'details' => 'Bachelor of Science in Information Technology — GWA: 1.6',
        ],
        [
            'level' => 'Secondary (2014 - 2020) Jr & Sr High School',
            'school' => 'MLG College of Learning, Inc.',
            'details' => 'TVL - Information Communication Technology',
        ],
    ];
@endphp

<section class="mx-auto max-w-6xl px-6 py-16">
    <h2 class="text-4xl font-extrabold text-[#1A1A18]">Educational Background</h2>
    <p class="mt-2 text-sm text-gray-600">Where I built the foundation for design and development.</p>

    <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
        @foreach ($education as $edu)
            <div class="rounded-2xl border border-gray-200 bg-white p-6 text-left">
                <p class="text-xs font-bold uppercase tracking-wide text-[#00224D]">{{ $edu['level'] }}</p>
                <h3 class="mt-2 text-lg font-bold text-[#1A1A18]">{{ $edu['school'] }}</h3>
                <p class="mt-2 text-sm text-gray-600">{{ $edu['details'] }}</p>
            </div>
        @endforeach
    </div>
</section>
