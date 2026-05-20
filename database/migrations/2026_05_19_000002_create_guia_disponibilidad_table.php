<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guia_disponibilidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('dia_semana');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->unique(['user_id', 'dia_semana']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guia_disponibilidad');
    }
};
