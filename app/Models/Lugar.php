<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    protected $table = 'lugares';

    public function rutas()
    {
        return $this->belongsToMany(Ruta::class, 'lugar_ruta')->withPivot('orden');
    }

    protected $fillable = ['nombre', 'descripcion', 'ubicacion', 'imagen'];
}
