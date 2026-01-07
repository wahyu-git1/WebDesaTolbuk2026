<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $procedure->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h1 class="text-3xl font-bold mb-4 text-accent" data-aos="fade-down">{{ $procedure->title }}</h1>
                    
                    @if ($procedure->category)
                        <span class="inline-block bg-desa-skyblue bg-opacity-20 text-desa-skyblue text-sm font-semibold px-3 py-1 rounded-full mb-4"
                            data-aos="fade-down" data-aos-delay="100">
                            {{ $procedure->category }}
                        </span>
                    @endif

                    <p class="text-gray-700 text-base mb-6" data-aos="fade-up" data-aos-delay="200">
                        {{ $procedure->description }}
                    </p>

                    <h2 class="text-2xl font-bold mb-4 text-desa-green mt-8" data-aos="fade-up" data-aos-delay="300">
                        Langkah-langkah & Persyaratan:
                    </h2>
                    
                    <div class="prose max-w-none text-gray-700 leading-relaxed mt-6" data-aos="fade-up" data-aos-delay="400">
                        {!! $procedure->steps_requirements !!} {{-- Render HTML jika ada --}}
                    </div>

                    
                    @if($procedure->file_path)
                        <div class="my-6 p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-center justify-between" 
                             data-aos="fade-up" data-aos-delay="250">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">Dokumen Panduan / Formulir</h4>
                                    <p class="text-xs text-gray-500">Silakan unduh dokumen terkait prosedur ini.</p>
                                </div>
                            </div>
                            
                            <a href="{{ asset('storage/' . $procedure->file_path) }}" 
                               target="_blank" 
                               download
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Download PDF
                            </a>
                        </div>
                    @endif

                    <div class="mt-8 text-center" data-aos="fade-up" data-aos-delay="500">
                        <a href="{{ route('service-procedures') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-desa-skyblue focus:ring-offset-2 transition ease-in-out duration-150">
                            &larr; Kembali ke Daftar Prosedur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>