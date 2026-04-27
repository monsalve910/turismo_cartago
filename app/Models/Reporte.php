<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reporte extends Model
{
    protected $table = 'reportes';
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'categoria_id',
        'precio_min',
        'precio_max'
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}