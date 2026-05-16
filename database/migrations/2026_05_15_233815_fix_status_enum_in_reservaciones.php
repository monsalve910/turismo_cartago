<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('reservaciones')->where('status', 'activa')->update(['status' => 'aprobada']);

        DB::statement("ALTER TABLE reservaciones MODIFY status ENUM('pendiente','aprobada','cancelada','finalizada') DEFAULT 'pendiente'");
    }

    public function down(): void
    {
        DB::table('reservaciones')->where('status', 'aprobada')->update(['status' => 'activa']);

        DB::statement("ALTER TABLE reservaciones MODIFY status ENUM('pendiente','activa','cancelada','finalizada') DEFAULT 'pendiente'");
    }
};
