@php
    $filters = ['All', 'Web Design', 'Graphics', 'Video', 'Photography'];
    $projects = [
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
    ];
@endphp

<section class="bg-[#0F2A5C] px-6 py-16 text-center text-white">
    <p class="text-sm text-blue-200">Creative Projects</p>
    <h2 class="mt-1 text-3xl font-bold">Recent Works</h2>
    <p class="mx-auto mt-3 max-w-lg text-sm text-blue-100">
        Every project tells a story. Here's a glimpse of what I've been creating lately.
    </p>

    <div class="mt-6 flex flex-wrap justify-center gap-2">
        @foreach ($filters as $i => $filter)
            <button
                class="rounded-full px-4 py-1.5 text-xs font-medium {{ $i === 0 ? 'bg-yellow-400 text-gray-900' : 'bg-white/10 text-white hover:bg-white/20' }}">
                {{ $filter }}
            </button>
        @endforeach
    </div>

    <div class="mx-auto mt-10 grid max-w-4xl grid-cols-1 gap-8 text-left sm:grid-cols-2">
        @foreach ($projects as $project)
            <div>
                <div class="aspect-video w-full rounded-lg bg-white"></div>
                <h3 class="mt-3 text-sm font-semibold">{{ $project['title'] }}</h3>
                <p class="mt-1 text-xs text-blue-100">{{ $project['desc'] }}</p>
            </div>
        @endforeach
    </div>

    <a href="#" class="mt-10 inline-block rounded-lg bg-yellow-400 px-6 py-2.5 text-sm font-semibold text-gray-900 hover:bg-yellow-300">
        View All Works
    </a>
</section>
