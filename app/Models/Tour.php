<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tour extends Model
{
    protected $fillable = [
        'nombre', 
        'descripcion', 
        'precio', 
        'capacidad', 
        'fecha', 
        'categoria_id', 
        'disponible'
    ];

    // Esto te permitirá mostrar el nombre de la categoría en lugar de solo el ID
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}