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
        Schema::table('tours', function (Blueprint $table) {

            $table->foreignId('ruta_id')
                ->nullable()
                ->constrained('rutas')
                ->after('categoria_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {

            $table->dropForeign(['ruta_id']);
            $table->dropColumn('ruta_id');
        });
    }
};
