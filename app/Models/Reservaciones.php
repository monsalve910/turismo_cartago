<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tour;
use App\Models\User;

class Reservaciones extends Model
{
    protected $fillable = [
        'user_id',
        'tour_id',
        'fecha_reservacion',
        'cantidad_personas',
        'status'
    ];
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
