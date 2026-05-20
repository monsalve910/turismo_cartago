<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("UPDATE reservaciones SET status = 'aprobada' WHERE status = 'asignada'");
        DB::statement("ALTER TABLE reservaciones MODIFY COLUMN status ENUM('pendiente', 'aprobada', 'iniciada', 'finalizada', 'cancelada') DEFAULT 'pendiente'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE reservaciones MODIFY COLUMN status ENUM('pendiente', 'aprobada', 'asignada', 'iniciada', 'finalizada', 'cancelada') DEFAULT 'pendiente'");
    }
};
