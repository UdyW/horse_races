<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    /**
     * Get all races for a meeting.
     */
    public function race()
    {
        return $this->belongsToMany(Race::class);
    }
}
