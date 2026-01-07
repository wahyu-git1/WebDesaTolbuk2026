<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Helpers\TemplateHelper;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SuratController extends Controller
{

    // ==========================================
    // FRONTEND (PUBLIC)
    // ==========================================

    public function createPublic(Request $request)
    {
        $jenis = JenisSurat::all();

        $selectedJenis = null;
        if ($request->has('jenis_id')) {
            $selectedJenis = JenisSurat::find($request->jenis_id);
        }

        return view('frontend.surat.create', compact('jenis', 'selectedJenis'));
    }
    // Halaman Tracking
    public function tracking()
    {
        return view('frontend.surat.tracking');
    }
    // Simpan Suratxs
    public function storePublic(Request $request)
    {

        // 1. Ambil Config Jenis Surat
        $jenisSurat = JenisSurat::findOrFail($request->jenis_surat_id);


        // 2. Setup Rules Validasi Dasar
        $rules = [
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'nama_pemohon'   => 'required|string|max:255',
            'nik'            => 'required|numeric', // Ubah string ke numeric jika perlu
            'no_hp'          => 'required|string',
            'data_values'    => 'nullable|array', // Array penampung input dinamis
            'lampiran.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4048',
        ];

        // dd($rules);

        // 3. Setup Validasi Dinamis (Looping fields dari database)
        if ($jenisSurat->fields) {
            foreach ($jenisSurat->fields as $field) {
                // name di form: data_values[nama_field]
                // rule: data_values.nama_field
                $rules['data_values.' . $field['name']] = 'required'; 
                // Kamu bisa tambah logika validasi tipe data (number/date) di sini jika mau
            }
        }

        // dd($jenisSurat);


  
        $request->validate($rules);
        // dd($request);

        $lampiranPaths = [];
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $key => $file) {
                // Simpan ke storage/app/public/lampiran
                // Nama file diacak agar aman
                $path = $file->store('lampiran', 'public');
                
                // Simpan pathnya ke array dengan key sesuai variable (misal: scan_ktp => path/file.jpg)
                $lampiranPaths[$key] = $path;
            }
        }

        // 4. Simpan Surat
        $surat = Surat::create([
            'kode_tracking'  => 'SR-' . now()->format('Ymd') . '-' . rand(1000, 9999),
            'jenis_surat_id' => $request->jenis_surat_id,
            'nama_pemohon'   => $request->nama_pemohon,
            'nik'            => $request->nik,
            'no_hp'         => $request->no_hp,
            'status'         => 'diajukan',
            'data_surat'     => $request->data_values, // Simpan array dinamis ke kolom JSON
            'lampiran'      => $lampiranPaths, // Simpan array path lampiran ke kolom JSON
        ]);

        return redirect()->route('surat.tracking')
            ->with('success', 'Permohonan berhasil! Kode Tracking: ' . $surat->kode_tracking);
    }


    public function trackingResult(Request $request)
    {
        $request->validate(['kode_tracking' => 'required']);

        $surat = Surat::where('kode_tracking', $request->kode_tracking)->first();

        return view('frontend.surat.tracking-result', compact('surat'));
    }


    // ==========================================
    // BACKEND (ADMIN)
    // ==========================================


    public function index(Request $request)
    {
// 1. Mulai Query dasar dengan eager loading 'jenis'
        $query = Surat::with('jenis')->latest();

        // 2. Filter Pencarian (Nama Pemohon atau NIK)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('kode_tracking', 'like', "%{$search}%"); // Tambahan: cari kode tracking juga
            });
        }

        // 3. Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 4. Filter Berdasarkan Tanggal (Range)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }

        // 5. Eksekusi Pagination
        // 'withQueryString()' penting agar saat klik Halaman 2, filter tidak hilang
        $surats = $query->paginate(10)->withQueryString();

        return view('admin.surat.index', compact('surats'));    }

    public function show($id)
    {
        // $surat = Surat::findOrFail($id);
        $surat = Surat::with('jenis')->findOrFail($id);
        return view('admin.surat.show', compact('surat'));
    }

    public function cetak($id)
    {
        $surat = Surat::with('jenis')->findOrFail($id);

        // 1. Ambil Template
        $template = $surat->jenis->template;

        if (!$template) {
            return redirect()->back()->with('error', 'Template belum tersedia.');
        }

        // 2. Gabungkan Data
        $data = $surat->toArray();
        if ($surat->data_surat) {
            $data = array_merge($data, $surat->data_surat);
        }

        // 3. Render HTML
        $htmlContent = TemplateHelper::render($template, $data);

        // 4. Generate PDF dari HTML String
        $pdf = Pdf::loadHTML($htmlContent)
            ->setPaper('A4', 'portrait')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        return $pdf->download('surat-' . $surat->kode_tracking . '.pdf');
    }


    public function create()
    {
        // $surat = new Surat;
        // Admin membuat surat manual
        $jenisSurat = JenisSurat::all();
        return view('admin.surat.form', compact('jenisSurat'));
    }
    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $jenisSurat = JenisSurat::all();
        // Pass $surat->jenis->fields agar form bisa generate input value
        return view('admin.surat.form', compact('surat', 'jenisSurat'));
    }

    public function preview($id)
    {
        $surat = Surat::with('jenis')->findOrFail($id);

        // 1. Ambil Template dari Database
        $template = $surat->jenis->template;

        if (!$template) {
            return "Template belum diatur untuk jenis surat ini.";
        }

        // 2. Gabungkan Data Statis & Dinamis
        // Data Statis: nama_pemohon, nik, dll
        $data = $surat->toArray();
        
        // Data Dinamis: isi dari json 'data_surat' (merged ke array utama)
        if ($surat->data_surat) {
            $data = array_merge($data, $surat->data_surat);
        }

        // 3. Render Template
        // Menggunakan helper yang ada di prompt pertama kamu
        $content = TemplateHelper::render($template, $data);
        
        return view('admin.surat.preview-show', [
            'jenis' => $surat->jenis,
            'content' => $content
        ]);


    }
    public function store(Request $request)
    {

        // Logic sama dengan storePublic, hanya redirectnya beda
        $jenisSurat = JenisSurat::findOrFail($request->jenis_surat_id);

        $rules = [
            'jenis_surat_id' => 'required',
            'nama_pemohon'   => 'required',
            'nik'            => 'required',
            'data_values'    => 'nullable|array',
        ];

        // Validasi Dinamis
        if ($jenisSurat->fields) {
            foreach ($jenisSurat->fields as $field) {
                $rules['data_values.' . $field['name']] = 'required';
            }
        }

        $request->validate($rules);

        Surat::create([
            'kode_tracking'  => 'ADM-' . now()->format('Ymd') . '-' . rand(1000, 9999),
            'jenis_surat_id' => $request->jenis_surat_id,
            'nama_pemohon'   => $request->nama_pemohon,
            'nik'            => $request->nik,
            'status'         => 'disetujui', // Kalau admin yang buat, mungkin langsung setujui?
            'data_surat'     => $request->data_values,
        ]);
        
        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil dibuat oleh Admin!');
    }

    public function update(Request $request, $id)
    {
        // Biasanya update hanya status, tapi kalau mau update isi surat:
        $surat = Surat::findOrFail($id);

        // $surat->status = $request->status;
        // $surat->save();
        // Update Status saja (sesuai kode lama kamu)
        if ($request->has('status')) {
            $surat->status = $request->status;
            $surat->save();
        }

        return redirect()->route('admin.surat.index')
            ->with('success', 'Status surat berhasil diperbarui!');
    }

    public function success($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.frontend.success', compact('surat'));
    }
}