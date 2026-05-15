<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lugar_ruta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruta_id')->constrained('rutas')->onDelete('cascade');
            $table->foreignId('lugar_id')->constrained('lugares')->onDelete('cascade');
            $table->integer('orden');
            $table->timestamps();
            $table->unique(['ruta_id', 'lugar_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lugar_ruta');
    }
};
