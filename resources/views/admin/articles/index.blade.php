<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Daftar Berita</h3>
                    <a href="{{ route('admin.articles.create') }}" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Tulis Artikel Baru
                    </a>    
                </div>

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Kategori</h3>
                    <a href="{{ route('admin.categories.index') }}" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Jenis Category
                    </a>
                </div>
                    

                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul & Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($articles as $art)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($art->image)
                                            <img src="{{ asset('storage/' . $art->image) }}" class="h-12 w-12 rounded object-cover">
                                        @else
                                            <span class="h-12 w-12 rounded bg-gray-200 block"></span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $art->title }}</div>
                                        <div class="text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded inline-block mt-1">
                                            {{ $art->category->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $art->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.articles.edit', $art->id) }}" class="text-yellow-600 hover:text-yellow-900 mx-2">Edit</a>
                                        <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 mx-2">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>