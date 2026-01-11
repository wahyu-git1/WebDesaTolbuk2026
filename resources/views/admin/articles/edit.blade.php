<x-admin-layout>
    <head>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
        <style> trix-toolbar [data-trix-button-group="file-tools"] { display: none; } </style>
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Artikel</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Judul Artikel</label>
                            <input type="text" name="title" value="{{ old('title', $article->title) }}" class="w-full border rounded p-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                            <select name="category_id" class="w-full border rounded p-2" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $article->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Ganti Gambar (Opsional)</label>
                            <input type="file" name="image" class="w-full border p-2" accept="image/*">
                            @if($article->image)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Gambar saat ini:</p>
                                    <img src="{{ asset('storage/' . $article->image) }}" class="h-32 object-cover rounded">
                                </div>
                            @endif
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2">Isi Artikel</label>
                            <input id="body" type="hidden" name="body" value="{{ old('body', $article->body) }}">
                            <trix-editor input="body" class="trix-content min-h-[300px]"></trix-editor>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                                Update Artikel
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>