<?php

namespace App\Console\Commands;

use App\Models\Reservaciones;
use Illuminate\Console\Command;

class FinalizarReservaciones extends Command
{
    protected $signature = 'reservaciones:finalizar';

    protected $description = 'Finaliza automaticamente reservaciones cuyo tour ya paso';

    public function handle()
    {
        $reservaciones = Reservaciones::with('tour')
            ->where('status', 'aprobada')
            ->get();

        $count = 0;

        foreach ($reservaciones as $reservacion) {

            if (
                $reservacion->tour &&
                \Carbon\Carbon::parse($reservacion->tour->fecha)->isBefore(today())
            ) {

                $reservacion->update([
                    'status' => 'finalizada'
                ]);

                $count++;
            }
        }

        $this->info("{$count} reservaciones finalizadas automaticamente.");
    }
}
