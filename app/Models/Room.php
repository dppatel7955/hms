<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'type',
        'status',
        'price_per_day',
    ];

    /**
     * Get admissions for the room.
     */
    public function admissions(): HasMany
    {
        return $this->hasMany(Admission::class);
    }
}
