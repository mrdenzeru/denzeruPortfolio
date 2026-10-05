<x-layouts.app>
    <x-about.hero />
    <x-about.experience />
    <x-about.skills-split />
    <x-about.education />
    <x-about.also-part-of-me />
    <x-about.second-wind />
    <x-about.faqs />

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/animejs@4/lib/anime.umd.min.js"></script>
        <script src="{{ asset('js/front-end/animate/about.js') }}" defer></script>
    @endpush

</x-layouts.app>
