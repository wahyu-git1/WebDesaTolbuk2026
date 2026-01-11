<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleAdminController extends Controller
{

    // LIST ARTIKEL
    public function index()
    {
        $articles = Article::with('category')->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    // FORM TAMBAH
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }


    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'body'        => 'required',
            'image'       => 'nullable|image|max:5048|jpeg|jpg|png', // Max 2MB
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $data['excerpt'] = Str::limit(strip_tags($request->body), 150); // Ambil 150 huruf pertama untuk ringkasan
        
        // Default published_at = sekarang (langsung tayang)
        $data['published_at'] = now(); 

        // Upload Gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diterbitkan!');
    }


    // FORM EDIT
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }


    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'body'        => 'required',
            'image'       => 'nullable|image|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $data = $request->all();
        
        // Update slug jika judul berubah (opsional, bisa dimatikan jika tidak ingin link berubah)
        if ($article->title != $request->title) {
            $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        }

        $data['excerpt'] = Str::limit(strip_tags($request->body), 150);

        // Update Gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel dihapus.');
    }
}