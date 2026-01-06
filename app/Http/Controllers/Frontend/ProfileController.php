<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProfileContent; // Import model ProfileContent
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function visionMission()
    {
        // Ambil konten Visi dari database
        $visi = ProfileContent::where('key', 'visi')->first();
        // Ambil konten Misi dari database
        $misi = ProfileContent::where('key', 'misi')->first();

        return view('frontend.profile.vision_mission', compact('visi', 'misi'));
    }

    public function history()
    {
        // Ambil konten Sejarah dari database
        $sejarah = ProfileContent::where('key', 'sejarah')->first();
        return view('frontend.profile.history', compact('sejarah'));
    }

    public function tentang()
    {
        $TentangDesa = ProfileContent::where('key', 'tentang_desa')->first();
        return view('frontend.profile.tentang', compact('TentangDesa'));
    }

    public function structure()
    {
        // Ambil konten Struktur Pemerintahan dari database
        $structure = ProfileContent::where('key', 'struktur_pemerintahan')->first();
        return view('frontend.profile.structure', compact('structure'));
    }

    public function statistika()
    {
        $statistika =ProfileContent::where('key', 'statistika_penduduk')->first();
        return view('frontend.profile.statistika', compact('statistika'));
    }
    
    public function peraturan()
    {
        $peraturan = ProfileContent::where('key', 'peraturan_desa')->first();
        return view('frontend.profile.peraturan', compact('peraturan'));
    }
}