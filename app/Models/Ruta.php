<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lugar;
use App\Models\Tour;

class Ruta extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function lugares()
    {
        return $this->belongsToMany(Lugar::class, 'lugar_ruta')->withPivot('orden');
    }

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'ruta_tour');
    }
}
