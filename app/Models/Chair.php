<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    protected $fillable = [
        'chair_number',
        'chair_owner'
    ];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
