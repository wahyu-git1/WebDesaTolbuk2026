<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProcedure; // Import model ServiceProcedure
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Support\Facades\Storage; // Untuk penyimpanan file

class ServiceProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $procedures = ServiceProcedure::orderBy('order')->paginate(10);
        return view('admin.service_procedures.index', compact('procedures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Daftar kategori opsional
        $categories = [
            'Kependudukan',
            'Pertanahan',
            'Perizinan',
            'Umum',
            'Lain-lain'
        ];
        return view('admin.service_procedures.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:service_procedures,title',
            'description' => 'nullable|string|max:500',
            'steps_requirements' => 'required|string', // Konten detail
            'category' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data =[
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'steps_requirements' => $request->steps_requirements,
            'category' => $request->category,
            'is_published' => $request->boolean('is_published'),
            'order' => $request->order,
        ];

        // LOGIKA UPLOAD FILE BARU
        if ($request->hasFile('file')) {
            // Simpan ke folder 'public/service_procedures'
            $filePath = $request->file('file')->store('service_procedures', 'public');
            $data['file_path'] = $filePath;
        }
        ServiceProcedure::create($data);
        return redirect()->route('admin.service-procedures.index')->with('success', 'Prosedur layanan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceProcedure $serviceProcedure)
    {
        $categories = [
            'Kependudukan',
            'Pertanahan',
            'Perizinan',
            'Umum',
            'Lain-lain'
        ];
        return view('admin.service_procedures.edit', compact('serviceProcedure', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceProcedure $serviceProcedure)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:service_procedures,title,' . $serviceProcedure->id,
            'description' => 'nullable|string|max:500',
            'steps_requirements' => 'required|string',
            'category' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

$data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'steps_requirements' => $request->steps_requirements,
            'category' => $request->category,
            'is_published' => $request->boolean('is_published'),
            'order' => $request->order,
        ];

        // LOGIKA UPDATE FILE
        if ($request->hasFile('file')) {
            // 1. Hapus file lama jika ada
            if ($serviceProcedure->file_path && Storage::disk('public')->exists($serviceProcedure->file_path)) {
                Storage::disk('public')->delete($serviceProcedure->file_path);
            }

            // 2. Upload file baru
            $filePath = $request->file('file')->store('service_procedures', 'public');
            $data['file_path'] = $filePath;
        }

        $serviceProcedure->update($data);

        return redirect()->route('admin.service-procedures.index')
            ->with('success', 'Prosedur layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceProcedure $serviceProcedure)
    {
        // HAPUS FILE SAAT DATA DIHAPUS
        if ($serviceProcedure->file_path && Storage::disk('public')->exists($serviceProcedure->file_path)) {
            Storage::disk('public')->delete($serviceProcedure->file_path);
        }
        $serviceProcedure->delete();
        return redirect()->route('admin.service-procedures.index')->with('success', 'Prosedur layanan berhasil dihapus.');
    }
}
