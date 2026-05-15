<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("INSERT INTO lugar_ruta (ruta_id, lugar_id, orden, created_at, updated_at)
                       SELECT ruta_id, id, orden, NOW(), NOW() FROM lugares WHERE ruta_id IS NOT NULL");

        Schema::table('lugares', function (Blueprint $table) {
            $table->dropForeign(['ruta_id']);
            $table->dropColumn(['ruta_id', 'orden']);
        });
    }

    public function down(): void
    {
        Schema::table('lugares', function (Blueprint $table) {
            $table->foreignId('ruta_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('orden')->nullable();
        });

        DB::statement("UPDATE lugares l
                       JOIN lugar_ruta lr ON lr.lugar_id = l.id
                       SET l.ruta_id = lr.ruta_id, l.orden = lr.orden");
    }
};
