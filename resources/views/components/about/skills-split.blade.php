@php
    // Logos live in public/images/assets/stack-logos/{folder}/{file}.
    // Filenames are case-sensitive on Linux servers, so they match your folders exactly.
    $logoBase = 'images/assets/stack-logos';

    // level: 3 = Daily driver, 2 = Comfortable, 1 = Learning
    $levelLabels = [3 => 'Daily driver', 2 => 'Comfortable', 1 => 'Learning'];

    // Each tab has groups. A group is either:
    //   'display' => 'detailed' : logo + name + level label
    //   'display' => 'logos'    : logo + name only
    $tabs = [
        'developer' => [
            'label' => 'Developer Tools',
            'groups' => [
                [
                    'title' => 'Core stack',
                    'display' => 'detailed',
                    'items' => [
                        ['name' => 'Laravel',      'level' => 3, 'logo' => 'developer/laravel.webp'],
                        ['name' => 'Filament',     'level' => 3, 'logo' => 'developer/Filament.png'],
                        ['name' => 'Livewire',     'level' => 3, 'logo' => 'developer/livewire.png'],
                        ['name' => 'Tailwind CSS', 'level' => 3, 'logo' => 'developer/tailwind-css.png'],
                        ['name' => 'PHP',          'level' => 3, 'logo' => 'developer/php.png'],
                        ['name' => 'HTML',         'level' => 3, 'logo' => 'developer/html.webp'],
                        ['name' => 'CSS',          'level' => 3, 'logo' => 'developer/css.webp'],
                        ['name' => 'JavaScript',   'level' => 2, 'logo' => 'developer/JS.webp'],
                    ],
                ],
                [
                    'title' => 'Also use',
                    'display' => 'detailed',
                    'items' => [
                        ['name' => 'MySQL',      'level' => 2, 'logo' => 'developer/mySQL.png'],
                        ['name' => 'Git',        'level' => 2, 'logo' => 'developer/git.png'],
                        ['name' => 'Bootstrap',  'level' => 2, 'logo' => 'developer/bootstrap.png'],
                    ],
                ],
                [
                    'title' => 'Environment',
                    'display' => 'logos',
                    'items' => [
                        ['name' => 'VS Code', 'logo' => 'developer/vs-code.png'],
                        ['name' => 'Node.js', 'logo' => 'developer/node-js.png'],
                        ['name' => 'npm',     'logo' => 'developer/npm.png'],
                        ['name' => 'XAMPP',   'logo' => 'developer/xampp.webp'],
                        ['name' => 'WAMP',    'logo' => 'developer/wamp.png'],
                        ['name' => 'cPanel',  'logo' => 'developer/cpanel.png'],
                    ],
                ],
            ],
        ],

        // design/ + motion/ folders
        'designer' => [
            'label' => 'Designer Tools',
            'groups' => [
                [
                    'title' => 'Core stack',
                    'display' => 'detailed',
                    'items' => [
                        ['name' => 'Figma',       'level' => 3, 'logo' => 'design/figma.png'],
                        ['name' => 'Photoshop',   'level' => 3, 'logo' => 'design/photoshop.png'],
                        ['name' => 'Canva',       'level' => 3, 'logo' => 'design/Canva.png'],
                    ],
                ],
                [
                    'title' => 'Also use',
                    'display' => 'detailed',
                    'items' => [
                        ['name' => 'After Effects', 'level' => 2, 'logo' => 'motion/after-effects.png'],
                        ['name' => 'Premiere Pro',  'level' => 3, 'logo' => 'motion/pre-pro.png'],
                        ['name' => 'Illustrator',   'level' => 2, 'logo' => 'design/illustrator.png'],
                        ['name' => 'Lightroom',     'level' => 2, 'logo' => 'design/lightroom.png'],
                    ],
                ],
                [
                    'title' => 'Familiar with',
                    'display' => 'logos',
                    'items' => [
                        ['name' => 'Adobe XD',     'logo' => 'design/adobe-xd.png'],
                        ['name' => 'InDesign',     'logo' => 'design/inDesign.png'],
                    ],
                ],
            ],
        ],

        // collaboration/ + others/ folders
        'workflow' => [
            'label' => 'Workflow & Platforms',
            'groups' => [
                [
                    'title' => null,
                    'display' => 'logos',
                    'items' => [
                        ['name' => 'Notion',       'logo' => 'collaboration/notion.png'],
                        ['name' => 'Asana',        'logo' => 'collaboration/asana.png'],
                        ['name' => 'Slack',        'logo' => 'collaboration/slackt.webp'],
                        ['name' => 'GitHub',       'logo' => 'others/gitHub.png'],
                        ['name' => 'Vercel',       'logo' => 'others/logo-vercel.png'],
                        ['name' => 'WordPress',    'logo' => 'others/wordpress.png'],
                        ['name' => 'GoDaddy',      'logo' => 'others/goDaddy.png'],
                        ['name' => 'Google Drive', 'logo' => 'others/google-drive.png'],
                        ['name' => 'ChatGPT',      'logo' => 'others/chatGPT.png'],
                        ['name' => 'Claude',       'logo' => 'others/Claude.webp'],
                    ],
                ],
            ],
        ],
    ];
@endphp

