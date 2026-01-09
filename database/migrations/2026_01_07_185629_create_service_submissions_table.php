<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_submissions', function (Blueprint $table) {
            $table->id();
            // Relasi ke ServiceProcedure agar tahu ini pengajuan untuk layanan apa
            $table->foreignId('service_procedure_id')->constrained()->onDelete('cascade');
            
            $table->string('nama_pemohon');
            $table->string('nik', 16);
            $table->string('no_hp', 15);
            
            // Menyimpan path file lampiran (Scan formulir, KTP, dll) dalam format JSON
            $table->json('files'); 
            
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_submissions');
    }
};
