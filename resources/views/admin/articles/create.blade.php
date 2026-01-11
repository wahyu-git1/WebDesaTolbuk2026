<x-admin-layout>
    <head>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
        <style>
            trix-toolbar [data-trix-button-group="file-tools"] { display: none; } /* Sembunyikan tombol upload file di editor biar simple */
        </style>
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tulis Artikel Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Judul Artikel</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded p-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                            <select name="category_id" class="w-full border rounded p-2" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Gambar Sampul</label>
                            <input type="file" name="image" class="w-full border p-2" accept="image/*">
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2">Isi Artikel</label>
                            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                            <trix-editor input="body" class="trix-content min-h-[300px]"></trix-editor>
                            @error('body') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                                Terbitkan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>