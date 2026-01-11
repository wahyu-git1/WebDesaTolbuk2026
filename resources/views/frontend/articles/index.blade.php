<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita & Artikel Desa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <div class="flex flex-wrap justify-center gap-2">
                    <a href="{{ route('articles.index') }}" 
                       class="px-5 py-2 rounded-full border text-sm font-semibold transition
                       {{ !request('category') ? 'bg-desa-green text-white border-desa-green' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                        Semua Terbaru
                    </a>

                    @foreach($categories as $cat)
                        <a href="{{ route('articles.index', ['category' => $cat->slug]) }}" 
                           class="px-5 py-2 rounded-full border text-sm font-semibold transition
                           {{ request('category') == $cat->slug ? 'bg-desa-green text-white border-desa-green' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">
                        
                        <a href="{{ route('articles.show', $article->slug) }}" class="block h-48 overflow-hidden relative group">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <span class="absolute top-3 right-3 bg-white/90 backdrop-blur text-desa-green text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                {{ $article->category->name }}
                            </span>
                        </a>

                        <div class="p-5 flex flex-col flex-grow">
                            <div class="text-xs text-gray-400 mb-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $article->created_at->diffForHumans() }}
                            </div>

                            <h3 class="text-lg font-bold text-gray-800 mb-3 leading-snug">
                                <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-desa-green transition">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-grow">
                                {{ Str::limit(strip_tags($article->body), 100) }}
                            </p>

                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-desa-green font-semibold text-sm hover:underline flex items-center">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-500">Belum ada artikel terbaru.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $articles->links() }}
            </div>

        </div>
    </div>
</x-app-layout>