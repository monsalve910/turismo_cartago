<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservaciones extends Model
{
    protected $fillable = ['user_id', 'tour_id', 'fecha_reservacion', 'cantidad_personas', 'status'];

    protected $casts = [
        'fecha_reservacion' => 'date',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function puedeCancelar(\Illuminate\Contracts\Auth\Authenticatable $user): bool
    {
        if ($user->role === 'admin') {
            return in_array($this->status, ['pendiente', 'aprobada']);
        }

        if ($this->user_id !== $user->id) {
            return false;
        }

        if (!in_array($this->status, ['pendiente', 'aprobada'])) {
            return false;
        }

        $tourDate = Carbon::parse($this->tour->fecha);
        $daysUntilTour = now()->startOfDay()->diffInDays($tourDate, false);

        return $daysUntilTour >= 2;
    }
}
