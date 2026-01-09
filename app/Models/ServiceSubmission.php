<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSubmission extends Model
{
    //
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'service_procedure_id',
        'nama_pemohon',
        'nik',
        'no_hp',
        'files',
        'status'
    ];

    protected $casts = [
        'files' => 'array', // Agar otomatis jadi array saat diambil
    ];

    // Relasi balik ke Prosedur
    public function procedure()
    {
        return $this->belongsTo(ServiceProcedure::class, 'service_procedure_id');
    }
}
