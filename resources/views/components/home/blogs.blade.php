@php
    $blogs = [
        [
            'title' => 'Why Good Design is More Than Just Looking Pretty',
            'category' => 'Design',
            'date' => 'March 12, 2025',
            'excerpt' => 'A lot of people think design is all about making things look beautiful — but there\'s so
                much more to it. Good design solves problems, guides users, and communicates a message
                without saying a word...'
        ],

        [
            'title' => 'Building a Personal Brand as a Designer and Developer',
            'category' => 'Development',
            'date' => 'February 28, 2025',
            'excerpt' => 'One of the biggest challenges in any project is bridging the gap between a design
                mockup and the final built product. Here\'s how I personally approach that transition to
                make sure nothing gets...'
        ],
    ];
@endphp

<div id="blogs" class="w-full px-[150px] pt-16 pb-30">
    <h3 class="blogs-anim text-lg font-bold text-gray-900 opacity-0">My Blogs</h3>
    <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2">
        @foreach ($blogs as $blog)
            <div class="blogs-anim flex gap-4 rounded-2xl border border-gray-200 bg-white p-4 opacity-0">
                <div class="h-auto w-[50%] shrink-0 rounded-lg bg-gray-300"></div>
                <div class="fles flex-col gap-2">
                    <h4 class="text-xl font-extrabold text-[#1A1A18]">{{ $blog['title'] }}</h4>
                    <p class="mt-1 text-md font-bold text-[#1A1A18]">Category: {{ $blog['category'] }}</p>
                    <p class="text-xs font-medium text-[#1A1A18]">{{ $blog['date'] }}</p>
                    <p class="mt-2 text-sm text-[#1A1A18]">{{ $blog['excerpt'] }}</p>
                    <a href="#"
                        class="mt-3 w-full text-center inline-block rounded-lg bg-[#FFC30B] py-3 text-sm font-semibold text-[#1A1A18] hover:bg-[#00224D] hover:text-white">
                        Read More
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
