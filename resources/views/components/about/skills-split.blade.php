@php
    // Add/adjust items freely. `level` drives the progress bar fill (0-100).
    // `logo` should point to an icon image in public/images/icons/{name}.svg (or .png).
    // If a logo file doesn't exist yet, the tool's initials are shown instead.
    $developerTools = [
        ['name' => 'Laravel', 'level' => 90],
        ['name' => 'Filament', 'level' => 88],
        ['name' => 'Livewire', 'level' => 85],
        ['name' => 'Tailwind CSS', 'level' => 92],
        ['name' => 'Blade', 'level' => 90],
        ['name' => 'JavaScript', 'level' => 75],
        ['name' => 'MySQL', 'level' => 80],
        ['name' => 'Git', 'level' => 78],
        ['name' => 'PHP', 'level' => 85],
    ];

    $designerTools = [
        ['name' => 'Figma', 'level' => 88],
        ['name' => 'Photoshop', 'level' => 85],
        ['name' => 'Illustrator', 'level' => 80],
        ['name' => 'After Effects', 'level' => 70],
        ['name' => 'Canva', 'level' => 90],
        ['name' => 'Adobe XD', 'level' => 75],
    ];
@endphp

<div
    id="skills"
    x-data="{ activeTab: 'developer' }"
    x-init="$nextTick(() => window.animateSkillBars && window.animateSkillBars('#dev-skills-grid'))"
    class="relative h-[554px] overflow-hidden bg-[#00224D] px-6 py-16 text-white"
>
    {{-- subtle background texture, optional --}}
    <div
        class="pointer-events-none absolute inset-0 bg-cover bg-center opacity-5"
        style="background-image: url('{{ asset('images/assets/background/texture-bg.jpg') }}')"
    ></div>

    <div class="skills-anim relative z-10 mx-auto max-w-5xl text-center">
        <p class="text-xs font-semibold uppercase tracking-widest text-[#FFC30B]">My Skills</p>
        <h2 class="mt-2 text-3xl font-extrabold md:text-4xl">Technologies I Master</h2>
        <p class="mx-auto mt-3 max-w-xl text-sm text-blue-100">
            A snapshot of the tools and technologies I use to design, build, and ship projects
            end-to-end.
        </p>

        {{-- Tab toggle --}}
        <div class="mt-8 inline-flex overflow-hidden rounded-full border border-white/30">
            <button
                type="button"
                @click="activeTab = 'developer'; $nextTick(() => window.animateSkillBars && window.animateSkillBars('#dev-skills-grid'))"
                :class="activeTab === 'developer' ? 'bg-[#FFC30B] text-[#1A1A18]' : 'text-white'"
                class="px-6 py-2 text-sm font-semibold transition-colors"
            >
                Developer Tools
            </button>
            <button
                type="button"
                @click="activeTab = 'designer'; $nextTick(() => window.animateSkillBars && window.animateSkillBars('#designer-skills-grid'))"
                :class="activeTab === 'designer' ? 'bg-[#FFC30B] text-[#1A1A18]' : 'text-white'"
                class="px-6 py-2 text-sm font-semibold transition-colors"
            >
                Designer Tools
            </button>
        </div>
    </div>

    {{-- Developer grid --}}
    <div
        id="dev-skills-grid"
        x-show="activeTab === 'developer'"
        x-cloak
        class="relative z-10 mx-auto mt-12 grid max-w-5xl grid-cols-1 gap-x-10 gap-y-6 md:grid-cols-3"
    >
        @foreach ($developerTools as $tool)
            <div class="skills-anim flex items-center gap-4">
                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-gray-100 text-xs font-bold text-[#00224D]">
                    @php
                        $iconPath = 'images/icons/' . \Illuminate\Support\Str::slug($tool['name']) . '.svg';
                    @endphp
                    @if(file_exists(public_path($iconPath)))
                        <img src="{{ asset($iconPath) }}" alt="{{ $tool['name'] }}" class="h-6 w-6">
                    @else
                        {{ \Illuminate\Support\Str::of($tool['name'])->substr(0, 2)->upper() }}
                    @endif
                </div>
                <div class="flex-1">
                    <div class="mb-1 flex items-center justify-between text-sm font-semibold">
                        <span>{{ $tool['name'] }}</span>
                        <span class="text-xs font-normal text-blue-100">{{ $tool['level'] }}%</span>
                    </div>
                    <div class="h-2 w-full overflow-hidden rounded-full bg-white/20">
                        <div
                            class="skill-bar-fill h-full rounded-full bg-[#FFC30B]"
                            data-level="{{ $tool['level'] }}"
                            style="width: {{ $tool['level'] }}%"
                        ></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Designer grid --}}
    <div
        id="designer-skills-grid"
        x-show="activeTab === 'designer'"
        x-cloak
        class="relative z-10 mx-auto mt-12 grid max-w-5xl grid-cols-1 gap-x-10 gap-y-6 md:grid-cols-3"
    >
        @foreach ($designerTools as $tool)
            <div class="skills-anim flex items-center gap-4">
                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-gray-100 text-xs font-bold text-[#00224D]">
                    @php
                        $iconPath = 'images/icons/' . \Illuminate\Support\Str::slug($tool['name']) . '.svg';
                    @endphp
                    @if(file_exists(public_path($iconPath)))
                        <img src="{{ asset($iconPath) }}" alt="{{ $tool['name'] }}" class="h-6 w-6">
                    @else
                        {{ \Illuminate\Support\Str::of($tool['name'])->substr(0, 2)->upper() }}
                    @endif
                </div>
                <div class="flex-1">
                    <div class="mb-1 flex items-center justify-between text-sm font-semibold">
                        <span>{{ $tool['name'] }}</span>
                        <span class="text-xs font-normal text-blue-100">{{ $tool['level'] }}%</span>
                    </div>
                    <div class="h-2 w-full overflow-hidden rounded-full bg-white/20">
                        <div
                            class="skill-bar-fill h-full rounded-full bg-[#FFC30B]"
                            data-level="{{ $tool['level'] }}"
                            style="width: {{ $tool['level'] }}%"
                        ></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
