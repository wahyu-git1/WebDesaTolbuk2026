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


                    <!-- mulai form pengajuan semi offline -->
                    <hr class="my-8 border-gray-300">

                    <div class="bg-green-50 border border-green-200 rounded-lg p-6" id="form-pengajuan">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Ajukan Layanan Ini Secara Online</h3>
                        <p class="text-sm text-gray-600 mb-6">
                            Sudah melengkapi berkas? Silakan isi data diri dan upload hasil scan formulir beserta persyaratannya di sini.
                        </p>

                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('service-submission.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="service_procedure_id" value="{{ $procedure->id }}">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="nama_pemohon" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">NIK</label>
                                    <input type="number" name="nik" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Nomor WhatsApp / HP</label>
                                <input type="number" name="no_hp" required placeholder="Contoh: 08123456789"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500">
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload Berkas Persyaratan 
                                    <span class="text-xs text-gray-500 font-normal">(Scan Formulir, KTP, KK, dll)</span>
                                </label>
                                
                                <input type="file" name="files[]" multiple required accept=".pdf,.jpg,.jpeg,.png"
                                    class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-50 file:text-green-700
                                    hover:file:bg-green-100
                                    border border-gray-300 rounded-lg p-2 bg-white">
                                <p class="text-xs text-gray-500 mt-1">
                                    Bisa pilih lebih dari 1 file sekaligus (Tahan tombol CTRL saat memilih). Format: PDF/JPG.
                                </p>
                                @error('files') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow transition duration-200">
                                Kirim Pengajuan
                            </button>
                        </form>
                    </div>
                    
                    

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