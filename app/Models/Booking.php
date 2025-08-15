<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable= [
        'booking_name',
        'booking_phonenumber',
        'booking_service',
        'booking_date',
        'booking_date',
        'booking_time',
        'booking_number',
        'booking_status',
    ];
}
