<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceSubmission;

use Illuminate\Http\Request;

class ServiceSubmissionController extends Controller
{
    //
public function store(Request $request)
    {
        $request->validate([
            'service_procedure_id' => 'required|exists:service_procedures,id',
            'nama_pemohon' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'no_hp' => 'required|numeric',
            
            // Validasi File: Wajib ada, boleh banyak, max 5MB per file
            'files' => 'required|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:5120', 
        ]);

        $filePaths = [];

        // Loop untuk menyimpan setiap file yang diupload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Simpan ke folder 'submissions' di storage public
                $path = $file->store('submissions', 'public');
                $filePaths[] = $path;
            }
        }

        ServiceSubmission::create([
            'service_procedure_id' => $request->service_procedure_id,
            'nama_pemohon' => $request->nama_pemohon,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'files' => $filePaths, // Simpan array path
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengajuan berhasil dikirim! Petugas kami akan segera menghubungi Anda.');
    }
}
