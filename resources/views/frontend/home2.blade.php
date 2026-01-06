<x-app-layout>
    {{-- Hero Slider Section dengan Overlay Gradient Modern --}}
    <div class="relative w-full overflow-hidden h-screen" x-data="{ activeSlide: 0, slides: {{ $sliders->toJson() }} }" x-init="if (slides.length > 1) {
        setInterval(() => {
            activeSlide = (activeSlide + 1) % slides.length;
        }, 5000);
    }">
        @forelse ($sliders as $index => $slider)
            <div x-show="activeSlide === {{ $index }}" 
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform scale-105" 
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-700" 
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ Storage::url($slider->image) }}');">
                
                {{-- Overlay dengan gradasi modern --}}
                <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-primary/30 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

                {{-- Konten Hero --}}
                <div class="relative z-10 h-full flex items-center justify-center px-4">
                    <div class="max-w-4xl mx-auto text-center">
                        <div class="mb-6 inline-block">
                            <span class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-medium border border-white/30">
                                Selamat Datang
                            </span>
                        </div>
                        <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight tracking-tight animate-fade-in-down drop-shadow-2xl">
                            {{ $slider->title }}
                        </h1>
                        <p class="text-xl md:text-2xl text-white/95 leading-relaxed mb-8 animate-fade-in-up max-w-2xl mx-auto font-light">
                            {{ $slider->description }}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up">
                            <a href="{{ route('profil.visi') }}" 
                               class="px-8 py-4 bg-white text-primary font-bold rounded-full shadow-2xl hover:shadow-white/50 hover:scale-105 transition-all duration-300">
                                Jelajahi Desa
                            </a>
                            <a href="{{ route('news') }}" 
                               class="px-8 py-4 bg-white/10 backdrop-blur-md text-white font-bold rounded-full border-2 border-white/30 hover:bg-white/20 hover:scale-105 transition-all duration-300">
                                Berita Terkini
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Dekorasi geometris --}}
                <div class="absolute top-20 right-20 w-32 h-32 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-32 left-20 w-48 h-48 bg-primary/20 rounded-full blur-3xl animate-pulse delay-700"></div>
            </div>
        @empty
            <div class="relative w-full h-screen flex items-center justify-center bg-gradient-to-br from-primary/10 to-secondary/10">
                <p class="text-gray-600 text-xl">Tidak ada slider aktif yang tersedia.</p>
            </div>
        @endforelse

        {{-- Navigation Dots - Modern Style --}}
        @if ($sliders->count() > 1)
            <div class="absolute bottom-8 left-0 right-0 flex justify-center items-center space-x-2 z-20">
                @foreach ($sliders as $index => $slider)
                    <button @click="activeSlide = {{ $index }}"
                        :class="activeSlide === {{ $index }} ? 'w-12 bg-white' : 'w-3 bg-white/50 hover:bg-white/80'"
                        class="h-3 rounded-full transition-all duration-500 focus:outline-none"></button>
                @endforeach
            </div>
        @endif

        {{-- Navigation Arrows - Modern Style --}}
        @if ($sliders->count() > 1)
            <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
                class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-md hover:bg-white/30 text-white p-4 rounded-full z-20 hidden md:block transition-all duration-300 border border-white/30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button @click="activeSlide = (activeSlide + 1) % slides.length"
                class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-md hover:bg-white/30 text-white p-4 rounded-full z-20 hidden md:block transition-all duration-300 border border-white/30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        @endif

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-24 left-1/2 -translate-x-1/2 z-20 animate-bounce">
            <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>

    {{-- Sekilas Desa Section - Enhanced --}}
    <section class="py-24 bg-gradient-to-b from-white via-gray-50 to-white dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, #000 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="text-center mb-12" data-aos="fade-down">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold">Tentang Kami</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-6 bg-gradient-to-r from-primary via-secondary to-accent bg-clip-text text-transparent">
                    Selamat Datang di {{ $villageName->content ?? 'Nama Desa' }}
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="100">
                <p class="text-lg md:text-xl text-gray-700 dark:text-gray-300 leading-relaxed text-center mb-8">
                    {!! $sekilasDesa->content ?? 'Teks sambutan desa belum diatur. Silakan hubungi admin.' !!}
                </p>
                
                <div class="flex justify-center">
                    <a href="{{ route('profil.visi') }}"
                        class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary to-primary-dark text-white text-base font-bold rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300"
                        data-aos="zoom-in" data-aos-delay="200">
                        Pelajari Lebih Lanjut
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Potensi Desa Section - Card Modern --}}
    <section id="potensi" class="py-24 bg-gradient-to-br from-gray-50 via-white to-primary/5 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold">Keunggulan Desa</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                    Potensi {{ $villageName->content ?? 'Nama Desa' }}
                </h2>
                <div class="w-24 h-1.5 mx-auto bg-gradient-to-r from-primary via-secondary to-accent rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($potentials as $index => $potential)
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-500 hover:-translate-y-2 border border-gray-100 dark:border-gray-700"
                        data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                        
                        <div class="relative overflow-hidden">
                            @if ($potential->image)
                                <img src="{{ Storage::url($potential->image) }}" alt="{{ $potential->title }}"
                                    class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-56 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors">
                                    {{ $potential->title }}
                                </h3>
                                <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">{!! Str::limit($potential->description, 120) !!}</p>
                            <a href="{{ route('potentials') }}"
                                class="group/link inline-flex items-center font-semibold text-primary hover:text-primary-dark transition-colors">
                                Selengkapnya
                                <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">Belum ada potensi desa yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>

            @if ($potentials->count() > 0)
                <div class="text-center mt-16" data-aos="fade-up">
                    <a href="{{ route('potentials') }}"
                        class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-primary to-primary-dark text-white font-bold rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                        Lihat Semua Potensi
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Berita Terbaru Section - Magazine Style --}}
    <section id="berita-terbaru" class="py-24 bg-white dark:bg-gray-900 relative overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/5 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16" data-aos="fade-down">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-accent/10 text-accent rounded-full text-sm font-semibold">Informasi Terkini</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900 dark:text-white">
                    Berita Terbaru
                </h2>
                <div class="w-24 h-1.5 mx-auto bg-gradient-to-r from-accent to-primary rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($news as $index => $article)
                    <article class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-500 hover:-translate-y-2 border border-gray-100 dark:border-gray-700"
                        data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">

                        <div class="relative overflow-hidden h-56">
                            @if ($article->image)
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            {{-- Badge Kategori --}}
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-primary text-xs font-bold rounded-full shadow-lg">
                                    Berita
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</span>
                                <span>•</span>
                                <span>{{ $article->author ?? 'Admin' }}</span>
                            </div>

                            <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('news.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>

                            <a href="{{ route('news.show', $article->slug) }}"
                                class="group/link inline-flex items-center font-semibold text-primary hover:text-primary-dark transition-colors">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-300">
                            Belum ada berita terbaru yang dipublikasikan.
                        </p>
                    </div>
                @endforelse
            </div>

            @if ($news->count() > 0)
                <div class="text-center mt-16" data-aos="fade-up">
                    <a href="{{ route('news') }}"
                        class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-accent to-accent/80 text-white font-bold rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                        Lihat Semua Berita
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Layanan Cepat - Icon Cards Modern --}}
    <section class="py-24 bg-gradient-to-br from-primary via-primary-dark to-secondary relative overflow-hidden">
        {{-- Animated Background --}}
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                    🚀 Layanan Digital Desa
                </h2>
                <p class="text-white/90 text-lg max-w-2xl mx-auto">
                    Akses mudah dan cepat untuk berbagai kebutuhan administrasi dan informasi desa
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Card 1 --}}
                <a href="{{ route('surat.public.create') }}"
                    class="group relative bg-white/10 backdrop-blur-md hover:bg-white/20 rounded-3xl p-8 text-center transition-all duration-500 border border-white/20 hover:border-white/40 hover:-translate-y-2 hover:shadow-2xl"
                    data-aos="zoom-in" data-aos-delay="100">
                    <div class="absolute -top-3 -right-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-yellow-400 text-xs font-bold text-gray-900 shadow-lg animate-bounce">
                            Baru
                        </span>
                    </div>
                    <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Surat Online</h3>
                    <p class="text-white/80 text-sm leading-relaxed">Ajukan dokumen desa tanpa antri, mudah dan cepat</p>
                </a>

                {{-- Card 2 --}}
                <a href="{{ route('service-procedures') }}"
                    class="group relative bg-white/10 backdrop-blur-md hover:bg-white/20 rounded-3xl p-8 text-center transition-all duration-500 border border-white/20 hover:border-white/40 hover:-translate-y-2 hover:shadow-2xl"
                    data-aos="zoom-in" data-aos-delay="200">
                    <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Prosedur Layanan</h3>
                    <p class="text-white/80 text-sm leading-relaxed">Panduan lengkap urusan administratif desa</p>
                </a>

                {{-- Card 3 --}}
                <a href="{{ route('documents') }}"
                    class="group relative bg-white/10 backdrop-blur-md hover:bg-white/20 rounded-3xl p-8 text-center transition-all duration-500 border border-white/20 hover:border-white/40 hover:-translate-y-2 hover:shadow-2xl"
                    data-aos="zoom-in" data-aos-delay="300">
                    <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Unduh Dokumen</h3>
                    <p class="text-white/80 text-sm leading-relaxed">Akses arsip dan peraturan desa dengan mudah</p>
                </a>

                {{-- Card 4 --}}
                <a href="#lokasi"
                    class="group relative bg-white/10 backdrop-blur-md hover:bg-white/20 rounded-3xl p-8 text-center transition-all duration-500 border border-white/20 hover:border-white/40 hover:-translate-y-2 hover:shadow-2xl"
                    data-aos="zoom-in" data-aos-delay="400">
                    <div class="w-20 h-20 mx-auto mb-6 bg-white/20 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                        <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Lokasi & Kontak</h3>
                    <p class="text-white/80 text-sm leading-relaxed">Cari kami, kirim pesan, atau langsung datang!</p>
                </a>
            </div>
        </div>
    </section>

    {{-- Galeri Section - Modern Grid --}}
    <section id="galeri" class="py-24 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold">Dokumentasi</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4 bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    Galeri {{ $villageName->content ?? 'Nama Desa' }}
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-base max-w-2xl mx-auto">
                    Dokumentasi kegiatan dan potret keindahan desa kami
                </p>
                <div class="mt-4 w-24 h-1.5 mx-auto bg-gradient-to-r from-primary to-secondary rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @php
                    $homepageGalleries = App\Models\Gallery::where('is_published', true)
                        ->orderBy('created_at', 'desc')
                        ->take(6)
                        ->with('images')
                        ->get();
                @endphp

                @forelse ($homepageGalleries as $index => $gallery)
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden hover:-translate-y-2 border border-gray-100 dark:border-gray-700"
                        data-aos="zoom-in" data-aos-delay="{{ 100 * ($index + 1) }}">
                        <a href="{{ route('gallery.show', $gallery->slug) }}" class="block">
                            <div class="relative overflow-hidden h-64">
                                @if ($gallery->cover_image)
                                    <img src="{{ Storage::url($gallery->cover_image) }}"
                                        alt="Sampul {{ $gallery->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @elseif ($gallery->images->isNotEmpty())
                                    <img src="{{ Storage::url($gallery->images->first()->path) }}"
                                        alt="Sampul {{ $gallery->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                {{-- Badge Jumlah Foto --}}
                                <div class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full flex items-center space-x-1 shadow-lg">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-xs font-bold text-gray-900">{{ $gallery->images->count() }}</span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                    {{ $gallery->name }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $gallery->images->count() }} Foto
                                </p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">
                            Belum ada album galeri yang dipublikasikan.
                        </p>
                    </div>
                @endforelse
            </div>

            @if ($homepageGalleries->count() > 0)
                <div class="text-center mt-16" data-aos="fade-up">
                    <a href="{{ route('gallery') }}"
                        class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-primary to-secondary text-white font-bold rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                        Lihat Semua Galeri
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Lokasi Section - Modern Map Card --}}
    <section id="lokasi" class="py-24 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-accent/10 text-accent rounded-full text-sm font-semibold">Hubungi Kami</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900 dark:text-white">
                    Lokasi Kantor Desa
                </h2>
                <div class="w-24 h-1.5 mx-auto bg-gradient-to-r from-accent to-primary rounded-full"></div>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="100">
                    
                    {{-- Map Container --}}
                    <div class="relative h-96 bg-gray-200 dark:bg-gray-700">
                        @if ($googleMapsEmbedUrl)
                            <iframe src="{{ $googleMapsEmbedUrl }}" 
                                width="100%" 
                                height="100%"
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade" 
                                class="w-full h-full">
                            </iframe>
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600">
                                <div class="text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400">Peta belum diatur</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Contact Info --}}
                    <div class="p-8 md:p-12">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Informasi Kontak</h3>
                        
                        <div class="grid md:grid-cols-3 gap-6">
                            {{-- Alamat --}}
                            <div class="flex items-start space-x-4 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-2xl hover:shadow-lg transition-shadow">
                                <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">Alamat</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                        @if ($contactAddress && $contactAddress->content)
                                            {!! $contactAddress->content !!}
                                        @else
                                            Alamat belum diatur.
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="flex items-start space-x-4 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-2xl hover:shadow-lg transition-shadow">
                                <div class="flex-shrink-0 w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">Email</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                                        @if ($contactEmail && $contactEmail->content)
                                            <a href="mailto:{{ strip_tags($contactEmail->content) }}"
                                                class="text-secondary hover:underline">{{ strip_tags($contactEmail->content) }}</a>
                                        @else
                                            Email belum diatur.
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Telepon --}}
                            <div class="flex items-start space-x-4 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-2xl hover:shadow-lg transition-shadow">
                                <div class="flex-shrink-0 w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">Telepon</h4>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                                        @if ($contactPhone && $contactPhone->content)
                                            @php $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content); @endphp
                                            <a href="tel:{{ $cleanPhoneNumber }}"
                                                class="text-accent hover:underline">{{ strip_tags($contactPhone->content) }}</a>
                                        @else
                                            Telepon belum diatur.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


       {{-- Sambutan Kepala Desa Section --}}
    <section class="py-24 bg-gradient-to-br from-primary/5 via-white to-secondary/5 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 left-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16" data-aos="fade-down">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold">Kepemimpinan Desa</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                    Sambutan Kepala Desa
                </h2>
                <div class="w-24 h-1.5 mx-auto bg-gradient-to-r from-primary to-accent rounded-full"></div>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="100">
                    <div class="grid md:grid-cols-2 gap-0">
                        {{-- Foto Kepala Desa --}}
                        
                        <div class="relative h-full min-h-[400px] md:min-h-[500px]" data-aos="fade-right" data-aos-delay="200">
                            <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-secondary/20"></div>

                            <img src="{{ asset('images/logo.jpg') }}"
                                alt="Kepala Desa"
                                class="w-full h-full object-cover">
                        </div>


                        {{-- Sambutan Kepala Desa --}}
                        <div class="p-8 md:p-12 flex flex-col justify-center" data-aos="fade-left" data-aos-delay="300">
                       
                            wahyu rohmatul abidin

                            {{-- Quote Icon --}}
                            <div class="mb-6">
                                <svg class="w-12 h-12 text-primary/30" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                            </div>

                            {{-- Nama & Jabatan --}}
                            <div class="mb-6">
                                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                    {{ $namaKades->content ?? 'Nama Kepala Desa' }}
                                </h3>
                                <div class="flex items-center space-x-2">
                                    <div class="w-12 h-1 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
                                    <p class="text-primary font-semibold">Kepala Desa</p>
                                </div>
                            </div>

                            {{-- Sambutan --}}
                            <div class="text-gray-700 dark:text-gray-300 leading-relaxed space-y-4 mb-8">
                                    <p>Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                                    <p>Selamat datang di website resmi desa kami. Melalui platform digital ini, kami berkomitmen untuk memberikan layanan terbaik dan informasi yang transparan kepada seluruh masyarakat.</p>
                                    <p>Mari bersama-sama membangun desa yang lebih maju, sejahtera, dan bermartabat.</p>
                                    <p class="italic text-gray-600 dark:text-gray-400">Wassalamu'alaikum Warahmatullahi Wabarakatuh</p>
                            </div>

                            {{-- Signature / Tanda Tangan --}}
                            <div class="flex items-center space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Hormat Kami,</p>
                                    <p class="font-bold text-gray-900 dark:text-white">{{ $namaKades->content ?? 'Kepala Desa' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>