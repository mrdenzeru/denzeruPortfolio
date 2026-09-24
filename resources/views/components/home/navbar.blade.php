<header class="sticky top-0 z-50 w-full bg-[#f7f5f0]/80 px-[100px] backdrop-blur-md">
    <nav class="nav-anim flex w-full items-center justify-between py-4 pt-6 opacity-0">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/logo/denzeru-dark-tagline.png') }}" alt="denzeru" class="h-16 w-auto object-contain">
        </a>

        <div class="hidden items-center gap-8 font-bold text-sm text-[#1A1A18] md:flex">
            <a href="/projects" class="hover:text-gray-900">Projects</a>
            <a href="/services" class="hover:text-gray-900">Services</a>
            <a href="/about" class="hover:text-gray-900">About</a>
            <a href="#contact"
               class="rounded-lg bg-[#00224D] px-4 py-2 text-sm text-white hover:bg-[#FFC30B] hover:text-[#00224D]">
                Work with Me
            </a>
        </div>
    </nav>
</header>
