<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pusat Layanan Desa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="text-center mb-12" data-aos="fade-up">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Layanan Administrasi Digital</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan berbagai metode pelayanan untuk memudahkan kebutuhan administrasi Anda. 
                    Silakan pilih layanan yang sesuai dengan kebutuhan Anda di bawah ini.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">

                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1 flex flex-col" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-6 flex-grow text-center">
                        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Prosedur & Semi-Online</h3>
                        <p class="text-gray-500 text-sm mb-4 leading-relaxed">
                            Layanan yang membutuhkan tanda tangan basah atau formulir fisik.
                        </p>
                        
                        <div class="bg-gray-50 rounded p-3 text-left mb-4">
                            <h4 class="font-bold text-xs text-gray-700 uppercase mb-2">Alur Layanan:</h4>
                            <ul class="text-sm text-gray-600 space-y-2 list-disc list-inside">
                                <li>Baca prosedur lengkap.</li>
                                <li>Download & Print Formulir PDF.</li>
                                <li>Isi manual & scan berkas.</li>
                                <li>Upload pengajuan (Semi-Online).</li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 border-t">
                        <a href="{{ route('service-procedures') }}" class="block w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-center rounded-lg transition">
                            Lihat Prosedur
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1 flex flex-col" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-6 flex-grow text-center">
                        <div class="w-16 h-16 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bank Dokumen</h3>
                        <p class="text-gray-500 text-sm mb-4 leading-relaxed">
                            Akses arsip dokumen publik desa, peraturan desa, dan transparansi anggaran.
                        </p>

                        <div class="bg-gray-50 rounded p-3 text-left mb-4">
                            <h4 class="font-bold text-xs text-gray-700 uppercase mb-2">Fitur:</h4>
                            <ul class="text-sm text-gray-600 space-y-2 list-disc list-inside">
                                <li>Download Peraturan Desa.</li>
                                <li>Laporan APBDes.</li>
                                <li>Dokumen Monografi Desa.</li>
                                <li>Arsip pengumuman penting.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 border-t">
                        <a href="{{ route('documents') }}" class="block w-full py-3 px-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-center rounded-lg transition">
                            Unduh Dokumen
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1 flex flex-col" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-6 flex-grow text-center">
                        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">Surat Online & Tracking</h3>
                        <p class="text-gray-500 text-sm mb-4 leading-relaxed">
                            Layanan administrasi instan tanpa perlu download formulir manual. Isi data langsung di web.
                        </p>

                        <div class="bg-gray-50 rounded p-3 text-left mb-4">
                            <h4 class="font-bold text-xs text-gray-700 uppercase mb-2">Keunggulan:</h4>
                            <ul class="text-sm text-gray-600 space-y-2 list-disc list-inside">
                                <li>Formulir Full Digital (Input Web).</li>
                                <li>Tidak perlu print & scan manual.</li>
                                <li>Dapatkan Kode Tracking.</li>
                                <li>Cek status surat secara Realtime.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 border-t">
                        <a href="{{ route('surat.public.create') }}" class="block w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white font-bold text-center rounded-lg transition">
                            Ajukan Sekarang
                        </a>
                    </div>
                </div>

            </div>

            <div class="mt-12 bg-white rounded-xl shadow p-8 text-center max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="400">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Sudah mengajukan surat?</h3>
                <p class="text-gray-500 mb-4">Lacak progres surat Anda menggunakan kode tracking yang Anda terima.</p>
                <a href="{{ route('surat.tracking') }}" class="inline-flex items-center text-blue-600 hover:underline font-semibold">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cek Status Surat
                </a>
            </div>

        </div>
    </div>
</x-app-layout>