<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['name'];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function guias()
    {
        return $this->hasMany(User::class, 'categoria_id');
    }
}