<x-layouts.app>
    <x-home.hero />
    <x-home.logo-cloud />
    <x-home.about />
    <x-home.services />
    <x-home.recent-projects />
    <x-home.testimonials />
    <x-home.blogs />

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/animejs@4/lib/anime.umd.min.js"></script>
        <script src="{{ asset('js/front-end/animate/home.js') }}" defer></script>
    @endpush

</x-layouts.app>
