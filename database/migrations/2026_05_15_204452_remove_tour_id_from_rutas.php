<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No hacer nada porque la columna no existe
    }

    public function down(): void
    {
        Schema::table('rutas', function (Blueprint $table) {

            $table->foreignId('tour_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }
};
