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
            //
            Schema::table('jenis_surats', function (Blueprint $table) {
                
                $table->json('fields')->nullable(); // Kolom untuk menyimpan struktur form (label, name, type)
            });
        }
        
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
