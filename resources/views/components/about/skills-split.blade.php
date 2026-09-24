@php
    $designerTools = ['Canva', 'Photoshop', 'Illustrator', 'Figma', 'Adobe XD', 'InDesign'];
    $developerTools = ['Laravel', 'HTML', 'CSS', 'Tailwind CSS', 'VS CODE', 'JavaScript', 'React JS', 'Node JS', 'NPM', 'Git', 'cPanel', 'XAMPP Server', 'PHP', 'Filament', 'mySQL'];
@endphp

<div class="relative overflow-hidden bg-[#00224D] px-6 py-16 text-white">
    <div class="pointer-events-none absolute inset-0 bg-cover bg-center opacity-5"
         style="background-image: url('{{ asset('images/assets/background/texture-bg.jpg') }}')"></div>

    <div class="relative z-10 mx-auto grid max-w-5xl grid-cols-1 gap-10 md:grid-cols-2 md:gap-16">
        <div class="text-center md:text-left">
            <h2 class="text-5xl font-extrabold italic">designer</h2>
            <p class="mt-3 text-sm text-blue-100">
                I turn ideas into thoughtful, user-centered designs that are as beautiful as they are
                functional.
            </p>
            <div class="mt-6 flex flex-wrap justify-center gap-2 md:justify-start">
                @foreach ($designerTools as $tool)
                    <span class="rounded-md bg-[#FFC30B] px-3 py-1.5 text-xs font-semibold text-[#1A1A18]">{{ $tool }}</span>
                @endforeach
            </div>
        </div>

        <div class="text-center md:text-left">
            <h2 class="text-5xl font-extrabold italic">developer</h2>
            <p class="mt-3 text-sm text-blue-100">
                I bridge design and logic — building reliable, efficient solutions that work seamlessly
                behind the scenes.
            </p>
            <div class="mt-6 flex flex-wrap justify-center gap-2 md:justify-start">
                @foreach ($developerTools as $tool)
                    <span class="rounded-md bg-[#FFC30B] px-3 py-1.5 text-xs font-semibold text-[#1A1A18]">{{ $tool }}</span>
                @endforeach
            </div>
        </div>
    </div>
</div>
