<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookableSlot extends Model
{
    use HasFactory;

    // protected $dates = [
    //     'start_time',
    //     'end_time',
    //     'created_at',
    //     'updated_at'
    // ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'bookable_slot_id');
    }
}
