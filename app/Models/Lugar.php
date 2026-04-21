<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
     protected $table = 'lugares';
    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }
    protected $fillable = ['ruta_id', 'nombre', 'descripcion', 'orden','imagen'];
}
