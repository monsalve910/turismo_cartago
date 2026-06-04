<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio', 'capacidad', 'fecha', 'categoria_id', 'ruta_id', 'guia_id', 'disponible', 'imagen'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class);
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class);
    }

    public function reservaciones()
    {
        return $this->hasMany(Reservaciones::class, 'tour_id');
    }

    public function horarios()
    {
        return $this->hasMany(TourHorario::class);
    }

    public function guia()
    {
        return $this->belongsTo(User::class, 'guia_id');
    }

    public function getEstaAgotadoAttribute()
    {
        $cuposReservados = $this->reservaciones()
            ->where('status', '!=', 'cancelada')
            ->sum('cantidad_personas');

        return $cuposReservados >= $this->capacidad;
    }
}