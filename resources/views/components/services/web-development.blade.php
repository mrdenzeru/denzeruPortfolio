@php
    $webServices = [
        ['title' => 'Website Development', 'desc' => 'I develop clean, responsive websites from the ground up — making sure your site looks great and performs flawlessly on any device.', 'hasImage' => true],
        ['title' => 'Admin Panel & Dashboard', 'desc' => 'I build intuitive admin systems and dashboards that simplify your workflow, giving you full control over your data and operations behind the scenes.', 'hasImage' => false],
        ['title' => 'Maintenance & Support', 'desc' => "Already have a site? I help keep it running smoothly — fixing bugs, updating content, and making sure everything stays fast and secure.", 'hasImage' => false],
    ];
@endphp

<div class="relative overflow-hidden bg-[#00224D] px-6 py-16 text-white">
    <div class="pointer-events-none absolute inset-0 bg-cover bg-center opacity-5"
         style="background-image: url('{{ asset('images/assets/background/texture-bg.jpg') }}')"></div>

    <div class="relative z-10 mx-auto max-w-6xl">
        <h2 class="text-4xl font-extrabold">Web Development Services</h2>
        <p class="mt-3 max-w-2xl text-sm text-blue-100">
            I do my best to build websites that are clean, responsive, and easy to use — focusing on
            creating something that genuinely works well for the people who need it.
        </p>

        <div class="mt-10 grid grid-cols-1 gap-6 text-left md:grid-cols-3">
            @foreach ($webServices as $service)
                <div class="flex flex-col rounded-2xl bg-white p-6 text-[#1A1A18]">
                    @if ($service['hasImage'])
                        <div class="mb-4 aspect-video w-full rounded-lg bg-gray-300"></div>
                    @else
                        <div class="mb-4 h-16 w-16 rounded-full bg-gray-300"></div>
                    @endif
                    <h3 class="text-xl font-bold">{{ $service['title'] }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ $service['desc'] }}</p>
                    <a href="#" class="mt-auto inline-block self-start rounded-lg bg-[#00224D] px-5 py-2.5 pt-6 text-sm font-semibold text-[#FFC30B] hover:opacity-90">
                        See More Details
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
