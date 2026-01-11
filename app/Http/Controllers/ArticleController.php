<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        // 1. Ambil semua Kategori untuk Header di atas
        $categories = Category::all();

        // 2. Ambil Artikel Terbaru
        // Jika user klik salah satu kategori di header, kita filter.
        // Jika tidak, tampilkan semua artikel terbaru.
        $query = Article::with('category')->latest(); // latest() mengurutkan dari yang terbaru

        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $articles = $query->paginate(9); // Tampilkan 9 artikel per halaman

        return view('frontend.articles.index', compact('articles', 'categories'));
    }


    // Halaman Detail Artikel
    public function show($slug)
    {
        // Cari artikel berdasarkan slug
        $article = Article::where('slug', $slug)->firstOrFail();
        
        // Cari artikel berita terbaru lainnya (untuk sidebar/rekomendasi bawah)
        $recentArticles = Article::where('id', '!=', $article->id)->latest()->take(3)->get();

        return view('frontend.articles.show', compact('article', 'recentArticles'));
    }


}