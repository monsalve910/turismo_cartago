<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Categoria;
use App\Models\Comentarios;
use App\Models\Ruta;

class Tour extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'capacidad',
        'fecha',
        'categoria_id',
        'disponible',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentarios::class, 'tour_id');
    }
    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }
}
