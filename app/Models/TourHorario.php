<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourHorario extends Model
{
    protected $fillable = ["tour_id", "hora"];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
