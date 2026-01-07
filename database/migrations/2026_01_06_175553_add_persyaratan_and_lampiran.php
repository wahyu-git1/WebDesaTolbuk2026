<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('jenis_surats', function (Blueprint $table) {
        // Menyimpan list syarat. Contoh: [{"nama": "Scan KTP"}, {"nama": "Scan KK"}]
        $table->json('persyaratan')->nullable()->after('fields'); 
    });

    Schema::table('surats', function (Blueprint $table) {
        // Menyimpan path file. Contoh: {"scan_ktp": "lampiran/abc.jpg"}
        $table->json('lampiran')->nullable()->after('data_surat'); 
    });
}

public function down()
{
    Schema::table('jenis_surats', function (Blueprint $table) {
        $table->dropColumn('persyaratan');
    });
    Schema::table('surats', function (Blueprint $table) {
        $table->dropColumn('lampiran');
    });
}
};
