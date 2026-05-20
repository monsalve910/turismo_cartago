<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("UPDATE reservaciones SET status = 'asignada' WHERE estado_tour = 'asignado' AND status NOT IN ('cancelada', 'finalizada')");
        DB::statement("UPDATE reservaciones SET status = 'iniciada' WHERE estado_tour = 'iniciado' AND status NOT IN ('cancelada', 'finalizada')");
        DB::statement("UPDATE reservaciones SET status = 'finalizada' WHERE estado_tour = 'finalizado' AND status = 'aprobada'");

        Schema::table('reservaciones', function (Blueprint $table) {
            $table->dropColumn('estado_tour');
        });

        DB::statement("ALTER TABLE reservaciones MODIFY COLUMN status ENUM('pendiente', 'aprobada', 'asignada', 'iniciada', 'finalizada', 'cancelada') DEFAULT 'pendiente'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE reservaciones ADD COLUMN estado_tour ENUM('pendiente', 'asignado', 'iniciado', 'finalizado', 'cancelado') DEFAULT 'pendiente' AFTER status");

        DB::statement("UPDATE reservaciones SET estado_tour = 'asignado' WHERE status = 'asignada'");
        DB::statement("UPDATE reservaciones SET estado_tour = 'iniciado' WHERE status = 'iniciada'");
        DB::statement("UPDATE reservaciones SET estado_tour = 'finalizado' WHERE status = 'finalizada'");

        DB::statement("UPDATE reservaciones SET status = 'aprobada' WHERE status IN ('asignada', 'iniciada')");

        DB::statement("ALTER TABLE reservaciones MODIFY COLUMN status ENUM('pendiente', 'aprobada', 'cancelada', 'finalizada') DEFAULT 'pendiente'");
    }
};
