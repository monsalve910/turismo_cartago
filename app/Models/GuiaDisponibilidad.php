<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuiaDisponibilidad extends Model
{
    protected $table = 'guia_disponibilidad';

    protected $fillable = ['user_id', 'dia_semana', 'activo'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
