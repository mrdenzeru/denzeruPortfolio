
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Denzeru — Design & Develop ' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-[#f7f5f0] text-[#111827] antialiased">

    {{-- Shown only below the md breakpoint (768px) --}}
    <x-underconstruction.mobile-block />

    {{-- Real site: hidden on mobile, shown from md and up --}}
    <div class="hidden md:block">
        <x-layouts.navbar />

        <main>
            {{ $slot }}
        </main>

        <x-layouts.footer />

        {{-- Back to top --}}
        <button
            id="back-to-top"
            type="button"
            aria-label="Back to top"
            data-visible="false"
            data-contrast="false"
            class="group fixed bottom-8 right-8 z-40 grid h-12 w-12 translate-y-4 cursor-pointer
                place-items-center overflow-hidden rounded-full bg-[#00224D] text-white opacity-0
                shadow-lg pointer-events-none transition-all duration-300 ease-out
                hover:bg-[#FFC30B] hover:text-[#00224D] data-[visible=true]:translate-y-0
                data-[visible=true]:opacity-100 data-[visible=true]:pointer-events-auto
                data-[contrast=true]:!bg-[#FFC30B] data-[contrast=true]:!text-[#00224D] data-[contrast=true]:hover:!bg-white"
        >
            {{-- Arrow rolls up on hover, same idea as the button text --}}
            <span class="relative block h-5 w-5 overflow-hidden">
                <svg class="absolute inset-0 h-5 w-5 transition-transform duration-300 ease-out group-hover:-translate-y-full" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l-6 6m6-6l6 6" />
                </svg>
                <svg class="absolute inset-0 h-5 w-5 translate-y-full transition-transform duration-300 ease-out group-hover:translate-y-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l-6 6m6-6l6 6" />
                </svg>
            </span>
        </button>
    </div>

    @stack('scripts')

</body>
</html>
