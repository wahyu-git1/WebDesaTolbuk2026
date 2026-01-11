<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                @if($article->image)
                    <div class="w-full h-64 md:h-96 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 md:p-8 text-white">
                            <span class="bg-desa-green px-3 py-1 rounded text-xs font-bold uppercase tracking-wide">
                                {{ $article->category->name }}
                            </span>
                            <h1 class="text-3xl md:text-4xl font-bold mt-2 shadow-sm">{{ $article->title }}</h1>
                        </div>
                    </div>
                @else
                    <div class="p-6 md:p-8 bg-gray-100 border-b">
                        <span class="text-desa-green font-bold uppercase text-xs tracking-wide">{{ $article->category->name }}</span>
                        <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $article->title }}</h1>
                    </div>
                @endif

                <div class="p-6 md:p-10">
                    <div class="flex items-center text-sm text-gray-500 mb-8 pb-8 border-b">
                        <span class="mr-4 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $article->created_at->format('d F Y') }}
                        </span>
                        <span>Diposting oleh Admin</span>
                    </div>

                    <div class="prose max-w-none text-gray-800 leading-relaxed">
                        {!! $article->body !!}
                        </div>

                    <div class="mt-12 pt-8 border-t">
                        <a href="{{ route('articles.index') }}" class="inline-flex items-center text-gray-600 hover:text-desa-green font-medium">
                            &larr; Kembali ke Berita
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>