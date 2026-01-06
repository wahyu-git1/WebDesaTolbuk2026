<x-app-layout>
<div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Ajukan Permohonan Surat</h2>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('surat.public.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-700 mb-4 border-b pb-2">Identitas Pemohon</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama_pemohon" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                    value="{{ old('nama_pemohon') }}" required>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">NIK</label>
                                <input type="number" name="nik" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                    value="{{ old('nik') }}" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700">No Hp Pemohon</label>
                            <textarea name="no_hp" rows="2" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                required>{{ old('no_hp') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label for="jenis_surat_id" class="block font-medium text-lg text-gray-800">Pilih Jenis Surat</label>
                        <select name="jenis_surat_id" id="jenis_surat_id" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 text-lg">
                            <option value="">-- Silakan Pilih Surat --</option>
                            @foreach ($jenis as $j)
                                <option value="{{ $j->id }}">{{ $j->nama }}</option>
                            @endforeach
                        </select>
                        <p id="deskripsi-surat" class="text-sm text-gray-500 mt-1 italic"></p>
                    </div>

                    <div id="dynamic-fields-section" class="hidden bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <h3 class="text-lg font-medium text-blue-800 mb-4 border-b border-blue-200 pb-2">
                            Data Tambahan Surat
                        </h3>
                        <div id="dynamic-fields-container" class="space-y-4">
                            </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded shadow transition duration-200">
                            Ajukan Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Ambil data Jenis Surat lengkap dari Laravel (convert ke JSON)
            const jenisSuratData = @json($jenis);
            
            const selectElement = document.getElementById('jenis_surat_id');
            const containerSection = document.getElementById('dynamic-fields-section');
            const fieldsContainer = document.getElementById('dynamic-fields-container');
            const descElement = document.getElementById('deskripsi-surat');

            // 2. Event saat user memilih dropdown
            selectElement.addEventListener('change', function() {
                const selectedId = this.value;
                
                // Reset container
                fieldsContainer.innerHTML = '';
                containerSection.classList.add('hidden');
                descElement.innerText = '';

                if (!selectedId) return;

                // Cari data surat yang dipilih
                const selectedSurat = jenisSuratData.find(item => item.id == selectedId);

                if (selectedSurat) {
                    // Tampilkan Deskripsi
                    if(selectedSurat.deskripsi) {
                        descElement.innerText = selectedSurat.deskripsi;
                    }

                    // Cek apakah ada fields (dynamic input)
                    if (selectedSurat.fields && selectedSurat.fields.length > 0) {
                        containerSection.classList.remove('hidden');

                        // Loop setiap field dan buat HTML inputnya
                        selectedSurat.fields.forEach(field => {
                            let inputHtml = '';
                            
                            // Penting: name="data_values[variable]" agar masuk array di controller
                            const inputName = `data_values[${field.name}]`;

                            if (field.type === 'textarea') {
                                inputHtml = `
                                    <textarea name="${inputName}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                                `;
                            } else if (field.type === 'date') {
                                inputHtml = `
                                    <input type="date" name="${inputName}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                `;
                            } else if (field.type === 'number') {
                                inputHtml = `
                                    <input type="number" name="${inputName}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                `;
                            } else {
                                // Default Text
                                inputHtml = `
                                    <input type="text" name="${inputName}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                `;
                            }

                            // Bungkus dalam div form-group
                            const wrapper = document.createElement('div');
                            wrapper.innerHTML = `
                                <label class="block font-medium text-sm text-gray-700 mb-1">${field.label}</label>
                                ${inputHtml}
                            `;
                            
                            fieldsContainer.appendChild(wrapper);
                        });
                    }
                }
            });
        });
    </script>
</x-app-layout>
