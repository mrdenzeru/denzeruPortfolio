<div class="fixed inset-0 z-[9999] flex flex-col items-center justify-center gap-6 bg-[#00224D] px-8 text-center text-white md:hidden">

    @php
        // Add/remove image paths here — the carousel auto-cycles through whatever's in this array.
        $underConstructionImages = [
            asset('images/assets/profiles/underconstruction.png'),
            asset('images/assets/profiles/underconstruction-2.jpg'),
        ];
    @endphp

    {{-- Under-construction illustration carousel --}}
    <div
        x-data="{
            images: @js($underConstructionImages),
            active: 0,
            init() {
                setInterval(() => {
                    this.active = (this.active + 1) % this.images.length;
                }, 1000);
            },
        }"
        class="grid w-40 h-40 max-w-[60vw] justify-items-center"
    >
        <template x-for="(img, i) in images" :key="i">
            <img
                :src="img"
                alt="Under construction"
                x-show="active === i"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="[grid-area:1/1] w-full h-auto object-contain"
            >
        </template>
    </div>

    <div>
        <p class="text-xs font-semibold uppercase tracking-widest text-[#FFC30B]">Under Construction</p>
        <h1 class="mt-2 text-2xl font-extrabold">Best Viewed on Desktop</h1>
    </div>

    <p class="max-w-xs text-sm text-blue-100">
        This site's mobile version is still being built. Please open it on a PC or laptop for the full
        experience in the meantime.
    </p>

    <p class="text-xs text-blue-200/70">— Denzeru</p>
</div>
