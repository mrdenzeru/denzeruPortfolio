@php
    $experiences = [
        [
            'period' => 'October 2025 - Present | Full-Time',
            'title' => 'Web System Developer',
            'org' => 'RNP Jewelry & Metalcrafts, Inc.',
            'desc' => [
                '<span class="font-bold">Designed and Developed</span> the company website based on the client\'s vision, delivering a polished online presence that reflects the brand identity and drives customer engagement.',
                'Built a <span class="font-bold">full-featured Admin Panel</span> for an internal <span class="font-bold">Production Management System</span> — covering <span class="font-bold">job order tracking, payment processing, order management, delivery tracking, and multi-branch support</span> — with a centralized dashboard that streamlines operations and gives the team end-to-end visibility into production workflows.',
            ],
        ],
        [
            'period' => 'June 2024 - July 2025 | Full-Time',
            'title' => 'Front-End Developer & Creative Multimedia Editor',
            'org' => 'CreativeDevLabs Innovative IT Solutions',
            'desc' => [
                '<span class="font-bold">Developed and maintained front-end interfaces</span> using HTML, CSS, Tailwind, and JavaScript, translating UI/UX designs into responsive, functional web pages.',
                '<span class="font-bold">Designed UI/UX mockups</span> for systems and applications using Figma.',
                'Created social media graphics, layouts, and video graphics for various campaigns.',
                '<span class="font-bold">Developed branding assets</span> tailored for real estate agent clients.',
                'Applied strong creative and development skills with a focus on visual storytelling.',
                'Served as <span class="font-bold">Multimedia Specialist</span> for Miss Maasin City 2024 and Miss Frecor 2025.',
            ],
        ],
        [
            'period' => 'Sept 2024 - Oct 2024 | Contract',
            'title' => 'Creative Director',
            'org' => 'Miss MLG College of Learning 2024',
            'desc' => [
                '<span class="font-bold">Designed and Developed</span> the company website based on the client\'s vision, delivering a polished online presence that reflects the brand identity and drives customer engagement.',
                'Built a <span class="font-bold">full-featured Admin Panel</span> for an internal <span class="font-bold">Production Management System</span> — covering <span class="font-bold">job order tracking, payment processing, order management, delivery tracking, and multi-branch support</span> — with a centralized dashboard that streamlines operations and gives the team end-to-end visibility into production workflows.',
            ],
        ],
        [
            'period' => 'Feb 2024 - May 2024 | Contract',
            'title' => 'Web Developer and UI/UX Designer',
            'org' => 'Online Reservation Catering System',
            'desc' => [
                '<span class="font-bold">Developed and maintained</span> user interfaces using HTML, CSS/Tailwind CSS, JavaScript, and Laravel, ensuring responsive and cross-browser compatible designs for an optimal user experience.',
                '<span class="font-bold">Served as Project Manager</span>, leading the front-end design process — from creating mockup designs to implementing them through clean and efficient code.',
            ],
        ],
        [
            'period' => 'March 2021 - Jan 2024 | Freelance',
            'title' => 'Junior Multimedia Specialist',
            'org' => 'CreativeDevLabs Innovative IT Solutions',
            'desc' => [
                '<span class="font-bold">Captured and edited video content</span>, ensuring high-quality footage during shoots and incorporating visual and motion graphics to enhance the final output.',
                '<span class="font-bold">Provided technical support and troubleshooting</span> during live events, ensuring smooth execution and minimal disruptions in real-time production.',
            ],
        ],
    ];
@endphp

{{-- Outer tall wrapper controls scroll distance --}}
<div id="exp-track" class="h-[500px] relative mb-30">
    <section class="sticky top-50 w-full px-[200px]">
        <div class="grid grid-cols-1 items-center gap-10 md:grid-cols-2 md:gap-16">
            {{-- Left --}}
            <div>
                <p class="text-xl font-bold text-[#1A1A18]">My Experiences</p>
                <h2 class="mt-1 text-6xl font-extrabold text-[#00224D]">Where have I been.</h2>
                <p class="mt-4 max-w-xl text-lg font-medium text-[#1A1A18]">
                    A look at the roles and projects that shaped my skills as a designer and developer —
                    scroll to explore each one.
                </p>
            </div>

            {{-- Right: card box --}}
            <div id="exp-box" class="relative w-full transition-[height] duration-500 ease-out">
                @foreach ($experiences as $i => $exp)
                    <div class="exp-step absolute inset-x-0 top-0 opacity-0" data-index="{{ $i }}">
                        {{--
                            Each circle gets its own data-factor-x / data-factor-y.
                            These are the multipliers applied to the cursor offset in app.js —
                            different signs = opposite directions, different magnitudes = faster/slower drift.
                        --}}
                        <span
                            class="exp-circle absolute -left-10 -top-10 h-[174px] w-[174px] rounded-full bg-[#FFC30B]"
                            data-factor-x="0.5"
                            data-factor-y="0.35"
                        ></span>
                        <span
                            class="exp-circle absolute right-15 -top-10 h-[153px] w-[153px] rounded-full bg-[#FFC30B]"
                            data-factor-x="-0.35"
                            data-factor-y="0.5"
                        ></span>
                        <span
                            class="exp-circle absolute z-6 -right-25 top-1/3 h-[122px] w-[122px] rounded-full bg-[#FFC30B]"
                            data-factor-x="0.6"
                            data-factor-y="-0.4"
                        ></span>
                        <span
                            class="exp-circle absolute z-6 -bottom-18 left-14 h-[101px] w-[101px] rounded-full bg-[#FFC30B]"
                            data-factor-x="-0.55"
                            data-factor-y="-0.6"
                        ></span>

                        <div class="relative ml-4 rounded-2xl bg-white p-10 shadow-lg z-5">
                            <p class="text-lg font-extrabold text-[#1A1A18]">{{ $exp['period'] }}</p>
                            <h3 class="mt-1 text-4xl font-extrabold text-[#1A1A18]">{{ $exp['title'] }}</h3>
                            <p class="text-lg font-semibold text-[#1A1A18]">{{ $exp['org'] }}</p>
                            <ul class="mt-3 space-y-2 text-sm font-medium text-[#1A1A18]">
                                @foreach ($exp['desc'] as $point)
                                    <li class="flex gap-2">
                                        <span class="mt-1.5 h-1 w-1 flex-shrink-0 rounded-full bg-[#1A1A18]"></span>
                                        <span>{!! $point !!}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
