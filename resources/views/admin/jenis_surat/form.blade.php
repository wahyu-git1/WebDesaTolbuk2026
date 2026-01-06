<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $jenis->exists ? 'Edit Jenis Surat' : 'Tambah Jenis Surat' }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-4 px-4">
        <form
            action="{{ $jenis->exists ? route('admin.jenis-surat.update', $jenis->id) : route('admin.jenis-surat.store') }}"
            method="POST" class="space-y-6">
            @csrf
            @if ($jenis->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="space-y-4">
                    <div class="bg-white p-4 shadow rounded-lg">
                        <h3 class="text-lg font-medium border-b pb-2 mb-4">Informasi Surat</h3>
                        
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Nama Jenis Surat</label>
                            <input type="text" name="nama" value="{{ old('nama', $jenis->nama) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Kode Surat (Unik)</label>
                            <input type="text" name="kode" value="{{ old('kode', $jenis->kode) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">{{ old('deskripsi', $jenis->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <div class="bg-white p-4 shadow rounded-lg">
                        <h3 class="text-lg font-medium border-b pb-2 mb-4">Template Surat (HTML)</h3>
                        <div class="mb-2">
                            <small class="text-gray-500">Gunakan <code>@{{ nama_variable }}</code> untuk data dinamis.</small>
                        </div>
                        <textarea name="template" rows="10" 
                            class="w-full border-gray-300 rounded-md shadow-sm font-mono text-sm focus:ring-green-500 focus:border-green-500"
                            placeholder="Tulis kode HTML surat di sini...">{{ old('template', $jenis->template) }}</textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-white p-4 shadow rounded-lg">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h3 class="text-lg font-medium">Form Input Tambahan</h3>
                            <button type="button" id="add-field-btn" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                                + Tambah Field
                            </button>
                        </div>
                        
                        <p class="text-sm text-gray-500 mb-4">Tentukan kolom apa saja yang harus diisi user.</p>

                        <div id="fields-container" class="space-y-3">
                            @php
                                // Ambil data fields dari database atau old input jika validasi gagal
                                $fields = old('fields', $jenis->fields ?? []);
                            @endphp

                            @foreach($fields as $index => $field)
                                <div class="field-item border border-gray-200 bg-gray-50 p-3 rounded-md relative">
                                    <button type="button" class="remove-field absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold">&times;</button>
                                    
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <label class="text-xs font-bold text-gray-600">Label (Tampilan)</label>
                                            <input type="text" name="fields[{{ $index }}][label]" value="{{ $field['label'] ?? '' }}" 
                                                class="w-full text-sm border-gray-300 rounded p-1" placeholder="Misal: Gaji Ortu" required>
                                        </div>
                                        <div>
                                            <label class="text-xs font-bold text-gray-600">Variable (Tanpa Spasi)</label>
                                            <input type="text" name="fields[{{ $index }}][name]" value="{{ $field['name'] ?? '' }}" 
                                                class="w-full text-sm border-gray-300 rounded p-1" placeholder="gaji_ortu" required>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="text-xs font-bold text-gray-600">Tipe Input</label>
                                        <select name="fields[{{ $index }}][type]" class="w-full text-sm border-gray-300 rounded p-1">
                                            <option value="text" {{ ($field['type'] ?? '') == 'text' ? 'selected' : '' }}>Teks Singkat</option>
                                            <option value="number" {{ ($field['type'] ?? '') == 'number' ? 'selected' : '' }}>Angka</option>
                                            <option value="date" {{ ($field['type'] ?? '') == 'date' ? 'selected' : '' }}>Tanggal</option>
                                            <option value="textarea" {{ ($field['type'] ?? '') == 'textarea' ? 'selected' : '' }}>Area Teks</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="empty-msg" class="text-center text-gray-400 py-4 {{ !empty($fields) ? 'hidden' : '' }}">
                            Belum ada field tambahan.
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-2 pt-4 border-t">
                <a href="{{ route('admin.jenis-surat.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">Kembali</a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                    {{ $jenis->exists ? 'Update Data' : 'Simpan Data' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('fields-container');
            const addBtn = document.getElementById('add-field-btn');
            const emptyMsg = document.getElementById('empty-msg');
            
            // Hitung index berdasarkan jumlah elemen yang ada agar tidak bentrok
            let fieldIndex = document.querySelectorAll('.field-item').length;

            function checkEmpty() {
                if (document.querySelectorAll('.field-item').length === 0) {
                    emptyMsg.classList.remove('hidden');
                } else {
                    emptyMsg.classList.add('hidden');
                }
            }

            addBtn.addEventListener('click', function() {
                const template = `
                    <div class="field-item border border-gray-200 bg-gray-50 p-3 rounded-md relative animate-pulse">
                        <button type="button" class="remove-field absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-lg" title="Hapus">&times;</button>
                        
                        <div class="grid grid-cols-2 gap-2 mb-2">
                            <div>
                                <label class="text-xs font-bold text-gray-600">Label</label>
                                <input type="text" name="fields[${fieldIndex}][label]" class="w-full text-sm border-gray-300 rounded p-1 shadow-sm focus:border-blue-500" placeholder="Label" required>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-600">Variable</label>
                                <input type="text" name="fields[${fieldIndex}][name]" class="w-full text-sm border-gray-300 rounded p-1 shadow-sm focus:border-blue-500" placeholder="variable_name" required>
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-xs font-bold text-gray-600">Tipe</label>
                            <select name="fields[${fieldIndex}][type]" class="w-full text-sm border-gray-300 rounded p-1 shadow-sm">
                                <option value="text">Teks Singkat</option>
                                <option value="number">Angka</option>
                                <option value="date">Tanggal</option>
                                <option value="textarea">Area Teks</option>
                            </select>
                        </div>
                    </div>
                `;
                
                // Masukkan HTML baru ke container
                container.insertAdjacentHTML('beforeend', template);
                
                // Hapus efek pulse setelah sebentar
                const newItem = container.lastElementChild;
                setTimeout(() => newItem.classList.remove('animate-pulse'), 500);

                fieldIndex++;
                checkEmpty();
            });

            // Event Listener untuk tombol Hapus (Delegation)
            container.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-field')) {
                    if(confirm('Hapus field ini?')) {
                        e.target.closest('.field-item').remove();
                        checkEmpty();
                    }
                }
            });
        });
    </script>
</x-admin-layout>