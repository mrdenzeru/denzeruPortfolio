@php
    $blogs = [
        ['title' => 'Why Good Design is More Than Just Looking Pretty', 'category' => 'Design', 'date' => 'March 12, 2025', 'excerpt' => 'A lot of people think design is all about making things look beautiful — but there\'s so much more to it. Good design solves problems, guides users, and communicates a message without saying a word...'],
        ['title' => 'Building a Personal Brand as a Designer and Developer', 'category' => 'Development', 'date' => 'February 28, 2025', 'excerpt' => 'One of the biggest challenges in any project is bridging the gap between a design mockup and the final built product. Here\'s how I personally approach that transition to make sure nothing gets...'],
    ];
@endphp

<section class="mx-auto max-w-6xl px-6 py-16">
    <h3 class="text-sm font-semibold text-gray-900">My Blogs</h3>
    <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2">
        @foreach ($blogs as $blog)
            <div class="flex gap-4 rounded-2xl border border-gray-200 bg-white p-4">
                <div class="h-28 w-28 shrink-0 rounded-lg bg-gray-300"></div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-900">{{ $blog['title'] }}</h4>
                    <p class="mt-1 text-xs text-gray-500">Category: {{ $blog['category'] }}</p>
                    <p class="text-xs text-gray-400">{{ $blog['date'] }}</p>
                    <p class="mt-2 text-xs text-gray-500">{{ $blog['excerpt'] }}</p>
                    <a href="#" class="mt-3 inline-block rounded-lg bg-yellow-400 px-3 py-1.5 text-xs font-semibold text-gray-900 hover:bg-yellow-300">
                        Read More
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>
