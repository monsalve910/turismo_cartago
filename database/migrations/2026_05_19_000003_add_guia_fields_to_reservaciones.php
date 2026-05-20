<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->foreignId('guia_id')->nullable()->constrained('users')->after('user_id');
            $table->date('fecha_tour')->nullable()->after('fecha_reservacion');
            $table->time('hora_tour')->nullable()->after('fecha_tour');
        });

        DB::statement("ALTER TABLE reservaciones ADD COLUMN estado_tour ENUM('pendiente', 'asignado', 'iniciado', 'finalizado', 'cancelado') DEFAULT 'pendiente' AFTER status");
    }

    public function down(): void
    {
        Schema::table('reservaciones', function (Blueprint $table) {
            $table->dropForeign(['guia_id']);
            $table->dropColumn(['guia_id', 'fecha_tour', 'hora_tour']);
        });

        DB::statement("ALTER TABLE reservaciones DROP COLUMN estado_tour");
    }
};
