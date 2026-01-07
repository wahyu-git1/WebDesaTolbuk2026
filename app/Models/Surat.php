<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_tracking',
        'jenis_surat_id',

// Data Identitas Pemohon (Tetap kolom biasa agar mudah di-search/filter)
        'nama_pemohon',
        'nik',


        'nama_pemohon',
        'nik',
        'alamat',
        'keperluan',
        'no_hp',


        'status',
        // KOLOM BARU: Untuk menampung semua inputan dinamis dari Admin
        'data_surat',
        'lampiran'
    ];
    public function jenis()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }
    // INI PENTING: Agar saat dipanggil otomatis jadi Array, bukan String JSON
    protected $casts = [
        'data_surat' => 'array',
        'lampiran' => 'array',
    ];


}