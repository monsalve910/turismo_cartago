<?php

namespace App\Jobs;

use App\Models\Reservaciones;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FinalizarReservacionJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Reservaciones $reservacion
    ) {}

    public function handle(): void
    {
        $this->reservacion->refresh();

        if (!in_array($this->reservacion->status, ['aprobada', 'iniciada'])) {
            return;
        }

        $fechaTour = $this->reservacion->fecha_tour ?? $this->reservacion->tour?->fecha;

        if ($fechaTour && Carbon::parse($fechaTour)->isBefore(today())) {
            $this->reservacion->update(['status' => 'finalizada']);
        }
    }
}
