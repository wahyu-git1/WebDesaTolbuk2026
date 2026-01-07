<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'nama', 
        'kode', 
        'deskripsi',
        'template',
        'fields',
        'persyaratan'
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class, 'jenis_surat_id');
    }
// 2. Casting otomatis JSON <-> Array
// Dengan $casts['fields'] => 'array', saat kamu memanggil $jenisSurat->fields,
// Laravel otomatis mengubahnya jadi Array PHP. Saat kamu menyimpannya, Laravel otomatis mengubahnya jadi JSON string.
    protected $casts = [
        'fields' => 'array',
        'persyaratan' => 'array',
    ];
}