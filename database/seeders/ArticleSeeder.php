<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        // 1. Inisialisasi Faker Indonesia
        $faker = Faker::create('id_ID');

        // 2. Buat Daftar Kategori Statis (Agar nama kategorinya masuk akal)
        $categoriesData = [
            'Pemerintahan Desa',
            'Berita Terkini',
            'Potensi Desa',
            'Layanan Masyarakat',
            'Teknologi & Inovasi',
            'Kegiatan Pemuda'
        ];

        foreach ($categoriesData as $catName) {
            // Simpan Kategori
            $category = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);

            // 3. Buat 4-6 Artikel Dummy untuk SETIAP Kategori
            for ($i = 0; $i < rand(4, 6); $i++) {
                $title = $faker->sentence(6); // Judul 6 kata
                
                // Buat paragraf HTML palsu
                $body = '';
                for ($p = 0; $p < 3; $p++) {
                    $body .= '<p class="mb-4">' . $faker->paragraph(10) . '</p>';
                }

                Article::create([
                    'category_id'  => $category->id,
                    'title'        => $title,
                    'slug'         => Str::slug($title) . '-' . Str::random(5), // Tambah random string biar slug unik
                    'excerpt'      => $faker->paragraph(2), // Ringkasan pendek
                    'body'         => $body, // Isi lengkap (HTML)
                    'image'        => null, // Gambar dikosongi dulu (biar tidak error broken image)
                    'published_at' => $faker->dateTimeBetween('-1 year', 'now'), // Tanggal acak 1 tahun terakhir
                ]);
            }
        }

        // 4. Tambahkan 1 Artikel Spesifik (Contoh Hardcoded agar terlihat bagus)
        $catTekno = Category::where('slug', 'teknologi-inovasi')->first();
        if ($catTekno) {
            Article::create([
                'category_id' => $catTekno->id,
                'title' => 'Transformasi Digital: Desa Tolbuk Menuju Smart Village 2026',
                'slug' => 'transformasi-digital-desa-tolbuk-2026',
                'excerpt' => 'Pemanfaatan teknologi informasi dalam pelayanan administrasi desa kini semakin mudah dan cepat.',
                'body' => '<p>Desa Tolbuk terus berinovasi. Dengan peluncuran website baru ini, warga kini bisa menikmati layanan surat menyurat secara semi-online.</p><p>Harapannya, transparansi dan kecepatan pelayanan publik akan meningkat drastis.</p>',
                'image' => null,
                'published_at' => now(),
            ]);
        }
    }
}