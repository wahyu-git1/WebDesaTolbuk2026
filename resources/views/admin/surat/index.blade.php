<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Masuk Permohonan Surat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2 md:mb-0">Arsip Surat</h3>
                        <a href="{{ route('admin.surat.create') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-sm">
                            + Buat Surat Baru
                        </a>
                    </div>

                    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <form action="{{ route('admin.surat.index') }}" method="GET">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                
                                <div class="col-span-1 md:col-span-1">
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Cari Nama / NIK</label>
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                        class="w-full text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Nama, NIK, atau Kode...">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Status</label>
                                    <select name="status" class="w-full text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Semua Status</option>
                                        <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Dari Tanggal</label>
                                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                                        class="w-full text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Sampai Tanggal</label>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}" 
                                        class="w-full text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <div class="mt-4 flex justify-end space-x-2">
                                <a href="{{ route('admin.surat.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium py-2 px-4 rounded">
                                    Reset
                                </a>
                                <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded">
                                    Terapkan Filter
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Info Surat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($surats as $s)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">{{ $s->jenis->nama ?? 'Jenis Terhapus' }}</div>
                                            <div class="text-xs text-gray-500 font-mono mt-1 bg-gray-100 inline-block px-1 rounded">{{ $s->kode_tracking }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 font-medium">{{ $s->nama_pemohon }}</div>
                                            <div class="text-xs text-gray-500">NIK: {{ $s->nik }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $s->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($s->status == 'diajukan')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Diajukan</span>
                                            @elseif($s->status == 'disetujui')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                                            @elseif($s->status == 'ditolak')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($s->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('admin.surat.show', $s->id) }}" class="text-blue-600 hover:text-blue-900 border border-blue-200 bg-blue-50 px-3 py-1 rounded">Detail</a>
                                                @if($s->status == 'disetujui')
                                                    <a href="{{ route('admin.surat.cetak', $s->id) }}" class="text-green-600 hover:text-green-900 border border-green-200 bg-green-50 px-3 py-1 rounded">PDF</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="text-lg">Data tidak ditemukan.</p>
                                                <p class="text-sm text-gray-400">Coba ubah filter pencarian Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $surats->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>