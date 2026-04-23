<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservaciones extends Model
{
    protected $fillable = [
        'user_id',
        'tour_id',
        'fecha_reservacion',
        'cantidad_personas',
        'status'
    ];
}
