<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'categoria_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reservaciones()
    {
        return $this->hasMany(Reservaciones::class, 'user_id');
    }

    public function reservacionesAsignadas()
    {
        return $this->hasMany(Reservaciones::class, 'guia_id');
    }

    public function toursAsignados()
    {
        return $this->hasMany(Tour::class, 'guia_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function esGuia(): bool
    {
        return $this->role === 'guia';
    }

    public function scopeGuias($query)
    {
        return $query->where('role', 'guia');
    }
}
