<?php

namespace App\Console\Commands;

use App\Models\Reservaciones;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FinalizarReservaciones extends Command
{
    protected $signature = 'reservaciones:finalizar';
    protected $description = 'Finaliza automaticamente reservaciones cuyo tour ya paso 1 dia';

    public function handle()
    {
        $count = Reservaciones::where('status', 'aprobada')
            ->whereHas('tour', function ($q) {
                $q->whereDate('fecha', '<', Carbon::today()->toDateString());
            })
            ->update(['status' => 'finalizada']);

        $this->info("{$count} reservaciones finalizadas automaticamente.");
    }
}
