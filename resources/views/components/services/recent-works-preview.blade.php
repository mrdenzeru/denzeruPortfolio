@php
    $projects = [
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
        ['title' => 'Project Title', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dui ligula, malesuada vel convallis in.'],
    ];
@endphp

<div class="mx-auto max-w-4xl px-6 py-16 text-center">
    <h2 class="text-4xl font-extrabold text-[#1A1A18]">Check Out my Recent Works</h2>
    <p class="mt-2 text-sm text-gray-600">Any Question? These are the Answers.</p>

    <div class="mt-10 grid grid-cols-1 gap-8 text-left sm:grid-cols-2">
        @foreach ($projects as $project)
            <div>
                <div class="aspect-video w-full rounded-lg bg-gray-300"></div>
                <h3 class="mt-3 text-sm font-semibold text-[#1A1A18]">{{ $project['title'] }}</h3>
                <p class="mt-1 text-xs text-gray-500">{{ $project['desc'] }}</p>
            </div>
        @endforeach
    </div>

    <a href="{{ url('/projects') }}" class="mt-10 inline-block rounded-lg bg-[#00224D] px-10 py-3 text-sm font-semibold text-[#FFC30B] hover:opacity-90">
        Go to Projects
    </a>
</div>
