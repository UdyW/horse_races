<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    /**
     * The meeting that belongs to the race.
     */
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
