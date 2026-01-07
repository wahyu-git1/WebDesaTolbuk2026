<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Prosedur Layanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.service-procedures.update', $serviceProcedure) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Prosedur</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('title', $serviceProcedure->title) }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat
                                (Opsional)</label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('description', $serviceProcedure->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="steps_requirements"
                                class="block text-sm font-medium text-gray-700">Langkah-langkah & Persyaratan
                                (Detail)</label>
                            <textarea name="steps_requirements" id="steps_requirements" rows="15"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                required>{{ old('steps_requirements', $serviceProcedure->steps_requirements) }}</textarea>
                            @error('steps_requirements')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori
                                (Opsional)</label>
                            <select name="category" id="category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat }}"
                                        {{ old('category', $serviceProcedure->category) == $cat ? 'selected' : '' }}>
                                        {{ $cat }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="order" class="block text-sm font-medium text-gray-700">Urutan Tampilan
                                (Opsional)</label>
                            <input type="number" name="order" id="order"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('order', $serviceProcedure->order) }}">
                            @error('order')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 flex items-center">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                class="rounded border-gray-300 text-desa-green shadow-sm focus:border-desa-green focus:ring focus:ring-desa-green focus:ring-opacity-50"
                                {{ old('is_published', $serviceProcedure->is_published) ? 'checked' : '' }}>
                            <label for="is_published"
                                class="ml-2 block text-sm font-medium text-gray-700">Publikasikan</label>
                            @error('is_published')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                Upload File PDF (Panduan/Formulir)
                            </label>

                            <input type="file" name="file" id="file" accept="application/pdf"
                                class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100
                                border border-gray-300 rounded-lg p-2 shadow-sm">
                            
                            <p class="text-xs text-gray-500 mt-1">
                                Format: PDF. Maksimal 2MB. 
                                <span class="text-red-500 font-medium">Biarkan kosong jika tidak ingin mengubah file.</span>
                            </p>

                            @if($serviceProcedure->file_path)
                                <div class="mt-3 flex items-center p-3 bg-blue-50 border border-blue-200 rounded-md">
                                    <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <div class="text-sm">
                                        <p class="text-gray-600">File saat ini:</p>
                                        <a href="{{ asset('storage/' . $serviceProcedure->file_path) }}" 
                                        target="_blank" 
                                        class="font-bold text-blue-600 hover:text-blue-800 hover:underline">
                                            Lihat PDF Tersimpan
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @error('file')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.service-procedures.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit"
                                class="bg-desa-green hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                                Perbarui Prosedur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
