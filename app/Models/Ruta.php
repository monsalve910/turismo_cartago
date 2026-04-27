<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    public function lugares()
    {
        return $this->hasMany(Lugar::class);
    }
    protected $fillable = ['nombre', 'descripcion'];
}
