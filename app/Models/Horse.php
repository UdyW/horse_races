<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    /**
     * Get all jockey for a horse.
     */
    public function jockey()
    {
        return $this->belongsTo(Jockey::class);
    }

    /**
     * Get all trainer for a horse.
     */
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
