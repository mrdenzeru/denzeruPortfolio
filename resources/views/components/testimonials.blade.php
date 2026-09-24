@php
    $testimonials = [
        ['name' => 'James Holloway', 'role' => 'CEO of NovaTech Solutions', 'quote' => 'Denzel\'s work completely transformed how our brand looks and feels online. His attention to detail and ability to understand our vision was impressive from day one.', 'rating' => 4, 'date' => 'January 18, 2026'],
        ['name' => 'Marcus L. Reid', 'role' => 'Founder of Elevate Digital', 'quote' => 'Working with Denzel was one of the best decisions we made for our product launch. He delivered a design that was clean, modern, and exactly what our users needed.', 'rating' => 5, 'date' => 'February 25, 2026'],
        ['name' => 'Adrian Cruz', 'role' => 'Managing Director of Corelink Ventures', 'quote' => 'Denzel doesn\'t just design — he thinks. He brought ideas to the table we hadn\'t even considered, and the results spoke for themselves.', 'rating' => 4, 'date' => 'March 30, 2026'],
    ];
@endphp

<div id="testimonials" class="w-full px-[150px] pt-20 text-center">
    <p class="testimonials-anim text-md font-bold text-[#1A1A18] opacity-0">Testimonials & Blogs</p>
    <h2 class="testimonials-anim mt-1 text-5xl font-extrabold text-[#1A1A18] opacity-0">Voices & Insights</h2>
    <p class="testimonials-anim mx-auto mt-3 max-w-2xl text-md text-[#1A1A18] opacity-0">
        See what others have to say about working with me, and explore some of my thoughts and insights
        through my latest blog posts.
    </p>

    <h3 class="testimonials-anim mt-12 text-left text-lg font-bold text-gray-900 opacity-0">My Clients Testimonials</h3>
    <div class="mt-4 grid grid-cols-1 gap-5 text-left sm:grid-cols-3">
        @foreach ($testimonials as $t)
            <div class="testimonials-anim flex flex-col rounded-2xl bg-white p-5 opacity-0 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="h-15 w-15 rounded-full bg-gray-300"></div>
                    <div>
                        <p class="text-lg font-semibold text-gray-900">{{ $t['name'] }}</p>
                        <p class="text-md text-gray-500">{{ $t['role'] }}</p>
                    </div>
                </div>
                <p class="mt-3 text-sm text-gray-600">&ldquo;{{ $t['quote'] }}&rdquo;</p>
                <div class="mt-auto flex items-center justify-between pt-3">
                    <span class="text-xl text-[#FFC30B]">{{ str_repeat('★', $t['rating']) }}{{ str_repeat('☆', 5 - $t['rating']) }}</span>
                    <span class="text-md font-semibold text-[#1A1A18]">{{ $t['date'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
