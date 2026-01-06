<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Isi Data untuk Preview {{ $jenis->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4 bg-blue-50 border-l-4 border-blue-500 p-4">
                    <p class="text-sm text-blue-700">
                        Isi form di bawah ini dengan data dumy/palsu untuk mengetes apakah Template HTML sudah membaca variable dengan benar.
                    </p>

                </div>

                <form action="{{ route('admin.jenis-surat.show', $jenis->id) }}" method="GET" class="space-y-6">
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">1. Data Pemohon (Standar)</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Nama Pemohon (<code>nama_pemohon</code>)</label>
                                <input type="text" name="nama_pemohon" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="Budi Santoso" required>
                            </div>
                            
                            <div>
                                <label class="block font-medium text-sm text-gray-700">NIK (<code>nik</code>)</label>
                                <input type="number" name="nik" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" value="350101202020001" required>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">No HP/WA (<code>no_hp</code>)</label>
                                <textarea name="no_hp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" rows="2">08123456789</textarea>
                            </div>  
                        </div>
                    </div>

                    <div class="border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">2. Data Khusus Surat (Dinamis)</h3>
                        
                        @if(empty($jenis->fields))
                            <p class="text-sm text-gray-500 italic">Tidak ada field tambahan untuk surat ini.</p>
                        @else
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($jenis->fields as $field)
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">
                                            {{ $field['label'] }} (<code>{{ $field['name'] }}</code>)
                                        </label>

                                        @if($field['type'] === 'textarea')
                                            <textarea 
                                                name="{{ $field['name'] }}" 
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200"
                                                placeholder="Isi data dumy untuk {{ $field['label'] }}"></textarea>
                                        
                                        @elseif($field['type'] === 'date')
                                            <input 
                                                type="date" 
                                                name="{{ $field['name'] }}" 
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200"
                                                value="{{ date('Y-m-d') }}">
                                        
                                        @elseif($field['type'] === 'number')
                                            <input 
                                                type="number" 
                                                name="{{ $field['name'] }}" 
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200"
                                                placeholder="Contoh: 1000000">

                                        @else
                                            <input 
                                                type="text" 
                                                name="{{ $field['name'] }}" 
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200"
                                                placeholder="Teks singkat...">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">3. Variabel Pelengkap</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Tanggal Surat</label>
                                <input type="date" name="tanggal_surat" value="{{ date('Y-m-d') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Nama Penanda Tangan</label>
                                <input type="text" name="ttd_nama" value="Bpk. Kepala Desa" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow-lg transition transform hover:scale-105">
                            Lihat Hasil Preview HTML
                        </button>
                    </div>
                </form>


            </div>

        </div>


    </div>




</x-admin-layout>
