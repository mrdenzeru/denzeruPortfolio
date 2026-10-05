@php
    // 'All' is a special tab that shows every project. Other filters match a project's 'category' exactly.
    $filters = ['All', 'Web Design', 'Graphics', 'Video', 'Photography'];

    $projects = [
        ['title' => 'Project Title', 'category' => 'Web Design',  'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'category' => 'Graphics',    'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'category' => 'Video',       'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'category' => 'Photography', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
    ];

    // Filters that currently have no projects get an empty-state message instead of a blank grid.
    $emptyFilters = collect($filters)
        ->reject(fn ($filter) => $filter === 'All')
        ->filter(fn ($filter) => collect($projects)->where('category', $filter)->isEmpty())
        ->values();
@endphp

<div
    id="recent-works"
    x-data="{ activeTab: 'All', busy: false }"
    class="relative overflow-hidden bg-[#00224D] px-6 py-16 text-center text-white"
>
    <div
        class="pointer-events-none absolute inset-0 bg-cover bg-center opacity-2"
        style="background-image: url('{{ asset('images/assets/background/texture-bg.jpg') }}')">
    </div>

    <div class="relative z-10">
        <p class="works-anim text-sm font-bold text-white opacity-0">Recent Works</p>
        <h2 class="works-anim mt-1 text-5xl font-extrabold opacity-0">Fresh Off the Desk.</h2>
        <p class="works-anim mx-auto mt-3 max-w-xl text-sm text-blue-100 opacity-0">
            A look at the designs and builds I've been working on lately. Click any project to see how it came together.
        </p>

        {{-- Tab toggle (same pattern as the About page skills tabs) --}}
        <div class="works-anim mt-6 opacity-0">
            <div
                class="inline-flex flex-wrap justify-center overflow-hidden rounded-3xl border border-white/30 md:rounded-full"
                role="tablist"
                aria-label="Filter projects"
            >
                @foreach ($filters as $filter)
                    <button
                        type="button"
                        role="tab"
                        :aria-selected="activeTab === '{{ $filter }}'"
                        @click="
                            if (busy || activeTab === '{{ $filter }}') return;
                            busy = true;
                            window.fadeOutWorks('#works-grid')
                                .then(() => {
                                    activeTab = '{{ $filter }}';
                                    $nextTick(() => window.animateWorks('#works-grid'));
                                })
                                .finally(() => { busy = false; });
                        "
                        :class="activeTab === '{{ $filter }}' ? 'bg-[#FFC30B] text-[#1A1A18]' : 'text-white hover:bg-white/10'"
                        class="px-5 py-2 text-xs font-bold transition-colors"
                    >
                        {{ $filter }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- One grid; each card shows when its category matches the active tab (or the tab is 'All') --}}
        <div
            id="works-grid"
            class="mx-auto mt-10 grid max-w-4xl grid-cols-1 gap-8 text-left sm:grid-cols-2"
        >
            @foreach ($projects as $project)
                <div
                    class="work-card works-anim opacity-0"
                    x-show="activeTab === 'All' || activeTab === '{{ $project['category'] }}'"
                    x-cloak
                >
                    <div class="aspect-video w-full rounded-lg bg-white"></div>
                    <h3 class="mt-3 text-sm font-semibold">{{ $project['title'] }}</h3>
                    <p class="mt-1 text-xs text-blue-100">{{ $project['desc'] }}</p>
                </div>
            @endforeach

            @foreach ($emptyFilters as $filter)
                <p
                    class="col-span-full py-10 text-center text-sm text-blue-100"
                    x-show="activeTab === '{{ $filter }}'"
                    x-cloak
                >
                    No {{ strtolower($filter) }} projects yet. Check back soon.
                </p>
            @endforeach
        </div>

        <a href="#" class="works-anim mt-10 inline-block rounded-lg bg-yellow-400 px-6 py-2.5 text-sm font-semibold text-gray-900 opacity-0 hover:bg-yellow-300">
            View All Works
        </a>
    </div>
</div>
