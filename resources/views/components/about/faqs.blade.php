@php
    $faqs = collect([
        ['q' => 'What services do you offer?', 'a' => 'I offer a range of creative and technical services including UI/UX design, graphic design, brand identity, web development, and prototype creation — delivering end-to-end solutions from concept to launch.'],
        ['q' => 'Are you available for freelance or full-time opportunities?', 'a' => "Yes, I'm open to both freelance projects and full-time roles — depending on the opportunity and fit."],
        ['q' => 'Can I see examples of your previous work?', 'a' => 'Absolutely — check out the Projects page for a full look at my recent work.'],
        ['q' => 'What services do you offer?', 'a' => 'I offer a range of creative and technical services including UI/UX design, graphic design, brand identity, web development, and prototype creation.'],
        ['q' => 'How can I get in touch with you?', 'a' => "You can reach me directly through the contact form below, or email me at ddaveutrera23@gmail.com."],
        ['q' => 'How does your design and development process work?', 'a' => 'I start with understanding your goals, move into design mockups, then build and refine until the final product is polished and functional.'],
        ['q' => 'Can I see examples of your previous work?', 'a' => 'Absolutely — check out the Projects page for a full look at my recent work.'],
        ['q' => 'Are you open to collaborations?', 'a' => "Yes, I love collaborating with other creatives, developers, and teams. If you have an exciting project or idea in mind, don't hesitate to reach out — let's create something great together!"],
    ]);
    $half = ceil(count($faqs) / 2);
@endphp

<div class="mx-auto max-w-6xl px-6 py-16">
    <h2 class="text-4xl font-extrabold text-[#1A1A18]">FAQs</h2>
    <p class="mt-2 text-sm text-gray-600">Any Question? These are the Answers.</p>

    <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2">
        @foreach ([$faqs->slice(0, $half), $faqs->slice($half)] as $column)
            <div class="space-y-3">
                @foreach ($column as $faq)
                    <details class="group rounded-xl border border-gray-200 p-4">
                        <summary class="flex cursor-pointer list-none items-center justify-between text-sm font-semibold text-[#1A1A18]">
                            {{ $faq['q'] }}
                            <span class="ml-4 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full border border-gray-300 text-xs group-open:rotate-180">⌄</span>
                        </summary>
                        <p class="mt-3 text-sm text-gray-600">{{ $faq['a'] }}</p>
                    </details>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
