<footer id="footer-contact" class="relative overflow-hidden bg-[#00224D] px-6 py-16 text-white">
    <div
        class="pointer-events-none absolute inset-0 bg-cover bg-center opacity-3"
        style="background-image: url('{{ asset('images/assets/background/texture-bg.jpg') }}')">
    </div>

    <div class="relative z-10">
        <div class="mx-auto grid max-w-5xl grid-cols-1 gap-12 md:grid-cols-2">
            <div class="footer-anim opacity-0">
                <h2 class="text-4xl font-extrabold">Got a project?</h2>
                <p class="text-2xl font-bold">Let's talk.</p>
                <p class="mt-4 font-bold text-sm text-white">Message me here:</p>
                <a href="mailto:hi@denzeru.com"
                   class="mt-2 inline-block rounded-lg bg-yellow-400 px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-yellow-300">
                    ddaveutrera23@gmail.com
                </a>
            </div>

            <form class="footer-anim space-y-4 opacity-0">
                <div>
                    <h2 class="text-4xl font-extrabold">Estimate your Project?</h2>
                    <p class="mt-1 text-2xl font-bold text-white">Let me know here.</p>
                </div>

                <input type="text" placeholder="What's your name?"
                    class="w-full rounded-xl border-0 bg-white px-5 py-4 text-base font-bold text-gray-900 placeholder:text-gray-400">

                <input type="email" placeholder="Your email address?"
                    class="w-full rounded-xl border-0 bg-white px-5 py-4 text-base font-bold text-gray-900 placeholder:text-gray-400">

                <div class="relative">
                    <textarea placeholder="Tell me about your project" rows="4"
                            class="w-full rounded-xl border-0 bg-white px-5 pt-4 pb-10 text-base font-bold text-gray-900 placeholder:text-gray-400"></textarea>

                    <input type="file" name="attachment" id="project-attachment" class="hidden"
                        onchange="
                            const label = document.getElementById('attachment-label');
                            const removeBtn = document.getElementById('remove-attachment');
                            if (this.files[0]) {
                                label.textContent = this.files[0].name;
                                label.style.maxWidth = '20rem';
                                label.style.opacity = '1';
                                removeBtn.classList.remove('hidden');
                            } else {
                                label.textContent = 'Attach File';
                                label.style.maxWidth = '';
                                label.style.opacity = '';
                                removeBtn.classList.add('hidden');
                            }
                        ">

                    <div class="absolute bottom-3 left-4 flex items-center gap-2">
                        <label for="project-attachment"
                            class="group flex cursor-pointer items-center gap-2 py-2 text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 flex-shrink-0">
                                <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
                            </svg>
                            <span id="attachment-label" class="max-w-0 overflow-hidden whitespace-nowrap text-xs font-bold opacity-0 transition-all duration-300 group-hover:max-w-xs group-hover:opacity-100">
                                Attach File
                            </span>
                        </label>

                        <button type="button" id="remove-attachment"
                                class="hidden text-gray-400 hover:text-red-500"
                                onclick="
                                    const input = document.getElementById('project-attachment');
                                    input.value = '';
                                    input.dispatchEvent(new Event('change'));
                                ">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                        class="rounded-lg bg-yellow-400 px-6 py-2.5 text-sm font-semibold text-gray-900 hover:bg-yellow-300">
                    Submit
                </button>
            </form>
        </div>

        <div class="footer-anim mx-auto mt-20 max-w-5xl text-center opacity-0">
            <div class="mx-auto grid place-items-center">
                <img src="{{ asset('images/logo/emblem-logo.png') }}" alt="Denzeru" class="h-15 w-15 object-contain">
            </div>
            <p class="mt-4 text-sm font-bold text-white">Thanks for scrolling, that's all folks.</p>
            <div class="mt-4 flex justify-center gap-3">
                <a href="#" aria-label="Facebook" class="grid h-8 w-8 place-items-center rounded-full bg-white/10 text-white hover:bg-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.51 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.91h-2.34V22c4.78-.76 8.44-4.92 8.44-9.94z"/>
                    </svg>
                </a>
                <a href="#" aria-label="Instagram" class="grid h-8 w-8 place-items-center rounded-full bg-white/10 text-white hover:bg-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path d="M12 2c2.72 0 3.06.01 4.12.06 1.06.05 1.79.22 2.43.47.66.26 1.22.6 1.77 1.15.5.5.9 1.11 1.15 1.77.25.64.42 1.37.47 2.43.05 1.06.06 1.4.06 4.12s-.01 3.06-.06 4.12c-.05 1.06-.22 1.79-.47 2.43a4.9 4.9 0 0 1-1.15 1.77 4.9 4.9 0 0 1-1.77 1.15c-.64.25-1.37.42-2.43.47-1.06.05-1.4.06-4.12.06s-3.06-.01-4.12-.06c-1.06-.05-1.79-.22-2.43-.47a4.9 4.9 0 0 1-1.77-1.15 4.9 4.9 0 0 1-1.15-1.77c-.25-.64-.42-1.37-.47-2.43C2.01 15.06 2 14.72 2 12s.01-3.06.06-4.12c.05-1.06.22-1.79.47-2.43.26-.66.6-1.22 1.15-1.77.5-.5 1.11-.9 1.77-1.15.64-.25 1.37-.42 2.43-.47C8.94 2.01 9.28 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 8.25A3.25 3.25 0 1 1 12 8.75a3.25 3.25 0 0 1 0 6.5zM17.5 6.5a1.15 1.15 0 1 0 0-2.3 1.15 1.15 0 0 0 0 2.3z"/>
                    </svg>
                </a>
                <a href="#" aria-label="X" class="grid h-8 w-8 place-items-center rounded-full bg-white/10 text-white hover:bg-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path d="M18.24 2H21l-6.55 7.49L22 22h-6.42l-4.87-6.4L5.1 22H2.32l7.02-8.03L2 2h6.58l4.4 5.84L18.24 2zm-1.13 18h1.68L7.06 4h-1.8l11.85 16z"/>
                    </svg>
                </a>
                <a href="#" aria-label="LinkedIn" class="grid h-8 w-8 place-items-center rounded-full bg-white/10 text-white hover:bg-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.34V9h3.56v11.45z"/>
                    </svg>
                </a>
            </div>
            <p class="mt-4 text-xs font-bold text-white">© 2026 Denzeru</p>
        </div>
    </div>
</footer>