{{--
    Cover / overlap transition (Experience -> Skills):
      - margin-top: -100dvh pulls this track up over the last 100dvh of #exp-track, where Experience is still pinned.
      - z-10 + solid bg on #skills makes Skills slide up over Experience like a card.
      - Track height = 100dvh + hold. The hold (20dvh) is a short window where Skills stays pinned at full
        viewport height, so it has somewhere to rest instead of landing mid-cover.
        Set it to 100dvh for no hold, or 130dvh for a longer one.
    No ancestor of the sticky element may use overflow hidden/auto/scroll.
--}}
<div id="skills-track" class="relative z-10" style="height: 120dvh; margin-top: -100dvh;">
    <div
        id="skills"
        x-data="{ activeTab: 'developer', busy: false }"
        class="sticky top-0 flex flex-col justify-start overflow-hidden bg-[#00224D] px-6 pb-10 pt-28 text-white"
        style="height: 100dvh"
    >
        {{-- subtle background texture, optional --}}
        <div
            class="pointer-events-none absolute inset-0 bg-cover bg-center opacity-5"
            style="background-image: url('{{ asset('images/assets/background/texture-bg.jpg') }}')"
        ></div>

        <div class="skills-anim relative z-10 mx-auto w-full max-w-5xl text-center">
            <p class="text-xs font-semibold uppercase tracking-widest text-[#FFC30B]">My Skills</p>
            <h2 class="mt-2 text-3xl font-extrabold md:text-4xl">Technologies I Master</h2>
            <p class="mx-auto mt-3 max-w-xl text-sm text-blue-100">
                A snapshot of the tools and technologies I use to design, build, and ship projects
                end-to-end.
            </p>

            {{-- Tab toggle --}}
            <div class="mt-8 inline-flex flex-wrap justify-center overflow-hidden rounded-3xl border border-white/30 md:rounded-full">
                @foreach ($tabs as $key => $tab)
                    <button
                        type="button"
                        @click="
                            if (busy) return;
                            busy = true;
                            window.fadeOutSkills('#' + activeTab + '-skills-grid')
                                .then(() => {
                                    activeTab = '{{ $key }}';
                                    $nextTick(() => window.animateSkillBars('#{{ $key }}-skills-grid'));
                                })
                                .finally(() => { busy = false; });
                        "
                        :class="activeTab === '{{ $key }}' ? 'bg-[#FFC30B] text-[#1A1A18]' : 'text-white'"
                        class="px-6 py-2 text-sm font-semibold transition-colors"
                    >
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- One panel per tab --}}
        <div class="relative z-10 mx-auto mt-12 w-full max-w-5xl">
            @foreach ($tabs as $key => $tab)
                <div
                    id="{{ $key }}-skills-grid"
                    x-show="activeTab === '{{ $key }}'"
                    x-cloak
                    class="space-y-10"
                >
                    @foreach ($tab['groups'] as $group)
                        <div>
                            @if (! empty($group['title']))
                                <h3 class="skills-anim skill-name mb-4 text-sm font-semibold text-[#FFC30B]">{{ $group['title'] }}</h3>
                            @endif

                            @if ($group['display'] === 'detailed')
                                {{-- Logo + name + level label --}}
                                <div class="grid grid-cols-1 gap-x-10 gap-y-6 md:grid-cols-3">
                                    @foreach ($group['items'] as $tool)
                                        @php
                                            $logoPath = $logoBase . '/' . $tool['logo'];
                                            $label = $levelLabels[$tool['level']] ?? '';
                                        @endphp
                                        <div class="skills-anim flex items-center gap-4">
                                            <div class="skill-logo flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-gray-100 text-xs font-bold text-[#00224D]">
                                                @if (file_exists(public_path($logoPath)))
                                                    <img src="{{ asset($logoPath) }}" alt="" loading="lazy" class="h-7 w-7 object-contain">
                                                @else
                                                    {{ \Illuminate\Support\Str::of($tool['name'])->substr(0, 2)->upper() }}
                                                @endif
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="skill-name text-sm font-semibold">{{ $tool['name'] }}</div>
                                                <div class="mt-1 flex items-center gap-2">
                                                    <div class="flex gap-1" role="img" aria-label="{{ $label }}">
                                                        @for ($i = 1; $i <= 3; $i++)
                                                            <span class="skill-dot h-2 w-6 rounded-full {{ $i <= $tool['level'] ? 'skill-dot-on bg-[#FFC30B]' : 'bg-white/20' }}"></span>
                                                        @endfor
                                                    </div>
                                                    <span class="skill-name text-xs text-blue-100">{{ $label }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                {{-- Logo-only grid --}}
                                <div class="grid grid-cols-3 gap-x-4 gap-y-6 sm:grid-cols-4 md:grid-cols-6">
                                    @foreach ($group['items'] as $tool)
                                        @php $logoPath = $logoBase . '/' . $tool['logo']; @endphp
                                        <div class="skills-anim flex flex-col items-center gap-2 text-center">
                                            <div class="skill-logo flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-xs font-bold text-[#00224D]">
                                                @if (file_exists(public_path($logoPath)))
                                                    <img src="{{ asset($logoPath) }}" alt="" loading="lazy" class="h-8 w-8 object-contain">
                                                @else
                                                    {{ \Illuminate\Support\Str::of($tool['name'])->substr(0, 2)->upper() }}
                                                @endif
                                            </div>
                                            <span class="skill-name text-xs font-medium text-blue-100">{{ $tool['name'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
