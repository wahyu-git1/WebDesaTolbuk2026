<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Permohonan Surat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="flex justify-between items-start border-b pb-4 mb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $surat->jenis->nama }}</h3>
                            <p class="text-sm text-gray-500">Kode Tracking: <span class="font-mono font-bold">{{ $surat->kode_tracking }}</span></p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 rounded-full text-sm font-bold 
                                {{ $surat->status == 'diajukan' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $surat->status == 'disetujui' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $surat->status == 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($surat->status) }}
                            </span>
                            <p class="text-xs text-gray-400 mt-1">{{ $surat->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <h4 class="font-bold text-gray-700 mb-3 uppercase text-sm border-b pb-1">Data Pemohon</h4>
                            <table class="w-full text-sm">
                                <tr>
                                    <td class="py-1 text-gray-500 w-1/3">Nama</td>
                                    <td class="font-medium">: {{ $surat->nama_pemohon }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1 text-gray-500">NIK</td>
                                    <td class="font-medium">: {{ $surat->nik }}</td>
                                </tr>
                                <tr>
                                    <td class="py-1 text-gray-500">Alamat</td>
                                    <td class="font-medium">: {{ $surat->alamat }}</td>
                                </tr>
                            </table>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-700 mb-3 uppercase text-sm border-b pb-1">Data Kelengkapan Surat</h4>
                            
                            @if($surat->data_surat && count($surat->data_surat) > 0)
                                <table class="w-full text-sm">
                                    @foreach($surat->data_surat as $key => $value)
                                        <tr>
                                            <td class="py-1 text-gray-500 w-1/3 capitalize">
                                                {{ str_replace('_', ' ', $key) }}
                                            </td>
                                            <td class="font-medium">
                                                : {{ $value }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <p class="text-sm text-gray-400 italic">Tidak ada data tambahan.</p>
                            @endif

                            <div class="mt-4">
                                <h4 class="font-bold text-gray-700 mb-2 uppercase text-sm border-b pb-1">Keperluan</h4>
                                <p class="text-sm text-gray-800 bg-gray-50 p-2 rounded border">
                                    {{ $surat->keperluan }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 pt-4 border-t flex flex-wrap justify-between items-center gap-4">
                        
                        <a href="{{ route('admin.surat.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                            &larr; Kembali
                        </a>

                        <div class="flex space-x-2">
                            
                            <a href="{{ route('admin.surat.preview', $surat->id) }}" target="_blank" 
                               class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded shadow flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Preview
                            </a>

                            @if($surat->status == 'disetujui')
                                <a href="{{ route('admin.surat.cetak', $surat->id) }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                    Cetak PDF
                                </a>
                            @endif

                            @if($surat->status == 'diajukan')
                                <form action="{{ route('admin.surat.update', $surat->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow" onclick="return confirm('Setujui permohonan ini?')">
                                        &#10003; Setujui
                                    </button>
                                </form>

                                <form action="{{ route('admin.surat.update', $surat->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow" onclick="return confirm('Tolak permohonan ini?')">
                                        &#10005; Tolak
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>