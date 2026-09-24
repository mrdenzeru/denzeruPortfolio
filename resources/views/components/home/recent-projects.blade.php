@php
    $filters = ['All', 'Web Design', 'Graphics', 'Video', 'Photography'];
    $projects = [
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
    ];
@endphp

<div id="recent-works" class="relative overflow-hidden bg-[#00224D] px-6 py-16 text-center text-white">
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

        <div class="works-anim mt-6 flex flex-wrap justify-center gap-2 opacity-0">
            @foreach ($filters as $i => $filter)
                <button
                    class="rounded-full px-4 py-1.5 text-xs font-bold {{ $i === 0 ? 'bg-yellow-400 text-gray-900' : 'bg-white/10 text-white hover:bg-white/20' }}">
                    {{ $filter }}
                </button>
            @endforeach
        </div>

        <div class="mx-auto mt-10 grid max-w-4xl grid-cols-1 gap-8 text-left sm:grid-cols-2">
            @foreach ($projects as $project)
                <div class="works-anim opacity-0">
                    <div class="aspect-video w-full rounded-lg bg-white"></div>
                    <h3 class="mt-3 text-sm font-semibold">{{ $project['title'] }}</h3>
                    <p class="mt-1 text-xs text-blue-100">{{ $project['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <a href="#" class="works-anim mt-10 inline-block rounded-lg bg-yellow-400 px-6 py-2.5 text-sm font-semibold text-gray-900 opacity-0 hover:bg-yellow-300">
            View All Works
        </a>
    </div>
</div>
